<?php


namespace FPP\Plugins;

use Illuminate\Filesystem\Filesystem;

class FileFinder implements FinderInterface
{
    /**
     * The Filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * The array of paths.
     *
     * @var array
     */
    protected $paths = array();

    /**
     * Constructor.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $filesystem
     * @param  array  $paths
     * @return void
     */
    public function __construct(Filesystem $filesystem, array $paths)
    {
        $this->paths = $paths;

        $this->filesystem = $filesystem;
    }

    /**
     * {@inheritDoc}
     */
    public function findPlugins()
    {
        $extensions = array();

        foreach ($this->paths as $path) {
            $extensions = array_merge($extensions, $this->findPluginsInPath($path));
        }

        return $extensions;
    }

    /**
     * {@inheritDoc}
     */
    public function addPath($path)
    {
        $this->paths[] = $path;
    }

    /**
     * {@inheritDoc}
     */
    public function findPluginsInPath($path)
    {
        $extensions = $this->filesystem->glob($path.'/*/*/plugin.php');

        if ($extensions === false) {
            return array();
        }

        return $extensions;
    }
}
