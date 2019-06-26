<?php

namespace App\Presenters\Admin;

use App\Menu;
use App\Permission;
use DB;

abstract class Presenter
{

    public function setTitle($title)
    {
        return $this->title = $title;
    }

    public function setViewName($name)
    {
        return $this->view_group_name = $name;
    }

    public function setRouteName($name)
    {
        $this->route_name = $name;
        $this->gotoUrl = route($this->route_name.'.index');
        return $this->route_name;
    }

    public function getViewName()
    {
        return $this->view_group_name;
    }

    public function getRouteName()
    {
        return $this->route_name;
    }


    public function getRouteResource($route_name = '')
    {
        return [
            'index' => route($route_name.'.index'),
            'list' => route($route_name.'.list'),
            'create' => route($route_name.'.create'),
            'store' => route($route_name.'.store'),
            'edit'  => route($route_name.'.index'),
//            'update' => url(str_replace('.','/',$route_name), [1]),
            'update' => route($route_name.'.update', [-10]),    //-10暫定代替字元
//            'destroy' => url(str_replace('.','/',$route_name).'/destroy'),
            'destroy' => route($route_name.'.destroy', [-10]),
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
            'admin_logo' => auth()->guard('admin')->user()->info[0]->user_image, //asset('xtreme-admin/assets/images/users/1.jpg'),
            'admin_name' => auth()->guard('admin')->user()->name, //'Steave Jobs',
            'admin_email' => auth()->guard('admin')->user()->email, //'varun@gmail.com',
            'admin_profile' => route('admin.admins.index').'/'.auth()->guard('admin')->user()->no.'/edit',
            'my_balance_url' => '',
            'account_setting_url' => 'javascript:void(0)',
            'upload_image' => url('admin/upload_image'),
            'upload_image_base64_url' => url('admin/upload_image_base64'),
            'upload_file_url' => url('admin/upload_file'),
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
            'admins' => route('admin.admins.index'),
            'news' => route('admin.news.index'),
            'store' => route('admin.store.index'),
            'permissions' => route('admin.permissions.index'),
        ];
        $data['nav'] = $nav;
        $menu = $this->getMenu2();
        $data['menu'] = $menu;

        return $data;
    }


    /*
     *
     */
    public function getMenu2()
    {
//        $this->view = View()->make( config( '_menu.' . $this->func . '.view' ) );
//        session()->put( 'menu_parent', config( '_menu.' . $this->func . '.menu_parent' ) );
//        session()->put( 'menu_access', config( '_menu.' . $this->func . '.menu_access' ) );
        $mapSysMenu ['open'] = 1;
        $DaoSysMenu = Menu::query()->where( $mapSysMenu )
            ->whereExists(function($query)
            {
                $query->select(DB::raw(1))
                    ->from('admin_menu')
                    ->whereRaw('admin_menu.menu_id = menus.id')
                    ->whereRaw('admin_id = '.auth()->guard('admin')->user()->id);
            })
            ->orderBy( 'rank', 'ASC' )->get();
        $sys_menu = $DaoSysMenu->where('parent_id', '=', 0);
        foreach ($sys_menu as $key => $var) {
            if ($var->sub_menu) {
                $var->second = $DaoSysMenu->where('parent_id', '=', $var->id);
                foreach ($var->second as $key2 => $var2) {
                    if ($var2->sub_menu) {
                        $var2->third = $DaoSysMenu->where('parent_id', '=', $var2->id);
                    }
                }
            }
        }
        return $sys_menu;
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
            ], 422);
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
