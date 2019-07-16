<?php

namespace App\Presenters\Admin;

use App\Presenters\Presenter;

class ProductPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Products';          //output for view
    protected $view_group_name = 'product.manage';       //document of view group
    protected $route_name;      //Route->name()
    protected $selectOptions;   //HTML元素

    public function __construct()
    {
        $this->selectOptions = [
            'product_cate' => [
                /* 從資料庫得到 from database. */
            ],
        ];
    }

    //
    public function setSelectOpt($ORM=null)
    {
        if($ORM){
            $options = array();
            foreach ($ORM as $key => $val){
                $options[ $val['id'] ] = $val['name'];
            }
            if($options) $this->selectOptions['product_cate'] = $options;
        } else return null;
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
