<?php

namespace App\Presenters\Admin;



class ScenesPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Scenes';          //output for view
    protected $view_group_name = 'scenes';       //document of view group
    protected $route_name = 'admin.scenes';      //Route->name()

    public function __construct()
    {
//        $this->gotoUrl = route($this->route_name.'.index');
    }

    public function getViewName()
    {
        return $this->view_group_name;
    }

    public function getRouteName()
    {
        return $this->route_name;
    }

    public function setViewName($name)
    {
        return $this->view_group_name = $name;
    }

    public function setRouteName($name)
    {
        $this->route_name = $name;
        $this->gotoUrl = route($this->route_name.'.index');
        return $this->route_name;
    }
}
