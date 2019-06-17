<?php

namespace App\Presenters\Admin;



class MenuPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Menu';          //output for view
    protected $view_group_name = 'menus';       //document of view group
    protected $route_name = 'admin.menus';      //Route->name()

    public function __construct()
    {
        $this->gotoUrl = route($this->route_name.'.index');
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