<?php

namespace App\Presenters\Admin;

use App\Presenters\Presenter;

class ScenesPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Scenes';          //output for view
    protected $view_group_name = 'scenes';       //document of view group
    protected $route_name;      //Route->name()

    protected $selectOptions;   //HTML元素

    public function __construct()
    {
        $this->selectOptions = [
            'navbar' => [
                'navbar.home' => trans('options.scenes.navbar.home'), //'首頁選單欄位',
                'navbar.about' => trans('options.scenes.navbar.about'), //'關於FUJACOOK 中間選項',
            ],
            'slider' => [
                'slider.home' => trans('options.scenes.slider.home'), //'首頁滑動圖',
                'slider.about' => trans('options.scenes.slider.about'), //'關於FUJACOOK',
            ],
            'introduce' => [
                'introduce.home.t01' => trans('options.scenes.introduce.home.t01'), //'首頁文字',
                'introduce.about.t01' => trans('options.scenes.introduce.about.t01'), //'關於FUJACOOK t1',
                'introduce.about.t03' => trans('options.scenes.introduce.about.t03'), //'關於FUJACOOK t3',
                'introduce.about.t05' => trans('options.scenes.introduce.about.t05'), //'關於FUJACOOK t5',
            ],
            'image' => [
                'image.home.section1' => trans('options.scenes.image.home.section1'), //'首頁 圖片1',
//                'image.home.section2' => trans('options.scenes.image.home.section2'), //'首頁 圖片2',
                'image.home.section3' => trans('options.scenes.image.home.section3'), //'首頁 產品圖片',
//                'image.about.section1' => trans('options.scenes.image.about.section1'), //'關於FUJACOOK 圖片1',
            ],
            'footer' => [
                'footer.home' => trans('options.scenes.footer.home'), //'首頁',
                'footer.about' => trans('options.scenes.footer.home'), //'關於FUJACOOK',
            ],
        ];
    }

    // data object or array forEach to do from scenes.
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
                $var->image = $this->presentImages($images);
                //
                $var->status = $this->presentStatus($var->open);
            }
        }
        return $arr;
    }

    // trans each one data for output view from scenes.
    public function transOne($data, $other=0)
    {
        $data = parent::transOne($data);

        //get option for select with scenes type
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
