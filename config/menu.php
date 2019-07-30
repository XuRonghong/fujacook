<?php
return [
    // admin Backend Menu.   ps:目前還不知道'access'要做啥?
    [
        //管理員功能
        "id" => 1,
        "parent_id" => 0,   //父類別
        "name" => "admin",
        "link" => "",
        "access" => "1,2",   //暫時無功能
        "open" => 1,
        "sub_menu" => 1,    //有子分類
        "child" => [
            [
                //帳號管理
                "id" => 11,
                "parent_id" => 1,
                "name" => "admin.user",
                "link" => "",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 1,
                "child" => [
                    [
                        //一般會員管理
                        "id" => 111,
                        "parent_id" => 11,
                        "name" => "admin.user.members",
                        "link" => 'admin/members',
                        "access" => "1,2",
                        "open" => 0,
                        "sub_menu" => 0,    //無子類別
                    ],
//                    [
                        //店家會員管理
//                        "id" => 113,
//                        "parent_id" => 11,
//                        "name" => "admin.user.store",
//                        "link" => 'admin/store',
//                        "access" => "1,2",
//                        "open" => 0,
//                        "sub_menu" => 0,
//                    ],
//                    [
                        //供應商會員管理
//                        "id" => 115,
//                        "parent_id" => 11,
//                        "name" => "admin.user.supplier",
//                        "link" => 'admin/supplier',
//                        "access" => "1,2",
//                        "open" => 0,
//                        "sub_menu" => 0,
//                    ],
                    [
                        //管理員帳號
                        "id" => 119,
                        "parent_id" => 11,
                        "name" => "admin.user.admins",
                        "link" => 'admin/admins',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
            [
                //群組管理
                "id" => 12,
                "parent_id" => 1,
                "name" => "admin.group",
                "link" => "",
                "access" => "1,2",
                "open" => 0,
                "sub_menu" => 1,
                "child" => [
                    [
                        //一般會員管理
                        "id" => 121,
                        "parent_id" => 12,
                        "name" => "admin.group.member",
                        "link" => 'admin/group/member',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //店家會員管理
                        "id" => 123,
                        "parent_id" => 12,
                        "name" => "admin.group.store",
                        "link" => 'admin/group/store',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //供應商會員管理
                        "id" => 125,
                        "parent_id" => 12,
                        "name" => "admin.group.supplier",
                        "link" => 'admin/group/supplier',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //管理員帳號
                        "id" => 129,
                        "parent_id" => 12,
                        "name" => "admin.group.admins",
                        "link" => 'admin/group/admins',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
            [
                //系統類別設置
                "id" => 14,
                "parent_id" => 1,
                "name" => "admin.category",
                "link" => "admin/category",
                "vCss" => "",
                "access" => "1,2",
                "open" => 0,
                "sub_menu" => 0,
            ],
            [
                //log管理
                "id" => 17,
                "parent_id" => 1,
                "name" => "admin.log",
                "link" => "",
                "access" => "1,2",
                "open" => 1,
                "rank" => 9,
                "sub_menu" => 1,
                "child" => [
                    [
                        //login
                        "id" => 171,
                        "parent_id" => 17,
                        "name" => "admin.log.login",
                        "link" => 'admin/log/login',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //action
                        "id" => 172,
                        "parent_id" => 17,
                        "name" => "admin.log.action",
                        "link" => 'admin/log/action',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
            [
                //Permission管理
                "id" => 18,
                "parent_id" => 1,
                "name" => "admin.permission",
                "link" => "",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 1,
                "child" => [
                    [
                        //permission列表
                        "id" => 181,
                        "parent_id" => 18,
                        "name" => "admin.permission.list",
                        "link" => 'admin/permissions',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //管理者權限
                        "id" => 182,
                        "parent_id" => 18,
                        "name" => "admin.permission.admin_permission",
                        "link" => 'admin/permission/admin_permission',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
            [
                //選單管理
                "id" => 19,
                "parent_id" => 1,
                "name" => "admin.menu",
                "link" => "",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 1,
                "child" => [
                    [
                        //選項列表
                        "id" => 191,
                        "parent_id" => 19,
                        "name" => "admin.menu.list",
                        "link" => 'admin/menus',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //管理者選項
                        "id" => 192,
                        "parent_id" => 19,
                        "name" => "admin.menu.admin_menu",
                        "link" => 'admin/menu/admin_menu',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
            //store
            [
                //商家管理
                "id" => 21,
                "parent_id" => 1,
                "name" => "store",
                "link" => "",
                "access" => "1,2,11,12,41",
                "open" => 0,
                "sub_menu" => 1,
                "child" => [
                    [
                        //商家
                        "id" => 2101,
                        "parent_id" => 21,
                        "name" => "store.index",
                        "link" => "admin/store/home",
                        "access" => "1,2,11,12,41",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //商家資料
                        "id" => 2102,
                        "parent_id" => 21,
                        "name" => "store.attr",
                        "link" => "admin/store/attr",
                        "access" => "1,2,11,12,41",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //智付通申請
                        "id" => 2111,
                        "parent_id" => 21,
                        "name" => "store.pay_service",
                        "link" => "admin/store/pay_service",
                        "access" => "1,2,11,12,41",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //元大支付設定
                        "id" => 2112,
                        "parent_id" => 21,
                        "name" => "store.ytbank",
                        "link" => "admin/store/ytbank",
                        "access" => "1,2,11,12,41",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //新光支付設定
                        "id" => 2113,
                        "parent_id" => 21,
                        "name" => "store.skbank",
                        "link" => "admin/store/skbank",
                        "access" => "1,2,11,12,41",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
            //supplier
            [
                //供應廠商
                "id" => 22,
                "parent_id" => 1,
                "name" => "supplier",
                "link" => "",
                "access" => "1,2,11,12,41",
                "open" => 0,
                "sub_menu" => 1,
                "child" => [
                    [
                        //供應廠商資料
                        "id" => 2201,
                        "parent_id" => 22,
                        "name" => "supplier.index",
                        "link" => "admin/supplier/index",
                        "sub_menu" => 0,
                        "access" => "1,2,11,12,41",
                        "open" => 1,
                    ],
                ]
            ],
            //article
            [
                //文章管理
                "id" => 31,
                "parent_id" => 1,
                "name" => "article",
                "link" => "admin/article",
                "access" => "1,2",
                "open" => 0,
                "sub_menu" => 0,
            ],
        ],
    ],
    [
        //信息管理
        "id" => 2,
        "parent_id" => 0,
        "name" => "information",
        "link" => "",
        "access" => "1,2,11,12",
        "open" => 1,
        "sub_menu" => 1,
        "child" => [
            [
                //公告
                "id" => 201,
                "parent_id" => 2,
                "name" => "information.announce",
                "link" => "admin/information/announce",
                "access" => "1,2,11,12",
                "open" => 0,
                "sub_menu" => 0,
            ],
            [
                //最新消息
                "id" => 202,
                "parent_id" => 2,
                "name" => "information.news",
                "link" => "admin/information/news",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //訊息
                "id" => 203,
                "parent_id" => 2,
                "name" => "information.messages",
                "link" => "admin/information/messages",
                "access" => "1,2,11,12",
                "open" => 0,
                "sub_menu" => 0,
            ],
            [
                //媒體報導
                "id" => 204,
                "parent_id" => 2,
                "name" => "information.reports",
                "link" => "admin/information/reports",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //notifications
                "id" => 205,
                "parent_id" => 2,
                "name" => "information.notifications",
                "link" => "admin/information/notifications",
                "access" => "1,2,11,12",
                "open" => 0,
                "sub_menu" => 0,
            ],
        ]
    ],
    [
        //商品管理
        "id" => 3,
        "parent_id" => 0,
        "name" => "product",
        "link" => "",
        "access" => "1,2,11,12",
        "open" => 1,
        "sub_menu" => 1,
        "child" => [
            [
                //商品類別設置
                "id" => 301,
                "parent_id" => 3,
                "name" => "product.category",
                "link" => "admin/product/category",
                "sub_menu" => 0,
                "access" => "1,2,11,12",
                "open" => 1,
                "rank" => 1
            ],
            [
                //商品管理
                "id" => 302,
                "parent_id" => 3,
                "name" => "product.manage",
                "link" => "",
                "access" => "1,2,11,12",
                "open" => 1,
                "rank" => 2,
                "sub_menu" => 1,
                "child" => [
                    [
                        //商品
                        "id" => 3021,
                        "parent_id" => 302,
                        "name" => "product.manage.museum_a01",
                        "link" => "admin/product/manage",
                        "access" => "1,2,11,12",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //商品規格
                        "id" => 3022,
                        "parent_id" => 302,
                        "name" => "product.manage.spec",
                        "link" => "admin/product/spec",
                        "access" => "1,2,11,12",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ],
            ],
            [
                //組合商品設置
                "id" => 303,
                "parent_id" => 3,
                "name" => "product.combinations",
                "link" => "admin/product/combinations",
                "sub_menu" => 0,
                "access" => "1,2,11,12",
                "open" => 1,
                "rank" => 3
            ],
            [
                //運費管理
                "id" => 305,
                "parent_id" => 3,
                "name" => "product.shipping",
                "link" => "admin/product/shipping",
                "sub_menu" => 0,
                "access" => "1,2,11,12",
                "open" => 0,
                "rank" => 5
            ],
            [
                //付款方式
                "id" => 306,
                "parent_id" => 3,
                "name" => "product.pay",
                "link" => "admin/product/pay",
                "sub_menu" => 0,
                "access" => "1,2,11,12",
                "open" => 0,
                "rank" => 6
            ],
            [
                //商品修改記錄
                "id" => 309,
                "parent_id" => 3,
                "name" => "product.log",
                "link" => "admin/product/log",
                "sub_menu" => 0,
                "access" => "1,2",
                "open" => 0,
                "rank" => 9
            ],
        ],
    ],
    [
        //訂單管理
        "id" => 4,
        "parent_id" => 0,
        "name" => "order",
        "link" => "",
        "access" => "1,2,11,12",
        "open" => 1,
        "sub_menu" => 1,
        "child" => [
            [
                //商品訂單
                "id" => 401,
                "parent_id" => 4,
                "name" => "order.product",
                "link" => "admin/order/product",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //商品訂單詳情
                "id" => 4011,
                "parent_id" => 4,
                "name" => "order.detail",
                "link" => "admin/order/detail",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //商品訂單寄送地址
                "id" => 4012,
                "parent_id" => 4,
                "name" => "order.contact",
                "link" => "admin/order/contact",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
            ],
        ],
    ],
    [
        //廣告管理
        "id" => 5,
        "parent_id" => 0,
        "name" => "advertising",
        "link" => "",
        "access" => "1,2",
        "open" => 0,
        "sub_menu" => 1,
        "child" => [
            [
                //平台推薦商品管理
                "id" => 501,
                "parent_id" => 5,
                "name" => "advertising.recommend",
                "link" => "admin/advertising/recommend",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //促銷活動
                "id" => 502,
                "parent_id" => 5,
                "name" => "advertising.promotions",
                "link" => "admin/advertising/promotions",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //廣告類別設置
                "id" => 506,
                "parent_id" => 5,
                "name" => "advertising.category",
                "link" => "admin/advertising/category",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //廣告管理
                "id" => 507,
                "parent_id" => 5,
                "name" => "advertising.manage",
                "link" => "admin/advertising/manage",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
            ],
        ]
    ],
    [
        //介面管理-前台
        "id" => 6,
        "parent_id" => 0,
        "name" => "scenes",
        "link" => "",
        "access" => "1,2",
        "open" => 1,
        "sub_menu" => 1,
        "child" => [
            [
                //選單欄
                "id" => 601,
                "parent_id" => 6,
                "name" => "scenes.navbar",
                "link" => "admin/scenes/navbar",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
//                "child" => [
//                    [
                        //首頁
//                        "id" => 60101,
//                        "parent_id" => 601,
//                        "name" => "scenes.slider.home",
//                        "link" => "admin/scenes/slider",
//                        "access" => "1,2",
//                        "open" => 1,
//                        "sub_menu" => 0,
//                    ],
//                ]
            ],
            [
                //滑動圖
                "id" => 602,
                "parent_id" => 6,
                "name" => "scenes.slider",
                "link" => "admin/scenes/slider",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
//                "child" => [
//                    [
                        //首頁
//                        "id" => 60201,
//                        "parent_id" => 602,
//                        "name" => "scenes.slider.home",
//                        "link" => "",
//                        "access" => "1,2",
//                        "open" => 1,
//                        "sub_menu" => 0,
//                    ],
//                ]
            ],
            [
                //header畫面
                "id" => 603,
                "parent_id" => 6,
                "name" => "scenes.header",
                "link" => "",
                "access" => "1,2",
                "open" => 0,
                "sub_menu" => 1,
                "child" => [
                    [
                        //連結編輯
                        "id" => 60301,
                        "parent_id" => 603,
                        "name" => "scenes.header.url",
                        "link" => "admin/scenes/header/url",
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
            [
                //文字介紹
                "id" => 605,
                "parent_id" => 6,
                "name" => "scenes.introduce",
                "link" => "admin/scenes/introduce",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //image
                "id" => 606,
                "parent_id" => 6,
                "name" => "scenes.image",
                "link" => "admin/scenes/image",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
                /*"child" => [
                    [
                        // section 1
                        "id" => 60601,
                        "parent_id" => 606,
                        "name" => "scenes.image.60601",
                        "link" => "admin/scenes/image/60601",
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        // section 2
                        "id" => 60602,
                        "parent_id" => 606,
                        "name" => "scenes.image.60602",
                        "link" => "admin/scenes/image/60602",
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        // section 3
                        "id" => 60603,
                        "parent_id" => 606,
                        "name" => "scenes.image.60603",
                        "link" => "admin/scenes/image/60603",
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]*/
            ],
            [
                //footer
                "id" => 608,
                "parent_id" => 6,
                "name" => "scenes.footer",
                "link" => "admin/scenes/footer",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
            ],
            //
            [
                //登入畫面
                "id" => 611,
                "parent_id" => 6,
                "name" => "scenes.login",
                "link" => "",
                "access" => "1,2",
                "open" => 0,
                "sub_menu" => 1,
                "child" => [
                    [
                        //背景圖
                        "id" => 61001,
                        "parent_id" => 611,
                        "name" => "scenes.login.background",
                        "link" => "admin/scenes/login/background",
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ],
            ],
        ],
    ],
    [
        //活動管理
        "id" => 7,
        "parent_id" => 0,
        "name" => "activity",
        "link" => "",
        "access" => "1,2",
        "open" => 1,
        "sub_menu" => 1,
        "child" => [
            [
                //優惠券
                "id" => 701,
                "parent_id" => 7,
                "name" => "activity.coupon",
                "link" => "admin/activity/coupon",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
                "child" => [
                    [
                        //優惠券
                        "id" => 70101,
                        "parent_id" => 701,
                        "name" => "activity.coupon.ticket",
                        "link" => "admin/activity/coupon/ticket",
                        "access" => "1,2,11,12",
                        "open" => 1,
                        "sub_menu" => 1,
                    ],
                    [
                        //優惠代碼
                        "id" => 70102,
                        "parent_id" => 701,
                        "name" => "activity.coupon.promotion_code",
                        "link" => "admin/activity/coupon/promotion_code",
                        "access" => "1,2,11,12",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //優惠券牆
                        "id" => 70103,
                        "parent_id" => 701,
                        "name" => "activity.coupon.gallery",
                        "link" => "admin/activity/coupon/gallery",
                        "access" => "1,2,11,12",
                        "open" => 0,
                        "sub_menu" => 0,
                    ],
                ],
            ],
            [
                //點數
                "id" => 702,
                "parent_id" => 7,
                "name" => "activity.coin",
                "link" => "admin/activity/coin",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
                "child" => [
                    [
                        //點數活動
                        "id" => 70201,
                        "parent_id" => 702,
                        "name" => "activity.coin.index",
                        "link" => "admin/activity/coin/index",
                        "access" => "1,2,11,12",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //點數管理
                        "id" => 70202,
                        "parent_id" => 702,
                        "name" => "activity.coin.manage",
                        "link" => "admin/activity/coin/manage",
                        "access" => "1,2,11,12",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ],
            ],
            [
                //活動訊息
                "id" => 703,
                "parent_id" => 7,
                "name" => "activity.news",
                "link" => "admin/activity/news",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
                "child" => [
                    [
                        //活動訊息
                        "id" => 70301,
                        "parent_id" => 703,
                        "name" => "activity.news.index",
                        "link" => "admin/activity/news/index",
                        "access" => "1,2,11,12",
                        "open" => 1,
                        "sub_menu" => 1,
                    ],
                ]
            ],
            [
                //活動報名
                "id" => 704,
                "parent_id" => 7,
                "name" => "activity.sign_up",
                "link" => "admin/activity/sign_up",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
                "child" => [
                    [
                        //活動報名
                        "id" => 70401,
                        "parent_id" => 704,
                        "name" => "activity.sign_up.index",
                        "link" => "admin/activity/sign_up/index",
                        "access" => "1,2,11,12",
                        "open" => 1,
                        "sub_menu" => 1,
                    ],
                ]
            ],
            [
                //活動檔期
                "id" => 705,
                "parent_id" => 7,
                "name" => "activity.schedule",
                "link" => "admin/activity/schedule",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
                "child" => [
                    [
                        //活動
                        "id" => 70501,
                        "parent_id" => 705,
                        "name" => "activity.schedule.index",
                        "link" => "admin/activity/schedule/index",
                        "access" => "1,2,11,12",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
        ],
    ],
    [
        //客服專區
        "id" => 8,
        "parent_id" => 0,
        "name" => "service",
        "link" => "",
        "access" => "1,2,11,12",
        "open" => 1,
        "sub_menu" => 1,
        "child" => [
            [
                //連繫我們
                "id" => 801,
                "parent_id" => 8,
                "name" => "service.contactus",
                "link" => "admin/service/contactus",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //留言專區
                "id" => 802,
                "parent_id" => 8,
                "name" => "service.message",
                "link" => "admin/service/message",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
            ],
        ]
    ],
    [
        //系統設置
        "id" => 9,
        "parent_id" => 0,
        "name" => "setting",
        "link" => "",
        "sub_menu" => 1,
        "access" => "1,2",
        "open" => 1,
        "child" => [
            [
                //關鍵字
                "id" => 901,
                "parent_id" => 9,
                "name" => "setting.search_keyword",
                "link" => '',
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 1,
                "child" => [
                    [
                        //關鍵字設置
                        "id" => 90101,
                        "parent_id" => 901,
                        "name" => "setting.search_keywords",
                        "link" => 'admin/setting/search_keywords',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //關鍵字記錄
                        "id" => 90102,
                        "parent_id" => 901,
                        "name" => "setting.search_keywords.log",
                        "link" => 'admin/setting/search_keyword/log',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
            [
                //系統參數 meta
                "id" => 902,
                "parent_id" => 9,
                "name" => "setting.parameters",
                "link" => 'admin/setting/parameters',
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //匯率管理
                "id" => 913,
                "parent_id" => 9,
                "name" => "setting.exchange_rate",
                "link" => "",
                "access" => "1,2",
                "open" => 0,
                "sub_menu" => 1,
                "child" => [
                    [
                        //匯率設定
                        "id" => 131,
                        "parent_id" => 13,
                        "name" => "setting.exchange_rate.set",
                        "link" => "admin/setting/exchange_rate/set",
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //歷史匯率
                        "id" => 132,
                        "parent_id" => 13,
                        "name" => "setting.exchange_rate.log",
                        "link" => "admin/setting/exchange_rate/log",
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
        ]
    ],
];
