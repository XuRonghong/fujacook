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
//        Role::truncate();
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = [];
        
        // 後台帳號管理
        $permissions[] = Permission::create(['name' => 'admin.admin.index', 'description' => '帳號管理-個人資料 檢視']);
        $permissions[] = Permission::create(['name' => 'admin.admin.update', 'description' => '帳號管理-個人資料 編輯']);

        $permissions[] = Permission::create(['name' => 'admin.admins.index', 'description' => '帳號管理-後台帳號管理 檢視']);
        $permissions[] = Permission::create(['name' => 'admin.admins.store', 'description' => '帳號管理-後台帳號管理 新增']);
        $permissions[] = Permission::create(['name' => 'admin.admins.update', 'description' => '帳號管理-後台帳號管理 編輯']);
        $permissions[] = Permission::create(['name' => 'admin.admins.destroy', 'description' => '帳號管理-後台帳號管理 刪除']);

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
         * 前台網站設定
         */
        $permissions[] = Permission::create(['name' => 'admin.search_keywords.index', 'description' => '前台網站設定-搜尋關鍵字 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.search_keywords.store', 'description' => '前台網站設定-搜尋關鍵字 新增']);
        $permissions[] = Permission::create(['name' => 'admin.search_keywords.update', 'description' => '前台網站設定-搜尋關鍵字 更新']);
        $permissions[] = Permission::create(['name' => 'admin.search_keywords.destroy', 'description' => '前台網站設定-搜尋關鍵字 刪除']);

        /*
         * 系統參數設定
         */
        $permissions[] = Permission::create(['name' => 'admin.permissions.index', 'description' => '系統參數設定-權限設定 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.permissions.update', 'description' => '系統參數設定-權限設定 更新']);

        $permissions[] = Permission::create(['name' => 'admin.parameters.index', 'description' => '系統參數設定-meta參數設定 總覽']);
        $permissions[] = Permission::create(['name' => 'admin.parameters.store', 'description' => '系統參數設定-meta參數設定 新增']);
        $permissions[] = Permission::create(['name' => 'admin.parameters.update', 'description' => '系統參數設定-meta參數設定 更新']);
        $permissions[] = Permission::create(['name' => 'admin.parameters.destroy', 'description' => '系統參數設定-meta參數設定 刪除']);


        /******* Role **********/
//        Role::create(['name' => 'role.1', 'description' => '系統管理者']);
//        Role::create(['name' => 'role.2', 'description' => '會計']);
//        Role::create(['name' => 'role.3', 'description' => '業務']);
//        Role::create(['name' => 'role.4', 'description' => '供應商']);
//        Role::create(['name' => 'role.5', 'description' => '操作員']);

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

