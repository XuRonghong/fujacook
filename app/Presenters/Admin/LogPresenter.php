<?php

namespace App\Presenters\Admin;


class LogPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Log';          //output for view
    protected $view_group_name = 'log';       //document of view group
    protected $route_name;      //Route->name()


    // data object or array forEach to do from log.
    function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                // Admin
                if ($var->type < 100) {
                    $var->user_name = $this->getUserName('admin', $var->user_id);
                    $var->user_type = $this->transUserType($var->user_type);
                }
                // Member
//                elseif ($var->type > 100) {
//                }
            }
        }
        return $arr;
    }

    // trans each one data for output view from log.
    function tranOne($data, $other=0)
    {
        $data['type'] = $this->transUserType($data['type']);
        if ($other){
            $data['value'] = str_replace(':',': <b>', $data['value']);
            $data['value'] = str_replace(',','</b>,<br>', $data['value']);
            $data['value'] = str_replace('\/','/', $data['value']);
        }
        return $data;
    }
}
