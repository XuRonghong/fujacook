<?php

namespace App\Presenters\Admin;

use App\Menu;

class MenuPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Menu';          //output for view
    protected $view_group_name = 'menus';       //document of view group
    protected $route_name;      //Route->name()

    // data object or array forEach to do from menus.
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                $var->Title = trans('menu.'. $var->name. '.title');
                //
                $var->parent_id = $this->presentIsEdit('parent_id', $var->parent_id);
                $var->rank = $this->presentIsEdit('rank', $var->rank);
                $var->name = $this->presentIsEdit('name', $var->name);
                $var->link = $this->presentIsEdit('link', $var->link);
                $var->sub_menu = $this->presentIsEdit('sub_menu', $var->sub_menu);
                $var->open = $this->presentIsEdit('open', $var->open);
                //
                $var->status = $this->presentStatus();
            }
        }
        return $arr;
    }

    // data object or array forEach to do from admin_menu.
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

    //
    public function presentStatus($status=0)
    {
        // current_data[row.id] = row;
        $btn = '';
//        $btn .= '<button class="btn btn-xs btn-show" title="詳情"><i class="fa fa-book" aria-hidden="true"></i></button>';
//        $btn .= '<button class="btn btn-xs btn-edit" title="修改"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>';
        $btn .= '<button class="btn btn-xs btn-del pull-right" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';

        return $btn;
    }
}
