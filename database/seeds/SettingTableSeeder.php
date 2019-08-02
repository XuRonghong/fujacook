<?php

use Illuminate\Database\Seeder;
use App\Setting;
use App\Scene;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            /*
             * 預設後台參數
             */
            Setting::truncate();
            $parameters = [
                [
                    'type' => 'app', 'name' => 'app_id', 'content' => rand(1000000000000001, 1999999999999999),
                ], [
                    'type' => 'meta', 'name' => 'meta_title', 'content' => json_encode(config('app.title'), JSON_UNESCAPED_UNICODE),
                ], [
                    'type' => 'meta', 'name' => 'meta_keyword', 'content' => json_encode(trans('web.meta_keyword'), JSON_UNESCAPED_UNICODE),
                ], [
                    'type' => 'meta', 'name' => 'meta_description', 'content' => json_encode(trans('web.meta_description'), JSON_UNESCAPED_UNICODE),
                ], [
                    'type' => 'meta', 'name' => 'meta_url', 'content' => json_encode(config('app.url'), JSON_UNESCAPED_UNICODE),
                ], [
                    'type' => 'meta', 'name' => 'meta_image', 'content' => '',
                ], [
                    'type' => 'app', 'name' => 'image_width', 'content' => '1280',
                ], [
                    'type' => 'app', 'name' => 'image_height', 'content' => '600',
                ], [
                    'name' => 'gtm_header', 'content' => '<!-- gtm_header -->',
                ], [
                    'name' => 'gtm_body', 'content' => '<!-- gtm_body -->',
                ], [
                    'name' => 'fb_pixel', 'content' => '<!-- fb_pixel -->',
                ], [
                    'name' => 'facebook_link', 'content' => '',
                ], [
                    'name' => 'instagram_link', 'content' => '',
                ], [
                    'name' => 'line_link', 'content' => '',
                ], [
                    'name' => 'shipping_fee', 'content' => '100',
                ], [
                    'name' => 'free_shipping_over_price', 'content' => '1000',
                ], [
                    'name' => 'last_members_no', 'content' => '',
                ], [
                    'name' => 'last_products_no', 'content' => '',
                ], [
                    'name' => 'last_product_combination_no', 'content' => '',
                ], [
                    'name' => 'last_order_no', 'content' => '',
                ]
            ];
            // 後台全域搜尋
            $global_keyword = array();
            foreach (config('parameter.global_keyword') as $key => $searchs) {
                $global_keyword[] = [
                    'type' => 'backend-global_keyword',
                    'name' => $key,
                    'content' => json_encode($searchs, JSON_UNESCAPED_UNICODE),
                ];
            }
            $parameters = array_merge($parameters, $global_keyword);

            foreach ($parameters as $parameter) {
                Setting::create($parameter);
            }

            /*
             * 預設前台布景
             */
            Scene::truncate();
            $scenes = config('scenes');
            foreach ($scenes as $scene) {
                Scene::create($scene);
            }

        if (env('DB_REFRESH')) {
            //
        }
    }
}
