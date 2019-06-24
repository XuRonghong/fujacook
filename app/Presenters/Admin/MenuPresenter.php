<?php

namespace App\Presenters\Admin;



class MenuPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Menu';          //output for view
    protected $view_group_name = 'menus';       //document of view group
    protected $route_name;      //Route->name()


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

    public function getViewName()
    {
        return $this->view_group_name;
    }

    public function getRouteName()
    {
        return $this->route_name;
    }
}
