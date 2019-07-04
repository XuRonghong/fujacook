<?php

namespace App\Presenters\Admin;



class SettingPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Setting';          //output for view
    protected $view_group_name = 'setting';       //document of view group
    protected $route_name;      //Route->name()


    // data object or array forEach to do from setting.
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {

            }
        }
        return $arr;
    }


    public function transOne($data, $other=0)
    {
        $data['content'] = json_decode($data['content']);
        if ($other){

        }
        return $data;
    }
}
