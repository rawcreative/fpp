<?php


namespace FPP\Plugins;

use ArrayAccess;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use FPP\Plugins\DependencySorter;

class PluginBag extends Collection
{
    /**
     * The Filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * The Plugins Finder instance
     *
     * @var \FPP\Plugins\FinderInterface
     */
    protected $finder;

    /**
     * The IoC container instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     * Constructor.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $filesystem
     * @param  \FPP\Plugins\FinderInterface  $finder
     * @param  \Illuminate\Container\Container  $container
     * @param  array  $plugins
     * @return void
     */
    public function __construct(
        Filesystem $filesystem,
        FinderInterface $finder,
        Container $container = null,
        array $plugins = array(),
        CacheManager $cache = null
    ) {
        $this->filesystem = $filesystem;

        $this->finder = $finder;

        $this->container = $container;

        foreach ($plugins as $plugin) {
            $this->register($plugin);
        }

        $this->cache = $cache;
    }

    /**
     * Creates an Plugin from the given fully qualified plugin file.
     *
     * @param  string  $file
     * @return \FPP\Plugins\PluginInterface
     * @throws \RuntimeException
     */
    public function create($file)
    {
        $attributes = $this->filesystem->getRequire($file);

        if ( ! is_array($attributes) || ! isset($attributes['slug'])) {
            throw new \RuntimeException("Malformed plugin.php at path [{$file}].");
        }

        $slug = $attributes['slug'];

        unset($attributes['slug']);

        $namespace = null;

        if (isset($attributes['namespace'])) {
            $namespace = $attributes['namespace'];

            unset($attributes['namespace']);
        }

        return new Plugin($this, $slug, dirname($file), $attributes, $namespace, $this->cache);
    }

    /**
     * Registers an plugin with the bag.
     *
     * @param  mixed  $plugin
     * @return void
     */
    public function register($plugin)
    {
        if (is_string($plugin)) {
            $plugin = $this->create($plugin);
        }

        $this->registerInstance($plugin);
    }

    /**
     * Sorts all registered plugins by their dependencies.
     *
     * @return void
     */
    public function sortPlugins()
    {
        $sorter = new DependencySorter;

        foreach ($this->all() as $plugin) {
            $sorter->add($plugin->getSlug(), $plugin->getDependencies());
        }

        $plugins = array();

        foreach ($sorter->sort() as $slug) {
            $plugins[$slug] = $this->items[$slug];
        }

        $this->items = $plugins;

        unset($plugins);
    }

    /**
     * Finds and registers Plugins with the Plugin Bag.
     *
     * @return void
     */
    public function findAndRegisterPlugins()
    {
        foreach ($this->finder->findPlugins() as $plugin) {
            $this->register($plugin);
        }
    }

    /**
     * Returns all uninstalled plugins.
     *
     * @return array
     */
    public function allUninstalled()
    {
        return array_filter($this->all(), function (PluginInterface $plugin) {
            return $plugin->isUninstalled();
        });
    }

    /**
     * Returns all installed plugins.
     *
     * @return array
     */
    public function allInstalled()
    {
        return array_filter($this->all(), function (PluginInterface $plugin) {
            return $plugin->isInstalled();
        });
    }

    /**
     * Returns all installed but disabled plugins.
     *
     * @return array
     */
    public function allDisabled()
    {
        return array_filter($this->all(), function (PluginInterface $plugin) {
            return $plugin->isDisabled();
        });
    }

    /**
     * Returns all installed and enabled plugins.
     *
     * @return array
     */
    public function allEnabled()
    {
        return array_filter($this->all(), function (PluginInterface $plugin) {
            return $plugin->isEnabled();
        });
    }

    /**
     * Sets the IoC container associated with plugins.
     *
     * @param  \Illuminate\Container\Container  $container
     * @return void
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Returns the IoC container associated with plugins.
     *
     * @return \Illuminate\Container\Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Registers an instance of an plugin with the bag.
     *
     * @param  \FPP\Plugins\PluginInterface  $plugin
     * @return void
     */
    protected function registerInstance(PluginInterface $plugin)
    {
        $plugin->register();

        $this->items[$plugin->getSlug()] = $plugin;
    }
}
