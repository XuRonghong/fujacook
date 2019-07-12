<?php

namespace App\Presenters\Admin;

use App\Presenters\Presenter;

class PermissionPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Permissions';          //output for view
    protected $view_group_name = 'permissions';       //document of view group
    protected $route_name;      //Route->nam

    // data object or array forEach to do from menus.
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                //
                $var->status = $this->presentStatus();
            }
        }
        return $arr;
    }

    // data object or array forEach to do from adminPermission.
    public function eachOne_aaData_adminPermission($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                //
                $var->status = $this->presentStatus_adminPermission($var->open);
            }
        }
        return $arr;
    }

    //
    public function presentStatus($status=0)
    {
        $btn = '';
        $btn .= '<button class="btn btn-xs btn-show" title="詳情"><i class="fa fa-book" aria-hidden="true"></i></button>';
        $btn .= '<button class="btn btn-xs btn-edit" title="修改"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>';
        $btn .= '<button class="btn btn-xs btn-del pull-right" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';

        return $btn;
    }

    //
    public function presentStatus_adminPermission($status=0)
    {
        switch ($status) {
            case 1: $btn = '<button class="btn btn-xs btn-success btn-open">已啟用</button>'; break;
            case 0: $btn = '<button class="btn btn-xs btn-primary btn-open">未啟用</button>'; break;
            case '1': $btn = '<button class="btn btn-xs btn-success btn-open">已啟用</button>'; break;
            case '0': $btn = '<button class="btn btn-xs btn-primary btn-open">未啟用</button>'; break;
            default: $btn = "無功能";
        }
        return $btn;
    }
}
