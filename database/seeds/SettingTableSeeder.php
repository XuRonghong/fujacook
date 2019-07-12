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
        if (env('DB_REFRESH')) {
            Setting::truncate();
            $parameters = [
                [
                    'type' => 'app',
                    'name' => 'app_id',
                    'content' => rand(1000000000000001, 1999999999999999),
                ], [
                    'type' => 'meta',
                    'name' => 'meta_title',
                    'content' => json_encode(config('app.title'), JSON_UNESCAPED_UNICODE),
                ], [
                    'type' => 'meta',
                    'name' => 'meta_keyword',
                    'content' => json_encode(trans('web.meta_keyword'), JSON_UNESCAPED_UNICODE),
                ], [
                    'type' => 'meta',
                    'name' => 'meta_description',
                    'content' => json_encode(trans('web.meta_description'), JSON_UNESCAPED_UNICODE),
                ],[
                    'type' => 'meta',
                    'name' => 'meta_url',
                    'content' => json_encode(config('app.url'), JSON_UNESCAPED_UNICODE),
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
        }


        Scene::truncate();
//            Scene::query()->where('type', 'LIKE', 'navbar%')->delete();
            //home navbar
            $data = ['type' => 'navbar.home', 'open' => 1];
            $scenes = [
                [
                    'type' => $data['type'],
                    'summary' => '首頁',
                    'url' => env('APP_URL') . '/',
                    'open' => $data['open'],
                ], [
                    'type' => $data['type'],
                    'summary' => '關於FUJACOOK',
                    'url' => env('APP_URL') . '/about',
                    'open' => $data['open'],
                ], [
                    'type' => $data['type'],
                    'summary' => '媒體報導',
                    'url' => env('APP_URL') . '/reports',
                    'open' => $data['open'],
                ], [
                    'type' => $data['type'],
                    'summary' => '即食鍋',
                    'url' => env('APP_URL') . '#',
                    'open' => $data['open'],
                ], [
                    'type' => $data['type'],
                    'summary' => '即時餐',
                    'url' => env('APP_URL') . '#',
                    'open' => $data['open'],
                ], [
                    'type' => $data['type'],
                    'summary' => '最新消息',
                    'url' => env('APP_URL') . '/news',
                    'open' => $data['open'],
                ], [
                    'type' => $data['type'],
                    'summary' => '聯繫我們',
                    'url' => env('APP_URL') . '/contactus',
                    'open' => $data['open'],
                ],
            ];
            foreach ($scenes as $scene) {
                Scene::create($scene);
            }
            //about navbar
            $data = ['type' => 'navbar.about', 'open' => 1];
            $scenes = [
                [
                    'type' => $data['type'],
                    'summary' => '創辦人介紹',
                    'url' => env('APP_URL') . '/',
                    'open' => $data['open'],
                ], [
                    'type' => $data['type'],
                    'summary' => '專利獎項',
                    'url' => env('APP_URL') . '/about',
                    'open' => $data['open'],
                ], [
                    'type' => $data['type'],
                    'summary' => '研發理念',
                    'url' => env('APP_URL') . '/reports',
                    'open' => $data['open'],
                ], [
                    'type' => $data['type'],
                    'summary' => '品牌沿革',
                    'url' => env('APP_URL') . '#',
                    'open' => $data['open'],
                ], [
                    'type' => $data['type'],
                    'summary' => '核心價值',
                    'url' => env('APP_URL') . '#',
                    'open' => $data['open'],
                ],
            ];
            foreach ($scenes as $scene) {
                Scene::create($scene);
            }

//            Scene::query()->where('type', 'LIKE', 'slider%')->delete();
        //home slier
        $data = ['type' => 'slider.home', 'open' => 1];
        $scenes = [
            [
                'type' => $data['type'],
                'title' => 'banner01',
                'image' => env('APP_URL') . '/web0617/img/slide01.jpg',
                'url' => env('APP_URL') . '/#',
                'open' => $data['open'],
            ], [
                'type' => $data['type'],
                'title' => 'banner02',
                'image' => env('APP_URL') . '/web0617/img/slide02.jpg',
                'url' => env('APP_URL') . '/#',
                'open' => $data['open'],
            ],
        ];
        foreach ($scenes as $scene) {
            Scene::create($scene);
        }
        //about slier
        $data = ['type' => 'slider.about', 'open' => 1];
        $scenes = [
            [
                'type' => $data['type'],
                'title' => 'BRAND',
                'summary' => '顛覆鍋具歷史<br>最實用且有趣的全新烹煮方式',
                'image' => env('APP_URL') . '/web0708/Fujacook/img/FUJACOOK LOGO 牌示意圖.jpg',
                'url' => env('APP_URL') . '/#',
                'open' => $data['open'],
            ]
        ];
        foreach ($scenes as $scene) {
            Scene::create($scene);
        }


//        Scene::query()->where('type', 'LIKE', 'introduce%')->delete();
        //home introduce
        $data = ['type' => 'introduce.home', 'open' => 1];
        $scenes = [
            [
                'type' => 'introduce.home.t01',
                'title' => '首頁介紹1',
                'image' => env('APP_URL') . '/web0617/img/introduce01.jpg',
                'url' => env('APP_URL') . '/#',
                'open' => $data['open'],
            ],
            [
                'type' => 'introduce.home.t01',
                'title' => '首頁介紹2',
                'image' => env('APP_URL') . '/web0617/img/introduce02.jpg',
                'url' => env('APP_URL') . '/#',
                'open' => $data['open'],
            ],
        ];
        foreach ($scenes as $scene) {
            Scene::create($scene);
        }
        //about introduce
        $data = ['type' => 'introduce.about', 'open' => 1];
        $scenes = [
            [
                'type' => 'introduce.about.t01',
                'title' => '創辦人介紹',
                'summary' => '',
                'detail' => '<h2><span>即食餐鍋創辦人 陳献楨 先生</span></h2>
                            <div class="text-area-inner">
                                <li class="" data-tab-target="content">
                                    <i class="fa fa-caret-right fa-3x"></i>
                                    <p>富甲一方國際集團 創辦人</p>
                                    <i class="fa fa-caret-right fa-3x"></i>
                                    <p>何首烏皇帝雞餐飲集團創辦人</p>
                                    <i class="fa fa-caret-right fa-3x"></i>
                                    <p>台灣區南投同鄉會聯合總會第三屆總會長</p>
                                    <p>（第一、二屆總會長為江丙坤先生）</p>
                                    <i class="fa fa-caret-right fa-3x"></i>
                                    <p>新北市後備憲兵荷松協會理事長</p>
                                    <i class="fa fa-caret-right fa-3x"></i>
                                    <p>2017世界跆拳道錦標賽 - 中華台北總領隊</p>
                                    <i class="fa fa-caret-right fa-3x"></i>
                                    <p>新北市道德慈善會創會顧問</p>
                                    <i class="fa fa-caret-right fa-3x"></i>
                                    <p>新北市政府市政顧問</p>
                                </li>
                            </div>',
                'image' => env('APP_URL') . '/web0708/Fujacook/img/創辦人介紹.jpg',
                'url' => env('APP_URL') . '/#',
                'open' => $data['open'],
            ], [
                'type' => 'introduce.about.t03',
                'title' => '研發理念',
                'summary' => '',
                'detail' => "<p>過去很多的鍋子，便利性不是很高，很多的吃法不是那麼健康，於是有了<br>
                                    改良的念頭，考量了健康與便利性，將原本圓形鍋子，改良成了方形利用<br>
                                    鴛鴦鍋的概念，從鍋子中間分成一半，變成前後深淺鍋的形式，並改良成<br>
                                    不沾鍋材質，讓淺鍋的能夠煎食，不用使用油就可以將食物煮熟面積也比<br>
                                    較大，後鍋可以煮湯並蒸食，不只改變大眾飲食的習慣，也讓更多人能夠<br>
                                    節省一般做菜所耗費的時間，徹底解決大眾飲食一條龍的解決方案。</p>",
                'image' => env('APP_URL') . '/web0708/Fujacook/img/研發理念.jpg',
                'url' => env('APP_URL') . '/#',
                'open' => $data['open'],
            ], [
                'type' => 'introduce.about.t05',
                'title' => '核心價值',
                'image' => env('APP_URL') . '/web0708/Fujacook/img/核心價值.jpg',
                'url' => env('APP_URL') . '/#',
                'open' => $data['open'],
            ],
        ];
        foreach ($scenes as $scene) {
            Scene::create($scene);
        }

//        Scene::query()->where('type', 'LIKE', 'image%')->delete();
        //home image
        $data = ['type' => 'image.home.section1', 'open' => 1];
        $scenes = [
            [
                'type' => $data['type'],
                'title' => 'image1',
                'summary' => '中間大圖1',
                'image' => env('APP_URL') . '/web0617/img/introduce03.jpg',
                'url' => env('APP_URL') . '/#',
                'open' => $data['open'],
            ],
            [
                'type' => $data['type'],
                'title' => 'image2',
                'summary' => '中間大圖2',
                'image' => env('APP_URL') . '/web0617/img/introduce04.jpg',
                'url' => env('APP_URL') . '/#',
                'open' => $data['open'],
            ],
            [
                'type' => $data['type'],
                'title' => 'image3',
                'summary' => '中間大圖3',
                'image' => env('APP_URL') . '/web0617/img/introduce05.jpg',
                'url' => env('APP_URL') . '/#',
                'open' => $data['open'],
            ],
        ];
        foreach ($scenes as $scene) {
            Scene::create($scene);
        }
        //home , about image
        $data = ['type' => 'image.home.section3', 'open' => 1];
        $scenes = [
            [
                'type' => $data['type'],
                'title' => '即食鍋',
                'summary' => '即時 • 歡樂',
                'image' => env('APP_URL') . '/web0708/Fujacook/img/即食鍋.jpg',
                'url' => env('APP_URL') . '/#',
                'style' => 'E-img-l',
                'open' => $data['open'],
            ],
            [
                'type' => $data['type'],
                'title' => '即食餐',
                'summary' => '即時 • 幸福',
                'image' => env('APP_URL') . '/web0708/Fujacook/img/即食餐.jpg',
                'url' => env('APP_URL') . '/#',
                'style' => 'E-img-r',
                'open' => $data['open'],
            ],
        ];
        foreach ($scenes as $scene) {
            Scene::create($scene);
        }


        //home ,about footer
        $data = ['type' => 'footer.home', 'open' => 1];
        $scenes = [
            [
                'type' => $data['type'],
                'title' => 'CONTACT US',
                'summary' => 'footer1',
                'detail' => '<li>
                                <b>客服專線</b>
                                <div class="tel">
                                    <span class="phone oswald">+886-2-2222-5988</span>
                                </div>
                                <dl>
                                    <dt>營業時間 9:00 - 18:00</dt>
                                    <dd>例假日休</dd>
                                </dl>
                            </li>',
                'image' => env('APP_URL') . '/images/empty.jpg',
                'url' => 'https://0848ishida.jp/contact',
                'open' => $data['open'],
            ],
        ];
        foreach ($scenes as $scene) {
            Scene::create($scene);
        }
    }
}
