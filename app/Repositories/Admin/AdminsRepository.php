<?php

namespace App\Repositories\Admin;

use App\Admin;
use App\AdminInfo;
use App\AdminMenu;
use App\AdminPermission;
use App\Permission;
use App\Menu;
use App\Repositories\Repository;
use Hash;
use DB;


class AdminsRepository extends Repository
{
    protected $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function all($attributes='')
    {
        return $this->model::all();
    }

    public function create($attributes)
    {
        try{
            $attributes = array_merge($attributes, [
                'no' => 'a'.auth()->guard('admin')->user()->id. time().rand('00','99'), //以時間當亂數種子
                'createIP' => getUserIpAddr(),
                'active' => 1,
                'remember_token' =>  str_random(10),
            ]);

            // Hash password
            if (isset($attributes['password'])) {
                if ( !Admin::query()->where('password',$attributes['password'])->count() ) {
                    $attributes['password'] = Hash::make($attributes['password']);
                }
            }

            //
            $admin_info['user_image'] = $attributes['image'];
            $admin_info['user_name'] = $attributes['name'];
            $admin_info['user_email'] = $attributes['email'];
            $admin_info['user_contact'] = $attributes['user_contact'];
            unset($attributes['image']);
            unset($attributes['file_id']);
            unset($attributes['user_contact']);
            $attributes['created_at'] = date('Y-m-d H:i:s', time());
            $attributes['updated_at'] = date('Y-m-d H:i:s', time());
            $admin_id = DB::table('admins')->insertGetId($attributes);
            // insert admin info
            $admin_info['admin_id'] = $admin_id;
            DB::table('admins_info')->insert($admin_info);
            // add permission and menu to admin
            $this->addPermissionAndMenus($admin_id);


            return ['errors'=> null];
            //return parent::create($attributes); // TODO: Change the autogenerated stub
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }

    public function update($attributes, $id)
    {
        try{
            $attributes = array_merge($attributes, [
                //'no' => 'a'. auth()->guard('admin')->user()->id. time(). rand('00','99'), //以時間當亂數種子
                'createIP' => getUserIpAddr(),
//                'active' => 1,
//                'remember_token' =>  str_random(10),
            ]);
            // 啟用 或 不啟用
            if (isset($attributes['open'])) {
                $admin = $this->model->find($id);
                $attributes['active'] = ($attributes['open'] == "change") ? !$admin->active : $admin->active;
                return parent::update($attributes, $id);
            }
            // 更改順序
            if (isset($attributes['rank'])) {
                return parent::update($attributes, $id);
            }

            // Hash password
            if (isset($attributes['password'])) {
                if ( !Admin::query()->where('password',$attributes['password'])->find($id)->count() ) {
                    $attributes['password'] = Hash::make($attributes['password']);
                }
            }
            //
            $admin_info['user_image'] = $attributes['image'];
            $admin_info['user_name'] = $attributes['name'];
            $admin_info['user_email'] = $attributes['email'];
            $admin_info['user_contact'] = $attributes['user_contact'];
            unset($attributes['image']);
            unset($attributes['file_id']);
            unset($attributes['user_contact']);
            $attributes['updated_at'] = date('Y-m-d H:i:s', time());
            DB::table('admins')->where('id', $id)->update($attributes);
            // insert admin info
            DB::table('admins_info')->where('id', $id)->update($admin_info);


            return ['errors'=> null];
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }

    public function delete($id)
    {
        return parent::delete($id);
    }


    /*
     * data object or array forEach to do.
     */
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                //找圖片檔案
//                $var->image = $this->transFileIdtoImage($var->file_id);
                //
                $var->info = AdminInfo::query()->where('admin_id', $var->id)->first();
            }
        }
        return $arr;
    }


    //
    public function findOrFail($id)
    {
//        return $this->model->findOrFail($id);
        return $this->model->where('no', $id)->with('info')->first();
    }

    //權限與Menu
    public function addPermissionAndMenus($admin_id=0)
    {
        if ( !$admin_id) return null;

        /******* Role **********/
//        Role::create(['name' => 'role.1', 'description' => '系統管理者']);
//        Role::create(['name' => 'role.2', 'description' => '會計']);
//        Role::create(['name' => 'role.3', 'description' => '業務']);
//        Role::create(['name' => 'role.4', 'description' => '供應商']);
//        Role::create(['name' => 'role.5', 'description' => '操作員']);

        $permissions = Permission::query()->get();
        foreach ($permissions as $permission){
            AdminPermission::query()->create(['permission_id' => $permission['id'], 'admin_id'  => $admin_id]);
        }

        $menus = Menu::query()->where('open', '<>', 0)->get();
        foreach ($menus as $menu){
            AdminMenu::query()->create(['menu_id' => $menu['id'], 'admin_id'  => $admin_id]);
        }

        return true;
    }
}
