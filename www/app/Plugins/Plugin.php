<?php


namespace FPP\Plugins;

use Closure;
use InvalidArgumentException;
use Illuminate\Events\Dispatcher;
use Composer\Autoload\ClassLoader;
use Illuminate\Cache\CacheManager;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Contracts\Support\Arrayable;

class Plugin implements Arrayable, PluginInterface
{
    /**
     * Indicates if the application has "registered" with the bag.
     *
     * @var bool
     */
    protected $registered = false;

    /**
     * Indicates if the application has "booted".
     *
     * @var bool
     */
    protected $booted = false;

    /**
     * Plugin bag instance.
     *
     * @var \FPP\Plugins\PluginBag
     */
    protected $pluginBag;

    /**
     * The Plugin's slug.
     *
     * @var string
     */
    protected $slug;

    /**
     * The Plugin's path.
     *
     * @var string
     */
    protected $path;

    /**
     * The plugin attributes.
     *
     * @var array
     */
    protected $attributes = array(
        'migrations_path' => 'database/migrations',
        'seeds_path'      => 'database/seeds',
        'seeds_namespace' => 'Database\Seeds',
        'seeder_file'     => 'DatabaseSeeder',
        'seeding_enabled' => true,
        'providers'       => array(),
    );

    /**
     * The plugin database attributes.
     *
     * @var array
     */
    protected $databaseAttributes = array();

    /**
     * The Plugin's namespace.
     *
     * @var string
     */
    protected $namespace;

    /**
     * The Illuminate Cache manager instance.
     *
     * @var \Illuminate\Cache\CacheManager
     */
    protected $cache;

    /**
     * The cache key.
     *
     * @var string
     */
    protected static $cacheKey = 'fpp.plugins';

    /**
     * The array of autoloaders registered with the plugin.
     *
     * @var array
     */
    protected $autoloaders = array();

    /**
     * The connection name for the plugin.
     *
     * @var string
     */
    protected $connection;

    /**
     * The connection resolver instance.
     *
     * @var \Illuminate\Database\ConnectionResolverInterface|\Illuminate\Database\Capsule\Manager
     */
    protected static $resolver;

    /**
     * The event dispatcher instance.
     *
     * @var \Illuminate\Events\Dispacher
     */
    protected static $dispatcher;

    /**
     * Plugin migrator.
     *
     * @var \Illuminate\Database\Migrations\Migrator
     */
    protected static $migrator;

    /**
     * Constructor.
     *
     * @param  \FPP\Plugins\PluginBag  $pluginBag
     * @param  string  $slug
     * @param  string  $path
     * @param  array  $attributes
     * @param  string  $namespace
     * @param  \Illuminate\Cache\CacheManager  $cache
     * @return void
     */
    public function __construct(
        PluginBag $pluginBag,
        $slug,
        $path,
        array $attributes = array(),
        $namespace = null,
        CacheManager $cache = null
    ) {
        $this->pluginBag = $pluginBag;

        $this->slug = $slug;

        $this->path = $path;

        $this->namespace = $namespace;

        $this->cache = $cache;

        $this->fill($attributes);

        $this->setupPluginContext();
    }

    /**
     * {@inheritDoc}
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * {@inheritDoc}
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * {@inheritDoc}
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * {@inheritDoc}
     */
    public function getVendor()
    {
        list($vendor) = explode('\\', $this->namespace);

        return $vendor;
    }

    /**
     * {@inheritDoc}
     */
    public function getDependencies()
    {
        if (isset($this->require)) {
            return (array) $this->require;
        }

        return array();
    }

    /**
     * {@inheritDoc}
     */
    public function isVersioned()
    {
        return (bool) $this->getVersion();
    }

