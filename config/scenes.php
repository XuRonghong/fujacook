<?php
return [
    //navbar.home
    [
        'type' => 'navbar.home', 'summary' => '首頁', 'open' => 1, 'url' => '/',
    ], [
        'type' => 'navbar.home', 'summary' => '關於FUJACOOK', 'open' => 1, 'url' => '/about',
    ], [
        'type' => 'navbar.home', 'summary' => '媒體報導', 'open' => 1, 'url' => '/reports',
    ], [
        'type' => 'navbar.home', 'summary' => '即食鍋', 'open' => 1, 'url' => '#',
    ], [
        'type' => 'navbar.home', 'summary' => '即時餐', 'open' => 1, 'url' => '#',
    ], [
        'type' => 'navbar.home', 'summary' => '最新消息', 'open' => 1, 'url' => '/news',
    ], [
        'type' => 'navbar.home', 'summary' => '聯繫我們', 'open' => 1, 'url' => '/contactus',
    ],
    //navbar.about
    [
        'type' => 'navbar.about', 'summary' => '創辦人介紹', 'open' => 1, 'url' => '/',
    ], [
        'type' => 'navbar.about', 'summary' => '專利獎項', 'open' => 1, 'url' => '/about',
    ], [
        'type' => 'navbar.about', 'summary' => '研發理念', 'open' => 1, 'url' => '/report',
    ], [
        'type' => 'navbar.about', 'summary' => '品牌沿革', 'open' => 1, 'url' => '#',
    ], [
        'type' => 'navbar.about', 'summary' => '核心價值', 'open' => 1, 'url' => '#',
    ],


    //slider.home
    [
        'type' => 'slider.home',
        'title' => 'banner01',
        'image' => env('APP_URL') . '/web0617/img/slide01.jpg',
        'url' => env('APP_URL') . '/#',
        'open' => 1,
    ],
    [
        'type' => 'slider.home',
        'title' => 'banner02',
        'image' => env('APP_URL') . '/web0617/img/slide02.jpg',
        'url' => env('APP_URL') . '/#',
        'open' => 1,
    ],
    //slider.about
    [
        'type' => 'slider.about',
        'title' => 'BRAND',
        'summary' => '顛覆鍋具歷史<br>最實用且有趣的全新烹煮方式',
        'image' => env('APP_URL') . '/web0708/Fujacook/img/FUJACOOK LOGO 牌示意圖.jpg',
        'url' => env('APP_URL') . '/#',
        'open' => 1,
    ],


    //introduce.home
    [
        'type' => 'introduce.home.t01',
        'title' => '首頁介紹1',
        'image' => env('APP_URL') . '/web0617/img/introduce01.jpg',
        'url' => env('APP_URL') . '/#',
        'open' => 1,
    ],
    [
        'type' => 'introduce.home.t01',
        'title' => '首頁介紹2',
        'image' => env('APP_URL') . '/web0617/img/introduce02.jpg',
        'url' => env('APP_URL') . '/#',
        'open' => 1,
    ],


    //introduce.about
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
        'open' => 1,
    ],
    [
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
        'open' => 1,
    ],
    [
        'type' => 'introduce.about.t05',
        'title' => '核心價值',
        'image' => env('APP_URL') . '/web0708/Fujacook/img/核心價值.jpg',
        'url' => env('APP_URL') . '/#',
        'open' => 1,
    ],


    //image.home.section1
    [
        'type' => 'image.home.section1',
        'title' => 'image1',
        'summary' => '中間大圖1',
        'image' => env('APP_URL') . '/web0617/img/introduce03.jpg',
        'url' => env('APP_URL') . '/#',
        'open' => 1,
    ],
    [
        'type' => 'image.home.section1',
        'title' => 'image2',
        'summary' => '中間大圖2',
        'image' => env('APP_URL') . '/web0617/img/introduce04.jpg',
        'url' => env('APP_URL') . '/#',
        'open' => 1,
    ],
    [
        'type' => 'image.home.section1',
        'title' => 'image3',
        'summary' => '中間大圖3',
        'image' => env('APP_URL') . '/web0617/img/introduce05.jpg',
        'url' => env('APP_URL') . '/#',
        'open' => 1,
    ],


    //image.home.section3
    [
        'type' => 'image.home.section3',
        'title' => '即食鍋',
        'summary' => '即時 • 歡樂',
        'image' => env('APP_URL') . '/web0708/Fujacook/img/即食鍋.jpg',
        'url' => env('APP_URL') . '/#',
        'style' => 'E-img-l',
        'open' => 1,
    ],
    [
        'type' => 'image.home.section3',
        'title' => '即食餐',
        'summary' => '即時 • 幸福',
        'image' => env('APP_URL') . '/web0708/Fujacook/img/即食餐.jpg',
        'url' => env('APP_URL') . '/#',
        'style' => 'E-img-r',
        'open' => 1,
    ],


    //footer.home
    [
        'type' => 'footer.home',
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
        'open' => 1,
    ],
];
