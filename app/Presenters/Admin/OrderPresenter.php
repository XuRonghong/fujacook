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
            'type' => [
                /* NULL */
            ],
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
            'status' => [
                0 => '未處理',
                1 => '已確認',
                2 => '已取消',
                3 => '已折讓',
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

    // data object or array forEach to do from list.
    public function eachOne_aaData($arr, $from='')
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                //翻譯每個type
                foreach (array_keys($this->selectOptions) as $column){
                    $var->$column = $this->getHTML_select($column, $var->$column);
                }
                //
                $var->status = $this->presentStatus($var->status);
            }
        }
        return $arr;
    }

    // trans each one data for output view from create.
    public function transOne($data, $other=0)
    {
        if ($data) $data = parent::transOne($data);

        //get option for select with
        if ($other){
            foreach (array_keys($this->selectOptions) as $column) {
                $data[$column] = $this->getSelectOption($column, $data->$column);
            }
        }
        return $data;
    }

    // 製造 HTML 元素 select
    public function getHTML_select($column, $current=null, $number=1)
    {
        return '<select class="form-control dt-choose '.$column.'" id="chos'.$number++.'" data-name="'.$column.'">'.
                    $this->getSelectOption($column, $current).
                '</select>';
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

    // panel HTML
    public function presentStatus($status)
    {
        $btn = '';
        $btn .= '<button class="btn btn-xs btn-show" title="'.trans('options.panel.show').'"><i class="fa fa-book" aria-hidden="true"></i></button>';
//        $btn .= '<button class="btn btn-xs btn-edit" title="'.trans('options.panel.edit').'"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>';

        return $btn;
    }
}
