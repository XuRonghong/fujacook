<?php

use Illuminate\Database\Seeder;
use App\Setting;

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
                'content' => str_random(15),
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
    }
}
