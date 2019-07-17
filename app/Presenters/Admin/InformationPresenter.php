<?php

namespace App\Presenters\Admin;

use App\Presenters\Presenter;

class InformationPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'News';          //output for view
    protected $view_group_name = 'information.news';       //document of view group
    protected $route_name;      //Route->name()
    protected $selectOptions;   //HTML元素

    public function __construct()
    {
        $this->selectOptions = [
            'news' => [
                'news.new' => '最新消息',
                'news.important' => '重要消息',
            ],
            'report' => [
                'report.new' => '最新報導',
                'report.hot' => '熱門報導',
            ],
        ];
    }

    // data object or array forEach to do from news.
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                //
                $var->rank = $this->presentIsEdit('rank', $var->rank);
                //翻譯每個type
                $var->type = $this->tranTypeInSelectOption($var->type, $this->selectOptions);
                //找圖片檔案
                $images = $var->image ? array($var->image) : $this->transFileIdtoImage($var->file_id); //有圖檔就不用去file找
                $var->image = $this->presentImages($images, 4);    //轉換輸出HTML
                //
                $var->status = $this->presentStatus($var->open);
            }
        }
        return $arr;
    }

    // trans each one data for output view from news.
    function tranOne($data, $other='')
    {
        $data = parent::transOne($data);
        //
        if ($other){
            $data['options'] = $this->getSelectOption($other, $data['type']);
        }
        return $data;
    }

    // 製造 HTML 元素 select option
    public function getSelectOption($type, $selected='', $opt = '')
    {
        foreach ($this->selectOptions[$type] as $key => $val) {
            $opt .= '<option value="'.$key.'" '. ($selected==$key?'selected':'') .'>'.$val.'</option>';
        }
        return $opt;
    }
}
