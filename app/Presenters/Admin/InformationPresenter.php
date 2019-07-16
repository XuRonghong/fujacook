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
//                'navbar.home' => '首頁選單欄位',
//                'navbar.intr' => '介紹頁選單',
            ],
//            'slider' => [
//                'slider.home' => '首頁滑動圖',
//                'slider.intr' => '介紹頁滑動圖',
//                'slider.product' => '商品頁滑動圖',
//            ],
//            'introduce' => [
//                'introduce.home' => '首頁文字',
//                'introduce.intr' => '介紹頁文字',
//            ],
//            'image' => [
//                'image.home' => '首頁圖片',
//                'image.home.60601' => '首頁圖片1',
//                'image.home.60602' => '首頁圖片2',
//                'image.home.60603' => '首頁圖片3',
//                'image.intr' => '介紹頁圖片',
//            ],
//            'footer' => [
//                'footer.home' => '首頁',
//                'footer.intr' => '介紹頁',
//            ],
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
//                $var->type = $this->tranTypeInSelectOption($var->type, $this->selectOptions);
                //找圖片檔案
                $images = $var->image ? array($var->image) : $this->transFileIdtoImage($var->file_id); //有圖檔就不用去file找
                $var->image = $this->presentImages($images);    //轉換輸出HTML
                //
                $var->status = $this->presentStatus($var->open);
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
