<?php

namespace App\Presenters\Admin;


class StoriesPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Scenes';          //output for view
    protected $view_group_name = 'scenes';       //document of view group
    protected $route_name;      //Route->name()


    // data object or array forEach to do from scenes.
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
            }
        }
        return $arr;
    }


    // trans each one data for output view from scenes.
    public function transOne($data, $other=0)
    {
        $data = parent::transOne($data);
        //
        if ($other){
        }
        return $data;
    }
}
