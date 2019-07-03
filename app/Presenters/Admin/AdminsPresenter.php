<?php

namespace App\Presenters\Admin;


use App\AdminInfo;

class AdminsPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Admins';          //output for view
    protected $view_group_name = 'admins';       //document of view group
    protected $route_name;      //Route->name()


    /*
     * data object or array forEach to do.
     */
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                $var->info = AdminInfo::query()->where('admin_id', $var->id)->first();
            }
        }
        return $arr;
    }
}
