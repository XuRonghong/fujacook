<?php

namespace App\Presenters\Admin;


class PermissionPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Permissions';          //output for view
    protected $view_group_name = 'permissions';       //document of view group
    protected $route_name;      //Route->nam


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
