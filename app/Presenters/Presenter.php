<?php

namespace App\Presenters\Admin;

use App\Permission;

abstract class Presenter
{
    public function getRouteResource($route_name = '')
    {
        return [
            'index' => route($route_name.'.index'),
            'list' => route($route_name.'.list'),
            'create' => route($route_name.'.create'),
            'store' => route($route_name.'.store'),
            'edit'  => route($route_name.'.index'),
            'update' => url(str_replace('.','/',$route_name)).'/update',
            'destroy' => url(str_replace('.','/',$route_name).'/destroy'),
            'show' => route($route_name.'.index'),
        ];
    }

    public function getParameters($index=null)
    {
        $data = [
            'indexUrl' => url('admin'),
            'logoutUrl' => route('admin.logout'),
            'dark_logo' => asset('xtreme-admin/assets/images/logo-icon.png'),
            'light_logo' => asset('xtreme-admin/assets/images/logo-light-icon.png'),
            'dark_logo_text' => asset('xtreme-admin/assets/images/logo-text.png'),
            'light_logo_text' => asset('xtreme-admin/assets/images/logo-light-text.png'),
            'admin_logo' => asset('xtreme-admin/assets/images/users/1.jpg'),
            'admin_name' => 'Steave Jobs',
            'admin_email' => 'varun@gmail.com',
        ];
        switch ($index){
            case 'index':
                $data = array_merge($data, [
                    'Title' => $this->title,
                    'Summary' => '',
                ]);
                break;
            case 'create':
                $data = array_merge($data, [
                    'Title' => $this->title.' create',
                    'Summary' => '',
                ]);
                break;
            case 'edit':
                $data = array_merge($data, [
                    'Title' => $this->title.' edit',
                    'Summary' => '',
                ]);
                break;
            case 'show':
                $data = array_merge($data, [
                    'Title' => $this->title.' show',
                    'Summary' => '',
                    'Disable'   => true
                ]);
                break;
            default :
                $data = array_merge($data, [
                    'Title' => '',
                    'Summary' => '',
                ]);
        }

        $nav = [
            'news' => route('admin.news.index'),
            'store' => route('admin.store.index'),
            'permissions' => route('admin.permissions.index'),
        ];
        $data['nav'] = $nav;
        $menu = [];
        $data['menu'] = $menu;

        return $data;
    }

    public function getMenu()
    {
        $index = '';
        $permissions = new Permission();
        foreach ($permissions as $permission){
            $arr = explode('.', $permission['name']);
            if ($arr[0] != $index) {

            } else {

            }
        }


    }

    public function responseJson($errors=null, $method=0, $status=200)
    {
        if ( !$errors) {
            switch ($method) {
                case 'store':
                    return response()->json([
                        'status' => 1,
                        'message' => sprintf("已新增 %s", "一筆資料"),
                        'redirectUrl' => $this->gotoUrl
                    ], $status);
                case 'update':
                    return response()->json([
                        'status' => 1,
                        'message' => sprintf("已更新 %s", "一筆資料"),
                        'redirectUrl' => $this->gotoUrl
                    ], $status);
                case 'destroy':
                    return response()->json([
                        'status' => 1,
                        'message' => sprintf("已刪除 %s", "一筆資料"),
                        'redirectUrl' => $this->gotoUrl
                    ], $status);
                default:
//                    return redirect(route('admin.news.index', $request->query()))
//                        ->with('success', sprintf("已新增 %s", "一筆資料"));
                    return response()->json([ ], 404);
            }
        } else {
            return response()->json([
                'status' => 0,
                'message' => $errors,
//                'redirectUrl' => $this->gotoUrl
            ], 200);
        }
    }


    public function dateTime($column = 'created_at', $format = 'Y-m-d H:i:s')
    {
        if ($this->object->$column) {
            return $this->object->$column->format($format);
        }

        return null;
    }

    public function presentStatus()
    {
        if($this->object->status)
        {
            return '<span class="label label-success">啟用</span>';
        }

        return '<span class="label label-danger">停用</span>';
    }
}
