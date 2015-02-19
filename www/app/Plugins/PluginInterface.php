<?php


namespace FPP\Plugins;


interface PluginInterface extends DependentInterface
{
    /**
     * Returns the plugin slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Returns the plugin path.
     *
     * @return string
     */
    public function getPath();

    /**
     * Returns the plugin namespace.
     *
     * @return string
     */
    public function getNamespace();

    /**
     * Returns the plugin vendor name.
     *
     * @return string
     */
    public function getVendor();

    /**
     * Returns all the dependencies of the plugin.
     *
     * @return array
     */
    public function getDependencies();

    /**
     * Checks if the plugin is versioned or not.
     *
     * @return bool
     */
    public function isVersioned();

    /**
     * Returns the plugin version.
     *
     * @return string
     */
    public function getVersion();

    /**
     * Checks if the plugin can be installed or not.
     *
     * @return bool
     */
    public function canInstall();

    /**
     * Checks if the plugin is installed.
     *
     * @return bool
     */
    public function isInstalled();

    /**
     * Installs the plugin.
     *
     * @return void
     * @throws \RuntimeException
     */
    public function install();

    /**
     * Checks if the plugin can be uninstalled.
     *
     * @return bool
     */
    public function canUninstall();

    /**
     * Checks if the plugin is uninstalled.
     *
     * @return bool
     */
    public function isUninstalled();

    /**
     * Uninstalls the plugin.
     *
     * @return void
     * @throws \RuntimeException
     */
    public function uninstall();

    /**
     * Checks if the plugin can be enabled.
     *
     * @return bool
     */
    public function canEnable();

    /**
     * Checks if the plugin is enabled.
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Enables the plugin.
     *
     * @return void
     * @throws \RuntimeException
     */
    public function enable();

    /**
     * Checks if the plugin can be disabled.
     *
     * @return bool
     */
    public function canDisable();

    /**
     * Checks if the plugin is disabled.
     *
     * @return bool
     */
    public function isDisabled();

    /**
     * Disables the plugin.
     *
     * @return void
     * @throws \RuntimeException
     */
    public function disable();

    /**
     * Checks if the plugin has service providers.
     *
     * @return bool
     */
    public function hasProviders();

    /**
     * Checks if the plugin needs to be upgraded.
     *
     * @return bool
     */
    public function needsUpgrade();

    /**
     * Upgrades the plugin.
     *
     * @return void
     * @throws \RuntimeException
     */
    public function upgrade();

    /**
     * Checks if the plugin is registered.
     *
     * @return bool
     */
    public function isRegistered();

    /**
     * Register the plugin, this is done while adding the
     * plugin to the plugin bag. All the plugins
     * should be registered befored being booted.
     *
     * @return void
     */
    public function register();

    /**
     * Checks if the plugin is booted.
     *
     * @return bool
     */
    public function isBooted();

    /**
     * Boots the plugin.
     *
     * @return void
     * @throws \RuntimeException
     */
    public function boot();
}
