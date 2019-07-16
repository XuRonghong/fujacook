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


        /*
         * 權限與Menu
         */
        $index[1] = 'permissions';
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

        $index[1] = 'menus';
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

        // log管理
        $index[1] = 'log'; $index[2] = 'login';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'log'; $index[2] = 'action';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);


        /*
         * 前台-場面介面管理
         */
        $index[1] = 'scenes'; $index[2] = 'navbar'; $index[3] = 'home';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'scenes'; $index[2] = 'slider'; $index[3] = 'home';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'scenes'; $index[2] = 'header'; $index[3] = 'home';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'scenes'; $index[2] = 'introduce'; $index[3] = 'home';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'scenes'; $index[2] = 'image'; $index[3] = 'home';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        $index[1] = 'scenes'; $index[2] = 'footer'; $index[3] = 'home';
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);


        /*
         * 前台網站設定
         */
        $index[1] = 'setting'; $index[2] = 'search_keywords';  array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);

        $index[1] = 'setting'; $index[2] = 'parameters';  array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);



        /*
         * 最新消息
         */
        $index[1] = 'information'; $index[1] = 'news'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);
        /*
         * 媒體報導
         */
        $index[1] = 'information'; $index[1] = 'reports'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);



        /*
         * 產品設定
         */
        $index[1] = 'products'; $index[2] = 'category';  array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);

        $index[1] = 'products'; $index[2] = 'manage';  array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);



        // 會員管理
        $permissions[] = Permission::create(['name' => 'admin.members.index', 'description' => '帳號管理-會員管理 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.members.show', 'description' => '帳號管理-會員管理 檢視']);
        $permissions[] = Permission::create(['name' => 'admin.members.update', 'description' => '帳號管理-會員管理 編輯']);

        //全站通知管理
        $permissions[] = Permission::create(['name' => 'admin.notifications.index', 'description' => '全站通知管理 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.notifications.show', 'description' => '全站通知管理 檢視']);
        $permissions[] = Permission::create(['name' => 'admin.notifications.store', 'description' => '全站通知管理 新增']);
        $permissions[] = Permission::create(['name' => 'admin.notifications.update', 'description' => '全站通知管理 更新']);
        $permissions[] = Permission::create(['name' => 'admin.notifications.destroy', 'description' => '全站通知管理 刪除']);


        //供應商
        $index = ['store', '供應商'];
        $permissions[] = Permission::create(['name' => 'admin.'.$index[0].'.index', 'description' => $index[1].' 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.'.$index[0].'.show', 'description' => $index[1].' 檢視']);
        $permissions[] = Permission::create(['name' => 'admin.'.$index[0].'.create', 'description' => $index[1].' 新增']);
        $permissions[] = Permission::create(['name' => 'admin.'.$index[0].'.edit', 'description' => $index[1].' 更新']);
        $permissions[] = Permission::create(['name' => 'admin.'.$index[0].'.destroy', 'description' => $index[1].' 刪除']);

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



        /*
         * 連繫我們
         */
        $index[1] = 'service'; $index[2] = 'contactus'; array_forget($index,3);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.index', 'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.index')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.show',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.show')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.create','description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.create')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.edit',  'description' => trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.edit')]);
        $permissions[] = Permission::create(['name' => implode('.',$index).'.destroy','description'=> trans('permission.'.implode('.',$index).'.title').trans('permission.'.implode('.',$index).'.destroy')]);


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

