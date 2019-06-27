<?php

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Menu;
use App\AdminMenu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = config('menu');
        //
        Menu::truncate();

        if (env('DB_CONNECTION')=='sqlsrv') DB::unprepared('SET IDENTITY_INSERT menus ON;');
        $maxRank = 1;
        foreach ($menus as $key => $menu) {
            $DaoMenu = new Menu();
            $DaoMenu->id = $menu['id'];
            $DaoMenu->parent_id = $menu['parent_id'];
            $DaoMenu->rank = isset($menu['rank'])? $menu['rank'] : ($maxRank++);
            $DaoMenu->type = isset($menu['type'])? $menu['type'] : 0;
            $DaoMenu->name = $menu['name'];
            $DaoMenu->link = $menu['link'];
            $DaoMenu->sub_menu = $menu['sub_menu'];
            $DaoMenu->access = $menu['access'];
            $DaoMenu->open = $menu['open'];
            $DaoMenu->save();
            if ($DaoMenu->sub_menu) {
                $maxRank_child = 1;
                foreach ($menu['child'] as $key_child => $menu_child) {
                    $DaoMenuChild = new Menu();
                    $DaoMenuChild->id = $menu_child['id'];
                    $DaoMenuChild->parent_id = $menu_child['parent_id'];
                    $DaoMenuChild->rank = isset($menu_child['rank'])? $menu_child['rank'] : $maxRank_child++;
                    $DaoMenuChild->type = isset($menu_child['type'])? $menu_child['type'] : 0;
                    $DaoMenuChild->name = $menu_child['name'];
                    $DaoMenuChild->link = $menu_child['link'];
                    $DaoMenuChild->sub_menu = $menu_child['sub_menu'];
                    $DaoMenuChild->access = $menu_child['access'];
                    $DaoMenuChild->open = $menu_child['open'];
                    $DaoMenuChild->save();
                    if ($DaoMenuChild->sub_menu) {
                        $maxRank_child2 = 0;
                        foreach ($menu_child['child'] as $key_child2 => $menu_child2) {
                            $DaoMenuChild2 = new Menu();
                            $DaoMenuChild2->id = $menu_child2['id'];
                            $DaoMenuChild2->parent_id = $menu_child2['parent_id'];
                            $DaoMenuChild2->rank = isset($menu_child2['rank'])? $menu_child2['rank'] : $maxRank_child2++;
                            $DaoMenuChild2->type = isset($menu_child2['type'])? $menu_child2['type'] : 0;
                            $DaoMenuChild2->name = $menu_child2['name'];
                            $DaoMenuChild2->link = $menu_child2['link'];
                            $DaoMenuChild2->sub_menu = $menu_child2['sub_menu'];
                            $DaoMenuChild2->access = $menu_child2['access'];
                            $DaoMenuChild2->open = $menu_child2['open'];
                            $DaoMenuChild2->save();
                            $maxRank_child2++;
                        }
                    }
                }
            }
        }
        if (env('DB_CONNECTION')=='sqlsrv') DB::unprepared('SET IDENTITY_INSERT menus OFF;');


        /******* Role **********/
//        Role::create(['name' => 'role.1', 'description' => '系統管理者']);
//        Role::create(['name' => 'role.2', 'description' => '會計']);
//        Role::create(['name' => 'role.3', 'description' => '業務']);
//        Role::create(['name' => 'role.4', 'description' => '供應商']);
//        Role::create(['name' => 'role.5', 'description' => '操作員']);

        AdminMenu::truncate();
        $menus = Menu::query()->where('open', '<>', 0)->get();
        foreach ($menus as $menu){
            AdminMenu::query()->create(['menu_id' => $menu['id'], 'admin_id'  => 1]);
            AdminMenu::query()->create(['menu_id' => $menu['id'], 'admin_id'  => 2]);
            AdminMenu::query()->create(['menu_id' => $menu['id'], 'admin_id'  => 3]);
        }
    }
}

