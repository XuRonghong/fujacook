<?php

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Permission;
use App\Role;
use App\AdminPermission;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = [];


        $index[0] = 'admin';
        /*
         * 帳號管理
         */
        $permissions[] = Permission::create(['name' => 'admin.admin.index', 'description' => '帳號管理-個人資料 檢視']);
        $permissions[] = Permission::create(['name' => 'admin.admin.update', 'description' => '帳號管理-個人資料 編輯']);
        // 後台帳號管理
        $index[1] = 'admins';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        // 前台帳號管理
        $index[1] = 'members';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);


        // 群組管理
        $index[1] = 'group'; $index[2] = 'member';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
//        $index[1] = 'group'; $index[2] = 'store';
//        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
//        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
//        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
//        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
//        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
//        $index[1] = 'group'; $index[2] = 'supplier';
//        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
//        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
//        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
//        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
//        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'group'; $index[2] = 'admin';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);

        // 系統類別設置
        $index[1] = 'category'; array_forget($index,2);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);

        // log管理
        $index[1] = 'log'; $index[2] = 'login';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $index[1] = 'log'; $index[2] = 'action';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);


        // 權限
        $index[1] = 'permissions'; array_forget($index,2);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'admin_permission';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);

        // Menu
        $index[1] = 'menus'; array_forget($index,2);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'admin_menu';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);



        // 商店店家
        $index[1] = 'store';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        // 供應商會員管理
        $index[1] = 'supplier';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);


        /*
         * article
         */
        $index[1] = 'article'; array_forget($index,2); array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);



        /*
         * 公告
         */
        $index[1] = 'information'; $index[2] = 'announce'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        /*
         * 最新消息
         */
        $index[1] = 'information'; $index[2] = 'news'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        /*
         * 訊息
         */
        $index[1] = 'information'; $index[2] = 'messages'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        /*
         * 媒體報導
         */
        $index[1] = 'information'; $index[2] = 'reports'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        /*
         * Notifications全站通知管理
         */
        $index[1] = 'information'; $index[2] = 'notifications'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);


        /*
         * Product管理
         */
        // 商品類別
        $index[1] = 'product'; $index[2] = 'category'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        // 商品
        $index[1] = 'product'; $index[2] = 'manage'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        // 運費管理
        $index[1] = 'product'; $index[2] = 'shipping'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        // 付款方式
        $index[1] = 'product'; $index[2] = 'pay'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        // 商品管理記錄
        $index[1] = 'product'; $index[2] = 'log'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);



        /*
         * 廣告管理
         */
        // 廣告類別設置
        $index[1] = 'advertising'; $index[2] = 'category'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        // 廣告管理
        $index[1] = 'advertising'; $index[2] = 'manage'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        // 平台推薦商品管理
        $index[1] = 'advertising'; $index[2] = 'recommend'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        // 促銷活動
        $index[1] = 'advertising'; $index[2] = 'promotions'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);



        /*
         * 前台-場面介面管理
         */
        $index[1] = 'scenes'; $index[2] = 'navbar'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'scenes'; $index[2] = 'slider'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'scenes'; $index[2] = 'introduce'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'scenes'; $index[2] = 'image'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'scenes'; $index[2] = 'footer'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);


        /*
         * 活動管理
         */
        //優惠券
        $index[1] = 'activity'; $index[2] = 'coupon'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        //點數
        $index[1] = 'activity'; $index[2] = 'coin'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        //活動訊息
        $index[1] = 'activity'; $index[2] = 'news'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        //活動報名
        $index[1] = 'activity'; $index[2] = 'sign_up'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        //活動檔期
        $index[1] = 'activity'; $index[2] = 'schedule'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);


        /*
         * 客服專區
         */
        //連繫我們
        $index[1] = 'service'; $index[2] = 'contactus'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        //留言專區
        $index[1] = 'service'; $index[2] = 'message'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);



        /*
         * 網站設定
         */
        //關鍵字設置
        $index[1] = 'setting'; $index[2] = 'search_keywords';  array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.log','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        //系統參數設定
        $index[1] = 'setting'; $index[2] = 'parameters';  array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        //匯率管理
        $index[1] = 'setting'; $index[2] = 'exchange_rate';  array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);



        //全站標籤管理
        $permissions[] = Permission::create(['name' => 'admin.hashtags.index', 'description' => '全站標籤管理 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.hashtags.store', 'description' => '全站標籤管理 新增']);
        $permissions[] = Permission::create(['name' => 'admin.hashtags.update', 'description' => '全站標籤管理 更新']);
        $permissions[] = Permission::create(['name' => 'admin.hashtags.destroy', 'description' => '全站標籤管理 刪除']);

        //訂單管理
        $permissions[] = Permission::create(['name' => 'admin.orders.index', 'description' => '訂單管理 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.order.show', 'description' => '訂單管理 檢視']);

        //評價管理
        $permissions[] = Permission::create(['name' => 'admin.product_combination_reviews.index', 'description' => '評價管理 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.product_combination_reviews.update', 'description' => '評價管理 更新']);
        $permissions[] = Permission::create(['name' => 'admin.product_combination_reviews.destroy', 'description' => '評價管理 刪除']);

        //輪播管理
        $permissions[] = Permission::create(['name' => 'admin.main-banners.index', 'description' => '輪播管理-首頁輪播 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.main-banners.store', 'description' => '輪播管理-首頁輪播 新增']);
        $permissions[] = Permission::create(['name' => 'admin.main-banners.update', 'description' => '輪播管理-首頁輪播 更新']);
        $permissions[] = Permission::create(['name' => 'admin.main-banners.destroy', 'description' => '輪播管理-首頁輪播 刪除']);

        $permissions[] = Permission::create(['name' => 'admin.ad-banners.index', 'description' => '輪播管理-廣告輪播 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.ad-banners.store', 'description' => '輪播管理-廣告輪播 新增']);
        $permissions[] = Permission::create(['name' => 'admin.ad-banners.update', 'description' => '輪播管理-廣告輪播 更新']);
        $permissions[] = Permission::create(['name' => 'admin.ad-banners.destroy', 'description' => '輪播管理-廣告輪播 刪除']);

        /*
         * 商品管理
         */
        $permissions[] = Permission::create(['name' => 'admin.products.index', 'description' => '商品管理-品項管理 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.products.store', 'description' => '商品管理-品項管理 新增']);
        $permissions[] = Permission::create(['name' => 'admin.products.update', 'description' => '商品管理-品項管理 更新']);
        $permissions[] = Permission::create(['name' => 'admin.products.destroy', 'description' => '商品管理-品項管理 刪除']);

        $permissions[] = Permission::create(['name' => 'admin.product_categories.index', 'description' => '商品管理-商品分類 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.product_categories.store', 'description' => '商品管理-商品分類 新增']);
        $permissions[] = Permission::create(['name' => 'admin.product_categories.update', 'description' => '商品管理-商品分類 更新']);
        $permissions[] = Permission::create(['name' => 'admin.product_categories.destroy', 'description' => '商品管理-商品分類 刪除']);

        $permissions[] = Permission::create(['name' => 'admin.product_combinations.index', 'description' => '商品管理-商品上架管理 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.product_combinations.store', 'description' => '商品管理-商品上架管理 新增']);
        $permissions[] = Permission::create(['name' => 'admin.product_combinations.update', 'description' => '商品管理-商品上架管理 更新']);
        $permissions[] = Permission::create(['name' => 'admin.product_combinations.destroy', 'description' => '商品管理-商品上架管理 刪除']);
        //規格管理
        $permissions[] = Permission::create(['name' => 'admin.product_spec.index', 'description' => '商品管理-規格列表 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.product_spec.store', 'description' => '商品管理-規格列表 新增']);
        $permissions[] = Permission::create(['name' => 'admin.product_spec.update', 'description' => '商品管理-規格列表 更新']);
        $permissions[] = Permission::create(['name' => 'admin.product_spec.destroy', 'description' => '商品管理-規格列表 刪除']);

        /*
         * 文章管理
         */
        $permissions[] = Permission::create(['name' => 'admin.articles.index', 'description' => '文章管理-文章管理 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.articles.store', 'description' => '文章管理-文章管理 新增']);
        $permissions[] = Permission::create(['name' => 'admin.articles.update', 'description' => '文章管理-文章管理 更新']);
        $permissions[] = Permission::create(['name' => 'admin.articles.destroy', 'description' => '文章管理-文章管理 刪除']);

        $permissions[] = Permission::create(['name' => 'admin.article_categories.index', 'description' => '文章管理-文章分類 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.article_categories.store', 'description' => '文章管理-文章分類 新增']);
        $permissions[] = Permission::create(['name' => 'admin.article_categories.update', 'description' => '文章管理-文章分類 更新']);
        $permissions[] = Permission::create(['name' => 'admin.article_categories.destroy', 'description' => '文章管理-文章分類 刪除']);

        /*
         * Coupons管理
         */
        $permissions[] = Permission::create(['name' => 'admin.coupons.index', 'description' => 'COUPONS管理 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.coupons.store', 'description' => 'COUPONS管理 新增']);
        $permissions[] = Permission::create(['name' => 'admin.coupons.update', 'description' => 'COUPONS管理 更新']);
        $permissions[] = Permission::create(['name' => 'admin.coupons.destroy', 'description' => 'COUPONS管理 刪除']);



        /******* Role **********/
//        Role::create(['name' => 'role.1', 'description' => '系統管理者']);
//        Role::create(['name' => 'role.2', 'description' => '會計']);
//        Role::create(['name' => 'role.3', 'description' => '業務']);
//        Role::create(['name' => 'role.4', 'description' => '供應商']);
//        Role::create(['name' => 'role.5', 'description' => '操作員']);

        AdminPermission::truncate();
        foreach ($permissions as $permission){
            AdminPermission::query()->create([
                'permission_id' => $permission['id'],
                'admin_id'  => 1
            ]);
            AdminPermission::query()->create([
                'permission_id' => $permission['id'],
                'admin_id'  => 2
            ]);
            AdminPermission::query()->create([
                'permission_id' => $permission['id'],
                'admin_id'  => 3
            ]);
        }
    }
}

