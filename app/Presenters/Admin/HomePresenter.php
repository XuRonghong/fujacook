<?php

namespace App\Presenters\Admin;

use App\Presenters\Presenter;

class HomePresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Fujacook backend';          //output for view
    protected $view_group_name = 'admins';       //document of view group
    protected $route_name;      //Route->name()
    protected $selectOptions;   //HTML元素
}
