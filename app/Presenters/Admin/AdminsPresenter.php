<?php

namespace App\Presenters\Admin;



class AdminsPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Admins';          //output for view
    protected $view_group_name = 'admins';       //document of view group
    protected $route_name = 'admin.admins';      //Route->name()

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
