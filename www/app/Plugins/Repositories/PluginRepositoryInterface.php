<?php

namespace FPP\Plugins\Repositories;


interface PluginRepositoryInterface {

    /**
     * Returns all the plugins.
     *
     * @return array
     */
    public function findAll();
    /**
     * Returns an plugin by its primary key.
     *
     * @param  int  $id
     * @return \FPP\Plugins\Plugin
     */
    public function find($id);

}