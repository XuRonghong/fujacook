<?php

namespace App\Presenters\Admin;


class NewsPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'News';          //output for view
    protected $view_group_name = 'news';       //document of view group
    protected $route_name;      //Route->name()


    // data object or array forEach to do from news.
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                //找圖片檔案
                $var = $this->transFileIdtoImage($var);
            }
        }
        return $arr;
    }

    // trans each one data for output view from news.
    function tranOne($data, $other=0)
    {
        $data = parent::transOne($data);
        //
        if ($other){
        }
        return $data;
    }
}
