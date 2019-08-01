<?php

namespace App\Presenters\Admin;

use App\Presenters\Presenter;
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
                '5' => trans('options.admin.admins.5'), //'管理者',
                '10' => trans('options.admin.admins.10'), // '普通者',
            ],
            'member' => [
                '101' => trans('options.admin.member.101'), //'董事長',
                '111' => trans('options.admin.member.111'), //'總經理',
                '201' => trans('options.admin.member.201'), //'財務部經理',
                '301' => trans('options.admin.member.301'), //'人事部經理',
                '310' => trans('options.admin.member.310'), //'人事部副理',
            ],
        ];
    }

    // data object or array forEach to do from admins.
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                //
                $var->type = $this->tranTypeInSelectOption($var->type, $this->selectOptions);
                //
                $var->info = AdminInfo::query()->where('admin_id', $var->id)->first();
                //
                $var->rank = $this->presentIsEdit('rank', $var->rank);
                //
                $var->user_image = $this->presentImage($var->info['user_image']);
                //
                if ($var->id == auth()->guard('admin')->user()->id){
                    $var->status = '';
                } else {
                    $var->status = $this->presentStatus($var->active);
                }
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

    // 製造 HTML
    public function presentImage($image)
    {
        return "<img width='100%' src=". $image .">";
//        $html_str = "";
//        foreach($image as $key => $var) {
//         $html_str .= "<img width='75px' src=". $image[$key] ." style='margin:5px;'>";
//        }
//         return $html_str;
    }

    // 製造 HTML
    public function presentStatus($status=null)
    {
        switch ($status) {
            case 1: $btn = '<button class="btn btn-xs btn-success btn-open">'.trans('options.panel.status.open').'</button>'; break;
            case 0: $btn = '<button class="btn btn-xs btn-primary btn-open">'.trans('options.panel.status.close').'</button>'; break;
            case '1': $btn = '<button class="btn btn-xs btn-success btn-open">'.trans('options.panel.status.open').'</button>'; break;
            case '0': $btn = '<button class="btn btn-xs btn-primary btn-open">'.trans('options.panel.status.close').'</button>'; break;
            default: $btn = trans('options.panel.status.not'); //"無功能";
        }
        $btn .= '<button class="btn btn-xs btn-show" title="'.trans('options.panel.show').'"><i class="fa fa-book" aria-hidden="true"></i></button>';
        $btn .= '<button class="btn btn-xs btn-edit" title="'.trans('options.panel.edit').'"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>';
//        $btn .= '<button class="btn btn-xs btn-del pull-right" title="'.trans('options.panel.del').'"><i class="fa fa-trash" aria-hidden="true"></i></button>';

        return $btn;
    }
}
