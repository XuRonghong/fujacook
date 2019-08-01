<?php

namespace App\Presenters\Admin;

use App\Order;
use App\Presenters\Presenter;
use Illuminate\Support\Facades\DB;

class OrderPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Orders';          //output for view
    protected $view_group_name = 'order';       //document of view group
    protected $route_name;      //Route->name()
    protected $selectOptions;   //HTML元素

    public function __construct(Order $model)
    {
        $this->model = $model;
        //
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
        }
        else return null;
    }

    // data object or array forEach to do from list.
    public function eachOne_aaData($arr, $from='order')
    {
        if ( $arr['aaData']) {
            $type = 0;
            foreach ($arr['aaData'] as $key => $var) {
                //共通做法
                $var->operate = $this->presentStatus();
                //from controller.
                if ($from == 'order')
                {
                    //
                    $var->operate = $this->presentOperate(
                        $var->operate,
                        trans('menu.order.contact.title'),
                        route('admin.order.contact.index', ['o_no'=> $var->no]),
                        'fa fa-plane'
                    );
                    //select : 轉換每個選擇物件
                    foreach (array_keys($this->selectOptions) as $column) {
                        $var->$column = $this->getHTML_select($column, $var->$column);
                    }
                    //
                    $var->no = $this->presentAnchor($var->no, route('admin.order.detail.index', ['o_no'=> $var->no]));
                }
                elseif ($from == 'order_details')
                {
                    // product : trans product_id
                    switch ($var->related){
//                        case 'product_specs': $map['product_id'] = $var->product_id; break;
                        default: $map = [];
                    }
                    $Dao = DB::table($var->related)->where('id', $var->ownerKey)->where($map)->first();
                    //找圖片檔案 from product
                    $images = $Dao->image ? array($Dao->image) : $this->transFileIdtoImage($Dao->file_id); //有圖檔就不用去file找
                    $var->image = $this->presentImages($images);

                    //select : 轉換每個選擇物件
                    $type = $var->type;
                    foreach (array_keys($this->selectOptions) as $column){
                        //If type of order_details want exception handle. 訂單明細特別處理。
                        if ($column==$from) {
                            $var->$column = $this->getHTML_select($column, $type);
                            continue;
                        }
                        $var->$column = $this->getHTML_select($column, $var->$column);
                    }
                }
                elseif ($from == 'order_contacts')
                {
                    $var->type = $this->tranTypeInSelectOption($var->type, $this->selectOptions, 'order_contacts');
                }
            }
        }
        return $arr;
    }

    // trans each one data for output view from create.
    public function transOne($data, $model=null)
    {
        //get option for select with
        if ($model){
            if ($model->getTable() == 'order_details') {
                // product : trans product_id
                switch ($data->related){
//                        case 'product_specs': $map['product_id'] = $var->product_id; break;
                    default: $map = [];
                }
                $Dao = DB::table($data->related)->where('id', $data->ownerKey)->where($map)->first();
                //找圖片檔案 from product
                $data->image = $Dao->image ? array($Dao->image) : $this->transFileIdtoImage($Dao->file_id); //有圖檔就不用去file找

                //select : 轉換每個選擇物件
                $type = $data->type;
                foreach (array_keys($this->selectOptions) as $column){
                    //If type of order_details want exception handle. 訂單明細特別處理。
                    if ($column == $model->getTable()) {
                        $data->$column = $this->getSelectOption($column, $type);
                        continue;
                    }
                    $data->$column = $this->getSelectOption($column, $data->$column);
                }
            }
            elseif ($model->getTable() == 'order_contacts') {
                //select : 轉換每個選擇物件
                $type = $data->type;
                foreach (array_keys($this->selectOptions) as $column){
                    $data->$column = ($column == $model->getTable()) ? $this->getSelectOption($column, $type) : $this->getSelectOption($column, $data->$column);
                }
            }
            else {
                foreach (array_keys($this->selectOptions) as $column) {
                    $data->$column = $this->getSelectOption($column, $data->$column);
                }
            }
            //共通做法
        } else {
            foreach (array_keys($this->selectOptions) as $column) {
                $data[$column] = $this->getSelectOption($column);
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
    public function presentStatus($status=null, $hasContact=0)
    {
        return '<button class="btn btn-xs btn-show" title="'.trans('options.panel.show').'"><i class="fa fa-book" aria-hidden="true"></i></button>';
    }
}
