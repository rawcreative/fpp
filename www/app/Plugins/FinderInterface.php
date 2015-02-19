<?php


namespace FPP\Plugins;

interface FinderInterface
{
    /**
     * Returns an array of fully qualified plugin
     * locations in the registered paths.
     *
     * @return array
     */
    public function findPlugins();

    /**
     * Adds a path to the extensions finder.
     *
     * @param  string  $path
     * @return void
     */
    public function addPath($path);

    /**
     * Returns an array of fully qualified plugin
     * locations in the given path.
     *
     * @param  string  $path
     * @return array
     */
    public function findPluginsInPath($path);
}
