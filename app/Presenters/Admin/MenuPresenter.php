<?php

namespace App\Presenters\Admin;



use App\Menu;

class MenuPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Menu';          //output for view
    protected $view_group_name = 'menus';       //document of view group
    protected $route_name;      //Route->name()


    /*
     * data object or array forEach to do.
     */
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                $var->Title = trans('menu.'. $var->name. '.title');
            }
        }
        return $arr;
    }


    /* data object or array forEach to do. for admin_menu */
    public function eachOne_aaData_adminMenu($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                //
                $menu = Menu::query()->find($var->menu_id);
                $var->menu_name = trans('menu.'. $menu->name. '.title') .'&nbsp;<b>('.$menu->name.')</b>';
            }
        }
        return $arr;
    }
}
