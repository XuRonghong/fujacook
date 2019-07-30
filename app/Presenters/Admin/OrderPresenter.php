<?php

namespace App\Presenters\Admin;

use App\Presenters\Presenter;

class OrderPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Orders';          //output for view
    protected $view_group_name = 'order';       //document of view group
    protected $route_name;      //Route->name()
    protected $selectOptions;   //HTML元素

    public function __construct()
    {
        $this->selectOptions = [
            'payment_method_id' => [
                /* 從資料庫得到 from database. */
            ],
            'shipping_type' => [
                1 => '自取',
                2 => '黑貓寄送',
            ],
            'shipping_status' => [
                1 => '未出貨',
                2 => '出貨中',
                3 => '已出貨',
            ],
            'pay_status' => [
                1 => '未付款',
                2 => '已付款',
                3 => '已取消授權',
                4 => '已請款',
                8 => '退貨',
                9 => '付款失敗',
                0 => '取消',
            ],
            'order_details' => [
                0 => '正常訂購',
                1 => '追加數量',
                2 => '減少數量',
                3 => '補繳',
                4 => '退費',
            ],
            'order_contacts' => [
                1 => '訂購人資料',
                2 => '收件人資料',
            ],
        ];
    }

    //
    public function setSelectOpt($ORM=null, $selectOpts='payment_method_id')
    {
        if($ORM){
            $options = array();
            foreach ($ORM as $key => $val){
                $options[ $val['id'] ] = $val['name'];
            }
            if($options) $this->selectOptions[$selectOpts] = $options;
        } else return null;
    }

    // data object or array forEach to do from scenes.
    public function eachOne_aaData($arr, $from='')
    {
        if ( $arr['aaData']) {
            if ($from=='product_spec') {
                foreach ($arr['aaData'] as $key => $var) {
                    //翻譯每個type
                    $var->product_id = $this->tranTypeInSelectOption($var->product_id, $this->selectOptions);
                    //找圖片檔案
                    $images = $var->image ? array($var->image) : $this->transFileIdtoImage($var->file_id); //有圖檔就不用去file找
                    $var->image = $this->presentImages($images);
                    //
                    $var->status = $this->presentStatus($var->open);
                    // trans Unit
                    $var->spec_price = '$'. $var->spec_price.' /'.($var->spec_unit?:trans('web.default_unit'));
                    // trans Unit
                    $var->spec_stock .= ' ('.($var->spec_unit?:trans('web.default_unit')).' )';
                }
            } else {
                foreach ($arr['aaData'] as $key => $var) {
                    //mass_destroy
                    $var->checkbox = $this->presentCheckBox($var->id);
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
        }
        return $arr;
    }

    // trans each one data for output view from scenes.
    public function transOne($data, $other=0, $other2=0)
    {
        $data = parent::transOne($data);

        //get option for select with scenes type
        if ($other){
            $data['options'] = $this->getSelectOption($other, $data['type']);
        }
        if ($other2){
            $data['options_pdt'] = $this->getSelectOption($other2, $data['product_id']);
        }
        return $data;
    }

    // 製造 HTML 元素 select option
    public function getSelectOption($type, $selected='', $opt = '')
    {
        if (strpos($selected, ',')) {   //int,int,int
            foreach ($this->selectOptions[$type] as $key => $val) {     // multiple selected
                $opt .= '<option value="' . $key . '" ' . (strpos($selected, ''.$key)>-1 ? 'selected' : '') . '>' . $val . '</option>';
            }
        } else {        //int
            foreach ($this->selectOptions[$type] as $key => $val) {     // single selected
                $opt .= '<option value="' . $key . '" ' . ($selected == $key ? 'selected' : '') . '>' . $val . '</option>';
            }
        }
        return $opt;
    }
}
