<?php


namespace FPP\Plugins\Repositories;


use FPP\Plugins\PluginBag;

class PluginRepository implements PluginRepositoryInterface {

    protected $plugins;

    public function __construct(PluginBag $plugins)
    {
        $this->plugins = $plugins;
    }
    /**
     * Returns all the plugins.
     *
     * @return array
     */
    public function findAll()
    {
        return $this->plugins->all();
    }

    /**
     * Returns an plugin by its primary key.
     *
     * @param  int $id
     * @return \FPP\Plugins\Plugin
     */
    public function find($id)
    {
        return $this->plugins->get($id);
    }

    /**
     * Returns all installed plugins
     * @return array
     */
    public function findInstalled()
    {
        return $this->plugins->allInstalled();
    }

    /**
     * Executes the given action on the given plugin.
     *
     * @param  string  $slug
     * @param  string  $action
     * @return \FPP\Plugins\Plugin
     */
    protected function modifyPlugin($slug, $action)
    {
        $plugin = $this->find($slug);
        return $plugin->{$action}($slug);
    }

    /**
     * Magic method.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     */
    public function __call($method, $parameters = [])
    {
        if (in_array($method, ['install', 'uninstall', 'enable', 'disable']))
        {
            return $this->modifyPlugin($parameters[0], strtolower($method));
        }
        parent::__call($method, $parameters);
    }


}