    /**
     * {@inheritDoc}
     */
    public function getVersion()
    {
        if (isset($this->version)) {
            return $this->version;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function canInstall()
    {
        // If we have no dependencies, we can install
        if ( ! $dependencies = $this->getDependencies()) {
            return true;
        }

        // Loop through dependencies and check if they are installed
        foreach ($dependencies as $dependency) {
            if ( ! isset($this->pluginBag[$dependency])) {
                return false;
            }

            if ( ! $this->pluginBag[$dependency]->isInstalled()) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isInstalled()
    {
        // If don't have database attributes, we're not installed
        if ( ! count($this->databaseAttributes)) {
            return false;
        }

        return isset($this->databaseAttributes['version']);
    }

    /**
     * {@inheritDoc}
     */
    public function install()
    {
        if ($this->isInstalled()) {
            throw new \RuntimeException("Cannot install Plugin [{$this->slug}] as it's already installed!");
        }

        $this->fireEvent('installing');

        $this->migrate();

        $this->seed();

        $this->databaseInsert(array(
            'slug'    => $this->slug,
            'version' => $this->version,
            'enabled' => false,
        ));

        $this->fireEvent('installed');
    }

    /**
     * {@inheritDoc}
     */
    public function canUninstall()
    {
        // Loop through all installed plugins and
        // check we are not a dependency.
        foreach ($this->pluginBag->allInstalled() as $plugin) {
            if (in_array($this->slug, $plugin->getDependencies())) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isUninstalled()
    {
        return ! $this->isInstalled();
    }

    /**
     * {@inheritDoc}
     */
    public function uninstall()
    {
        if ($this->isUninstalled()) {
            throw new \RuntimeException("Cannot uninstall Plugin [{$this->slug}] as it's not installed!");
        }

        $this->fireEvent('uninstalling');

        $this->resetMigrations();

        $this->databaseDelete();

        $this->fireEvent('uninstalled');
    }

    /**
     * {@inheritDoc}
     */
    public function canEnable()
    {
        // If we have no dependencies, the plugin can be enabled
        if ( ! $dependencies = $this->getDependencies()) {
            return true;
        }

        // Loop through the dependencies and check they are enabled
        foreach ($dependencies as $dependency) {
            if ( ! isset($this->pluginBag[$dependency])) {
                return false;
            }

            if ( ! $this->pluginBag[$dependency]->isEnabled()) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isEnabled()
    {
        if ( ! $this->isInstalled()) {
            return false;
        }

        if ( ! isset($this->databaseAttributes['enabled'])) {
            return false;
        }

        return (bool) $this->databaseAttributes['enabled'];
    }

    /**
     * {@inheritDoc}
     */
    public function enable()
    {
        if ($this->isUninstalled()) {
            throw new \RuntimeException("Cannot enable Plugin [{$this->slug}] as it's not installed!");
        }

        if ($this->isEnabled()) {
            throw new \RuntimeException("Cannot enable Plugin [{$this->slug}] as it's already enabled!");
        }

        $this->fireEvent('enabling');

        $this->databaseUpdate(array(
            'enabled' => true,
        ));

        $this->fireEvent('enabled');
    }

    /**
     * {@inheritDoc}
     */
    public function canDisable()
    {
        // Loop through all the installed plugins
        // and check we are not a dependency.
        foreach ($this->pluginBag->allEnabled() as $plugin) {
            if (in_array($this->slug, $plugin->getDependencies())) {
                return false;
            }
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isDisabled()
    {
        return ( ! $this->isEnabled());
    }

    /**
     * {@inheritDoc}
     */
    public function disable()
    {
        if ($this->isUninstalled()) {
            throw new \RuntimeException("Cannot disable Plugin [{$this->slug}] as it's not installed!");
        }

        if ($this->isDisabled()) {
            throw new \RuntimeException("Cannot disable Plugin [{$this->slug}] as it's not enabled!");
        }

        $this->fireEvent('disabling');

        $this->databaseUpdate(array(
            'enabled' => false,
        ));

        $this->fireEvent('disabled');
    }

    /**
     * {@inheritDoc}
     */
    public function hasProviders()
    {
        return ($this->providers && is_array($this->providers));
    }

    /**
     * {@inheritDoc}
     */
    public function needsUpgrade()
    {
        // Not versioned?
        if ( ! $this->isVersioned()) {
            return false;
        }

        // No database version? We haven't been persisted in the database yet
        if ($this->isUninstalled()) {
            return true;
        }

        return (version_compare($this->version, $this->databaseAttributes['version']) > 0);
    }

    /**
     * {@inheritDoc}
     */
    public function upgrade()
    {
        if ($this->isUninstalled()) {
            throw new \RuntimeException("Cannot upgrade Plugin [{$this->slug}] as it's not installed!");
        }

        $this->fireEvent('upgrading');

        $this->migrate();

        $this->databaseUpdate(array(
            'version' => $this->version,
        ));

        $this->fireEvent('upgraded');
    }

    /**
     * {@inheritDoc}
     */
    public function isRegistered()
    {
        return $this->registered;
    }

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->fireEvent('registering');

        $container = $this->getContainer();

        if ($this->hasProviders()) {
            foreach ($this->providers as $provider) {
                $container->resolveProviderClass($provider)->register();
            }
        } elseif (isset($this->register) && $this->register instanceof Closure) {
            call_user_func_array($this->register, array($this, $container));
        }

        $this->registered = true;

        $this->registerAutoloading();

        $this->fireEvent('registered');
    }

    /**
     * {@inheritDoc}
     */
    public function isBooted()
    {
        return $this->booted;
    }

    /**
     * {@inheritDoc}
     */
    public function boot()
    {
        if ( ! $this->isEnabled()) {
            throw new \RuntimeException("Cannot boot Plugin [{$this->slug}] as it's not enabled.");
        }

        // We will register a package right away before we fire
        // our events as this allows all callback to hook onto
        // the registered package.
        $this->registerPackage();

        $this->fireEvent('booting');

        $container = $this->getContainer();

        if ($this->hasProviders()) {
            foreach ($this->providers as $provider) {
                $container->resolveProviderClass($provider)->boot();
            }
        } elseif (isset($this->boot) && $this->boot instanceof Closure) {
            call_user_func_array($this->boot, array($this, $container));
        }

        $this->booted = true;

        $this->setupRoutes();

        $this->setupWidgets();

        $this->fireEvent('booted');
    }

    /**
     * Sets up the plugin context, ready for use.
     *
     * @return void
     */
    public function setupPluginContext()
    {
        $this->ensureNamespace();
    }

    /**
     * Sets up the database with the plugin.
     *
     * @return void
     */
    public function setupDatabase()
    {
        $this->hydrateDatabaseAttributes();
    }

    /**
     * Returns the migrations path for the plugin.
     *
     * An absolute path can be specified by prefixing the path with
     * string 'path: ', otherwise the path is treated as relative
     * to the plugin path.
     *
     * @return string
     */
    public function getMigrationsPath()
    {
        if (starts_with($this->migrations_path, 'path: ')) {
            return substr($this->migrations_path, 6);
        }

        return "{$this->path}/{$this->migrations_path}";
    }

    /**
     * Returns the seeds path for the plugin.
     *
     * An absolute path can be specified by prefixing the path with
     * string 'path: ', otherwise the path is treated as relative
     * to the plugin path.
     *
     * @return string
     */
    public function getSeedsPath()
    {
        if (starts_with($this->seeds_path, 'path: ')) {
            return substr($this->seeds_path, 6);
        }

        return "{$this->path}/{$this->seeds_path}";
    }

    /**
     * Ensures we have a namespace and if not, set the default namespace.
     *
     * @return void
     */
    public function ensureNamespace()
    {
        if ( ! isset($this->namespace)) {
            $this->namespace = studly_case(str_replace(' ', '\\', ucwords(str_replace('/', ' ', $this->slug))));
        }
    }

    /**
     * Registers autoloading for the plugin.
     *
     * @return \Composer\Autoload\ClassLoader|null
     */
    public function registerAutoloading()
    {
        if ($this->autoload instanceof Closure) {
            return $this->registerClosureAutoloading();
        } elseif ($this->autoload === 'fpp') {
            return $this->registerDefaultAutoloading();
        }
    }

    /**
     * Registers Closure autoloading for the Plugin.
     *
     * @return \Composer\Autoload\ClassLoader
     */
    public function registerClosureAutoloading()
    {
        $loader = new ClassLoader;

        // Put this first incase the closure overrides
        $loader->setUseIncludePath(true);

        call_user_func_array($this->autoload, array($loader, $this));

        $loader->register();

        return $this->autoloaders[] = $loader;
    }

    /**
     * Registers default autoloading for the Plugin.
     *
     * @return \Composer\Autoload\ClassLoader
     */
    public function registerDefaultAutoloading()
    {
        $loader = new ClassLoader;

        $loader->add($this->namespace, $this->path.'/src');

        $loader->register();

        $loader->setUseIncludePath(true);

        return $this->autoloaders[] = $loader;
    }

    /**
     * Setup plugin routes.
     *
     * @return void
     */
    public function setupRoutes()
    {
        if ( ! $this->isBooted()) {
            throw new \RuntimeException("Cannot register routes for Plugin [{$this->slug}] as it's not booted.");
        }

        if (isset($this->routes) && $this->routes instanceof Closure) {
            $container = $this->getContainer();

            call_user_func_array($this->routes, array($this, $container));
        }
    }

    /**
     * Setup plugin widgets.
     *
     * @return void
     */
    public function setupWidgets()
    {
        if ( ! $this->isBooted()) {
            throw new \RuntimeException("Cannot register widgets for Plugin [{$this->slug}] as it's not booted.");
        }

        if (isset($this->widgets) && $this->widgets instanceof Closure) {
            $container = $this->getContainer();

            call_user_func_array($this->widgets, array($this, $container));
        }
    }

    /**
     * Registers a package with the container associated
     * with the plugin bag.
     *
     * @return void
     */
    public function registerPackage()
    {
        // If there is no IoC container associated with our
        // bag, let's just ditch out now.
        if ( ! $container = $this->getContainer()) {
            return;
        }

        // The package is our slug. If your plugin is
        // foo/bar, then the package registered is foo/bar
        $package = $this->slug;

        // Next we will check for any "language" components. If language files exist
        // we will register them with this given package's namespace so that they
        // may be accessed using the translation facilities of the application.
        $lang = $this->path.'/lang';

        if ($container['files']->isDirectory($lang)) {
            $container['translator']->addNamespace($package, $lang);
        }

        // Finally we will register the view namespace so that we can access each of
        // the views available in this package. We use a standard convention when
        // registering the paths to every package's views and other components.
        $view = $this->path.'/views';

        if ($container['files']->isDirectory($view)) {
            $container['view']->addNamespace($package, $view);
        }
    }

    /**
     * Returns the container associated with the plugin bag.
     *
     * @return \Illuminate\Container\Container
     */
    public function getContainer()
    {
        return $this->pluginBag->getContainer();
    }

    /**
     * Inserts data in the database and marges the attributes
     * inserted with our current database attributes.
     *
     * @param  array  $attributes
     * @return void
     */
    public function databaseInsert(array $attributes)
    {
        $this->getConnection()->table('plugins')->insert($attributes);

        $this->forgetCache();

        $this->databaseAttributes = array_merge($this->databaseAttributes, $attributes);
    }

    /**
     * Updates data in the database and marges the attributes
     * updated with our current database attributes.
     *
     * @param  array  $attributes
     * @return void
     */
    public function databaseUpdate(array $attributes)
    {
        $this->getConnection()->table('plugins')->where('slug', '=', $this->slug)->update($attributes);

        $this->forgetCache();

        $this->databaseAttributes = array_merge($this->databaseAttributes, $attributes);
    }

    /**
     * Deletes data in the database and empties the database attributes.
     *
     * @return void
     */
    public function databaseDelete()
    {
        $this->getConnection()->table('plugins')->where('slug', '=', $this->slug)->delete();

        $this->forgetCache();

        $this->databaseAttributes = array();
    }

    /**
     * Hydrates the database attributes.
     *
     * @return void
     */
    public function hydrateDatabaseAttributes()
    {
        $databaseAttributes = (array) $this->getConnection()->table('plugins')->where('slug', '=', $this->slug)->first();

        if (isset($databaseAttributes['enabled'])) {
            $databaseAttributes['enabled'] = (bool) $databaseAttributes['enabled'];
        }

        $this->databaseAttributes = $databaseAttributes;
    }

    /**
     * Returns all of the current attributes for the theme.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Sets the Theme's attributes.
     *
     * @param  array  $attributes
     * @return void
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Fill the theme with an array of attributes.
     *
     * @param  array  $attributes
     * @return void
     */
    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    /**
     * Sets a given attribute on the Theme.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Returns an attribute from the theme.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function getAttribute($key, $default = null)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }

        return value($default);
    }

    /**
     * Returns all of the current database attributes on the plugin.
     *
     * @return array
     */
    public function getDatabaseAttributes()
    {
        return $this->databaseAttributes;
    }

    /**
     * Sets the array of plugin database attributes. No checking is done.
     *
     * @param  array  $databaseAttributes
     * @return void
     */
    public function setDatabaseAttributes(array $databaseAttributes)
    {
        $this->databaseAttributes = $databaseAttributes;
    }

    /**
     * Returns the database connection for the model.
     *
     * @return \Illuminate\Database\Connection
     */
    public function getConnection()
    {
        return static::resolveConnection($this->connection);
    }

    /**
     * Returns the current connection name for the model.
     *
     * @return string
     */
    public function getConnectionName()
    {
        return $this->connection;
    }

    /**
     * Sets the connection associated with the model.
     *
     * @param  string  $name
     * @return void
     */
    public function setConnection($name)
    {
        $this->connection = $name;
    }

    /**
     * Fires the "plugin.registering" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function registering(Closure $callback)
    {
        static::registerEvent('registering', $callback);
    }

    /**
     * Fires the "plugin.registered" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function registered(Closure $callback)
    {
        static::registerEvent('registered', $callback);
    }

    /**
     * Fires the "plugin.booting" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function booting(Closure $callback)
    {
        static::registerEvent('booting', $callback);
    }

    /**
     * Fires the "plugin.booted" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function booted(Closure $callback)
    {
        static::registerEvent('booted', $callback);
    }

    /**
     * Fires the "plugin.installing" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function installing(Closure $callback)
    {
        static::registerEvent('installing', $callback);
    }

    /**
     * Fires the "plugin.installed" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function installed(Closure $callback)
    {
        static::registerEvent('installed', $callback);
    }

    /**
     * Fires the "plugin.uninstalling" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function uninstalling(Closure $callback)
    {
        static::registerEvent('uninstalling', $callback);
    }

    /**
     * Fires the "plugin.uninstalled" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function uninstalled(Closure $callback)
    {
        static::registerEvent('uninstalled', $callback);
    }

    /**
     * Fires the "plugin.enabling" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function enabling(Closure $callback)
    {
        static::registerEvent('enabling', $callback);
    }

    /**
     * Fires the "plugin.enabled" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function enabled(Closure $callback)
    {
        static::registerEvent('enabled', $callback);
    }

    /**
     * Fires the "plugin.disabling" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function disabling(Closure $callback)
    {
        static::registerEvent('disabling', $callback);
    }

    /**
     * Fires the "plugin.disabled" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function disabled(Closure $callback)
    {
        static::registerEvent('disabled', $callback);
    }

    /**
     * Fires the "plugin.upgrading" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function upgrading(Closure $callback)
    {
        static::registerEvent('upgrading', $callback);
    }

    /**
     * Fires the "plugin.upgraded" event.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function upgraded(Closure $callback)
    {
        static::registerEvent('upgraded', $callback);
    }

    /**
     * Checks if seeding is enabled or not.
     *
     * @return bool
     */
    public function isSeedersEnabled()
    {
        return $this->seeding_enabled;
    }

    /**
     * Enables the plugin seeders.
     *
     * @return void
     */
    public function enableSeeders()
    {
        $this->setAttribute('seeding_enabled', true);
    }

    /**
     * Disables the plugin seeders.
     *
     * @return void
     */
    public function disableSeeders()
    {
        $this->setAttribute('seeding_enabled', false);
    }

    /**
     * Listen for an event on the plugin.
     *
     * @param  string   $name
     * @param  \Closure  $callback
     * @return void
     */
    protected static function registerEvent($name, Closure $callback)
    {
        if ( ! isset(static::$dispatcher)) {
            return;
        }

        static::$dispatcher->listen("plugin.{$name}", $callback);
    }

    /**
     * Fires an event for the plugin.
     *
     * @param  string  $name
     * @return mixed
     */
    protected function fireEvent($name)
    {
        if ( ! isset(static::$dispatcher)) {
            return;
        }

        return static::$dispatcher->fire("plugin.{$name}", array($this));
    }

    /**
     * Migrate the plugin with an optional customized path.
     *
     * @param  string  $path
     * @return void
     */
    protected function migrate($path = null)
    {
        if ( ! isset(static::$migrator)) {
            return;
        }

        $path = $path ?: $this->getMigrationsPath();

        static::$migrator->run($path);
    }

    /**
     * Seeds the database using the plugin seeders.
     *
     * @return void
     */
    protected function seed()
    {
        $seederFilePath = "{$this->getSeedsPath()}/{$this->seeder_file}.php";

        if (file_exists($seederFilePath)) {
            require_once $seederFilePath;

            $namespace = "{$this->namespace}\\{$this->seeds_namespace}\\{$this->seeder_file}";

            $class = '\\'.ltrim($namespace, '\\');

            $seeder = new $class;

            $seeder->run();
        }
    }

    /**
     * Reset the migrations for the plugin with an
     * optional customized path.
     *
     * @param  string  $path
     * @return void
     */
    protected function resetMigrations($path = null)
    {
        if ( ! isset(static::$migrator)) {
            return;
        }

        $path = $path ?: $this->getMigrationsPath();

        $files = static::$migrator->getMigrationFiles($path);
        $repository = static::$migrator->getRepository();

        // Get an array of migration names which will be
        // reset
        $migrations = array_intersect(array_reverse($repository->getRan()), $files);

        // Loop through the migrations we have to rollback
        foreach ($migrations as $migration) {
            // Let the migrator resolve the migration instance
            $instance = static::$migrator->resolve($migration);

            // And we'll call the down method on the migration
            $instance->down();

            // Now we need to manipulate what the migrator does to
            // delete a migration.
            $migrationClass = new \StdClass;
            $migrationClass->migration = $migration;
            $repository->delete($migrationClass);
        }
    }

    /**
     * Resolve a connection instance by name.
     *
     * @param  string  $connection
     * @return \Illuminate\Database\Connection
     */
    public static function resolveConnection($connection)
    {
        return static::$resolver->connection($connection);
    }

    /**
     * Returns the connection resolver instance.
     *
     * @return \Illuminate\Database\ConnectionResolverInterface|\Illuminate\Database\Capsule\Manager
     */
    public static function getConnectionResolver()
    {
        return static::$resolver;
    }

    /**
     * Sets the connection resolver instance.
     *
     * @param  \Illuminate\Database\ConnectionResolverInterface|\Illuminate\Database\Capsule\Manager  $resolver
     * @return void
     */
    public static function setConnectionResolver($resolver)
    {
        if ( ! $resolver instanceof ConnectionResolverInterface && ! $resolver instanceof Capsule)
        {
            throw new InvalidArgumentException('Invalid resolver. Resolver must be an instance of Illuminate\Database\ConnectionResolverInterface or Illuminate\Database\Capsule\Manager');
        }

        static::$resolver = $resolver;
    }

    /**
     * Returns the event dispatcher instance.
     *
     * @return \Illuminate\Events\Dispatcher
     */
    public static function getEventDispatcher()
    {
        return static::$dispatcher;
    }

    /**
     * Sets the event dispatcher instance.
     *
     * @param  \Illuminate\Events\Dispatcher
     * @return void
     */
    public static function setEventDispatcher(Dispatcher $dispatcher)
    {
        static::$dispatcher = $dispatcher;
    }

    /**
     * Unsets the event dispatcher for models.
     *
     * @return void
     */
    public static function unsetEventDispatcher()
    {
        static::$dispatcher = null;
    }

    /**
     * Returns the database migrator instance.
     *
     * @return \Illuminate\Database\Migrations\Migrator
     */
    public static function getMigrator()
    {
        return static::$migrator;
    }

    /**
     * Sets the database migrator instance.
     *
     * @param  \Illuminate\Database\Migrations\Migrator
     * @return void
     */
    public static function setMigrator(Migrator $migrator)
    {
        static::$migrator = $migrator;
    }

    /**
     * Unsets the database migrator for models.
     *
     * @return void
     */
    public static function unsetMigrator()
    {
        static::$migrator = null;
    }

    /**
     * Dynamically retrieve attributes on the object.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the object.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Determines if an attribute exists on the object.
     *
     * @param  string  $key
     * @return void
     */
    public function __isset($key)
    {
        return isset($this->attributes[$key]);
    }

    /**
     * Unset an attribute on the object.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        unset($this->attributes[$key]);
    }

    /**
     * Returns the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $array['attributes'] = $this->attributes;

        foreach ($array['attributes'] as $key => $value) {
            if ($value instanceof Closure) {
                unset($array['attributes'][$key]);
            }
        }

        $properties = array(
            'path',
            'slug',
            'booted',
            'namespace',
            'registered',
            'databaseAttributes',
        );

        foreach ($properties as $property) {
            $array[$property] = $this->$property;
        }

        return $array;
    }

    /**
     * Converts the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Sets the cache key.
     *
     * @param  string  $key
     * @return void
     */
    public static function setCacheKey($key)
    {
        static::$cacheKey = $key;
    }

    /**
     * Returns the cache key.
     *
     * @return string
     */
    public static function getCacheKey()
    {
        return static::$cacheKey;
    }

    /**
     * Clears the plugins cache.
     *
     * @return void
     */
    protected function forgetCache()
    {
        if ($this->cache) {
            $this->cache->forget(static::$cacheKey);
        }
    }
}
