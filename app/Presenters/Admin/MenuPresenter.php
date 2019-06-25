<?php

namespace App\Presenters\Admin;



class MenuPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Menu';          //output for view
    protected $view_group_name = 'menus';       //document of view group
    protected $route_name;      //Route->name()

}
