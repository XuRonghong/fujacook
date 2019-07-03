<?php

namespace App\Presenters\Admin;


class PermissionPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Permissions';          //output for view
    protected $view_group_name = 'permissions';       //document of view group
    protected $route_name;      //Route->nam
}
