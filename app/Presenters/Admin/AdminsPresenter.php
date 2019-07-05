<?php

namespace App\Presenters\Admin;

use App\AdminInfo;


class AdminsPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Admins';          //output for view
    protected $view_group_name = 'admins';       //document of view group
    protected $route_name;      //Route->name()

    protected $selectOptions;   //HTML元素

    public function __construct()
    {
        $this->selectOptions = [
            'admins' => [
                '5' => '管理者',
                '10' => '普通者',
            ],
            'member' => [
                '101' => '董事長',
                '111' => '總經理',
                '201' => '財務部經理',
                '301' => '人事部經理',
                '310' => '人事部副理',
            ],
        ];
    }

    // data object or array forEach to do from admins.
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                //翻譯每個type
                $var->type = $this->tranTypeInSelectOption($var->type, $this->selectOptions);
                //
                $var->info = AdminInfo::query()->where('admin_id', $var->id)->first();
            }
        }
        return $arr;
    }

    // trans each one data for output view from scenes.
    public function transOne($data, $other=0)
    {
//        $data = parent::transOne($data);

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
