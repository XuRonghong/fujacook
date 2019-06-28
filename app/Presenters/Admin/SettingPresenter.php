<?php

namespace App\Presenters\Admin;



class SettingPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Setting';          //output for view
    protected $view_group_name = 'setting';       //document of view group
    protected $route_name;      //Route->name()

}
