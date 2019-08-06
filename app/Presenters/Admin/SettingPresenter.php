<?php

namespace App\Presenters\Admin;

use App\Presenters\Presenter;

class SettingPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Setting';          //output for view
    protected $view_group_name = 'setting';       //document of view group
    protected $route_name;      //Route->name()
    protected $selectOptions;   //HTML元素

    public function __construct()
    {
        $this->selectOptions = [
            'search_keyword' => [
//                'app' => 'app',
//                'meta' => 'meta',
                'search_keyword' => 'search_keyword',
            ],
            'parameters' => [
                'app' => 'app',
                'meta' => 'meta',
                'search_keyword' => 'search_keyword',
                'backend-global_keyword' => 'backend-global_keyword',
            ],
//            'global_keyword' => [
//                'app' => 'app',
//                'meta' => 'meta',
//            ],
        ];
    }

    // data object or array forEach to do from setting.
    public function eachOne_aaData($arr, $selector='')
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                //
                $var->rank = $this->presentIsEdit('rank', $var->rank);
                //
                $var->name = $this->presentIsEdit('name', $var->name);
                //
                $var->value = $this->presentIsEdit('value', $var->value);
                //
                $var->status = $this->presentStatus_agent($var->open, $selector);
            }
        }
        return $arr;
    }


    public function transOne($data, $other=0)
    {
        $data['content'] = json_decode($data['content'], true);
        if ($other){
            $data['options'] = $this->getSelectOption($other, $data['type']);
        }
        return $data;
    }

    // 製造 HTML 元素 select option
    public function getSelectOption($type, $selected='', $opt='')
    {
        foreach ($this->selectOptions[$type] as $key => $val) {
            $opt .= '<option value="'.$key.'" '. ($selected==$key?'selected':'') .'>'.$val.'</option>';
        }
        return $opt;
    }

    // agent/proxy to present status.
    public function presentStatus_agent($status, $selector='', $btn='')
    {
        switch ($selector) {
            case 'search_keyword':
                return $this->presentStatus($status);
            case 'global_keyword':
                $btn .= '<button class="btn btn-xs btn-del pull-right" title="'.trans('options.panel.del').'"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                break;
            default:
                $btn .= '<button class="btn btn-xs btn-show" title="'.trans('options.panel.show').'"><i class="fa fa-book" aria-hidden="true"></i></button>';
                $btn .= '<button class="btn btn-xs btn-edit" title="'.trans('options.panel.edit').'"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>';
                $btn .= '<button class="btn btn-xs btn-del pull-right" title="'.trans('options.panel.del').'"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                break;
        }
        return $btn;
    }

    public function setBreadcrumb($new=[])
    {
        return $this->breadcrumb = array_merge($this->breadcrumb, $new);
    }
}
