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
        Setting::truncate();
        $parameters = [
            [
                'type' => 'app',
                'name' => 'app_id',
                'content' => rand(1000000000000001, 1999999999999999),
            ], [
                'type' => 'meta',
                'name' => 'meta_title',
                'content' => config('app.title'),
            ], [
                'type' => 'meta',
                'name' => 'meta_description',
                'content' => '',
            ], [
                'type' => 'meta',
                'name' => 'meta_url',
                'content' => config('app.url'),
            ], [
                'type' => 'meta',
                'name' => 'meta_image',
                'content' => '',
            ], [
                'type' => 'app',
                'name' => 'image_width',
                'content' => '1280',
            ], [
                'type' => 'app',
                'name' => 'image_height',
                'content' => '600',
            ], [
                'name' => 'gtm_header',
                'content' => '<!-- gtm_header -->',
            ], [
                'name' => 'gtm_body',
                'content' => '<!-- gtm_body -->',
            ], [
                'name' => 'fb_pixel',
                'content' => '<!-- fb_pixel -->',
            ], [
                'name' => 'facebook_link',
                'content' => '',
            ], [
                'name' => 'instagram_link',
                'content' => '',
            ], [
                'name' => 'line_link',
                'content' => '',
            ], [
                'name' => 'shipping_fee',
                'content' => '100',
            ], [
                'name' => 'free_shipping_over_price',
                'content' => '1000',
            ], [
                'name' => 'last_members_no',
                'content' => '',
            ], [
                'name' => 'last_products_no',
                'content' => '',
            ], [
                'name' => 'last_product_combination_no',
                'content' => '',
            ], [
                'name' => 'last_order_no',
                'content' => '',
            ]
        ];
        foreach ($parameters as $parameter) {
            Setting::create($parameter);
        }


        Scene::truncate();
        $data = ['type' => 'navbar.home', 'open'=> 1];
        $scenes = [
            [
                'type' => $data['type'],
                'title' => '首頁',
                'url' => env('APP_URL').'/',
                'open' => $data['open'],
            ], [
                'type' => $data['type'],
                'title' => '關於FUJACOOK',
                'url' => env('APP_URL').'/about',
                'open' => $data['open'],
            ], [
                'type' => $data['type'],
                'title' => '媒體報導',
                'url' => env('APP_URL').'/reports',
                'open' => $data['open'],
            ], [
                'type' => $data['type'],
                'title' => '即食鍋',
                'url' => env('APP_URL').'#',
                'open' => $data['open'],
            ], [
                'type' => $data['type'],
                'title' => '即時餐',
                'url' => env('APP_URL').'#',
                'open' => $data['open'],
            ], [
                'type' => $data['type'],
                'title' => '最新消息',
                'url' => env('APP_URL').'/news',
                'open' => $data['open'],
            ], [
                'type' => $data['type'],
                'title' => '聯繫我們',
                'url' => env('APP_URL').'/contactus',
                'open' => $data['open'],
            ],
        ];
        foreach ($scenes as $scene) {
            Scene::create($scene);
        }

        $data = ['type' => 'slider.home', 'open'=> 1];
        $scenes = [
            [
                'type' => $data['type'],
                'title' => 'banner01',
                'image' => env('APP_URL').'/web0617/img/slide01.jpg',
                'url' => env('APP_URL').'/#',
                'open' => $data['open'],
            ], [
                'type' => $data['type'],
                'title' => 'banner02',
                'image' => env('APP_URL').'/web0617/img/slide02.jpg',
                'url' => env('APP_URL').'/#',
                'open' => $data['open'],
            ],
        ];
        foreach ($scenes as $scene) {
            Scene::create($scene);
        }
    }
}
