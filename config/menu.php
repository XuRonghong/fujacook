<?php
return [
    // admin Backend Menu
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
                        //管理員帳號
                        "id" => 119,
                        "parent_id" => 11,
                        "name" => "admin.user.admins",
                        "link" => 'admin/admins',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,    //無子類別
                    ],
                    [
                        //一般會員管理
                        "id" => 111,
                        "parent_id" => 11,
                        "name" => "admin.user.members",
                        "link" => 'admin/members',
                        "access" => "1,2",
                        "open" => 0,
                        "sub_menu" => 0,
                    ],
                    [
                        //店家會員管理
                        "id" => 113,
                        "parent_id" => 11,
                        "name" => "admin.user.store",
                        "link" => 'admin/store',
                        "access" => "1,2",
                        "open" => 0,
                        "sub_menu" => 0,
                    ],
                    [
                        //供應商會員管理
                        "id" => 115,
                        "parent_id" => 11,
                        "name" => "admin.user.supplier",
                        "link" => 'admin/supplier',
                        "access" => "1,2",
                        "open" => 0,
                        "sub_menu" => 0,
                    ],
                ]
            ],
            [
                //Permission管理
                "id" => 18,
                "parent_id" => 1,
                "name" => "admin.permissions",
                "link" => "admin/permissions",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //選單管理
                "id" => 19,
                "parent_id" => 1,
                "name" => "admin.menu",
                "link" => "admin/menus",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 0,
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
                        "link" => 'admin.group.member',
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
            [
                //匯率管理
                "id" => 13,
                "parent_id" => 1,
                "name" => "admin.exchange_rate",
                "link" => "",
                "access" => "1,2",
                "open" => 0,
                "sub_menu" => 1,
                "child" => [
                    [
                        //匯率設定
                        "id" => 131,
                        "parent_id" => 13,
                        "name" => "admin.exchange_rate.index",
                        "link" => "admin.exchange_rate.index",
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                    [
                        //歷史匯率
                        "id" => 132,
                        "parent_id" => 13,
                        "name" => "admin.exchange_rate.log",
                        "link" => "admin.exchange_rate.log",
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
                "link" => "admin.category",
                "vCss" => "",
                "access" => "1,2",
                "open" => 0,
                "sub_menu" => 0,
            ],
            [
                //系統參數設置
                "id" => 17,
                "parent_id" => 1,
                "name" => "admin.config",
                "link" => "web.admin.config",
                "access" => "1,2",
                "open" => 0,
                "sub_menu" => 0,
            ],
        ],
    ],
    //
    [
        //廣告管理
        "id" => 5,
        "parent_id" => 0,
        "name" => "advertising",
        "link" => "",
        "sub_menu" => 1,
        "access" => "1,2",
        "open" => 0,
        "child" => [
            [
                //平台推薦商品管理
                "id" => 501,
                "name" => "advertising.recommend",
                "link" => "admin.advertising.recommend",
                "sub_menu" => 0,
                "parent_id" => 5,
                "access" => "1,2",
                "open" => 1,
            ],
        ]
    ],
    //
    [
        //介面管理
        "id" => 6,
        "parent_id" => 0,
        "name" => "scenes",
        "link" => "",
        "access" => "1,2",
        "open" => 1,
        "sub_menu" => 1,
        "child" => [
            [
                //登入畫面
                "id" => 601,
                "parent_id" => 6,
                "name" => "scenes.login",
                "link" => "",
                "access" => "1,2",
                "open" => 0,
                "sub_menu" => 1,
                "child" => [
                    [
                        //背景圖
                        "id" => 60101,
                        "parent_id" => 601,
                        "name" => "scenes.login.background",
                        "link" => "admin/scenes/login/background",
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
            ],
            [
                //首頁畫面
                "id" => 602,
                "parent_id" => 6,
                "name" => "scenes.home",
                "link" => "",
                "access" => "1,2",
                "open" => 1,
                "sub_menu" => 1,
                "child" => [
                    [
                        //滑動圖
                        "id" => 60201,
                        "parent_id" => 602,
                        "name" => "scenes.home.slider",
                        "link" => "admin/scenes/home",
                        "access" => "1,2",
                        "open" => 1,
                        "sub_menu" => 0,
                    ],
                ]
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
                        "name" => "scenes.header.url",
                        "link" => "web/scenes/header/url",
                        "vCss" => "",
                        "parent_id" => 603,
                        "access" => "1,2",
                        "sub_menu" => 0,
                        "open" => 1,
                    ],
                ]
            ],
        ]
    ],
    [
        //信息管理
        "id" => 4001,
        "parent_id" => 0,
        "name" => "information",
        "link" => "",
        "access" => "1,2,11,12",
        "open" => 1,
        "sub_menu" => 1,
        "child" => [
            [
                //公告
                "id" => 40011,
                "parent_id" => 4001,
                "name" => "information.announceme",
                "link" => "admin/announceme",
                "access" => "1,2,11,12",
                "open" => 0,
                "sub_menu" => 0,
            ],
            [
                //最新消息
                "id" => 40012,
                "parent_id" => 4001,
                "name" => "information.news",
                "link" => "admin/news",
                "access" => "1,2,11,12",
                "open" => 1,
                "sub_menu" => 0,
            ],
            [
                //訊息
                "id" => 40013,
                "parent_id" => 4001,
                "name" => "information.messages",
                "link" => "admin/messages",
                "access" => "1,2,11,12",
                "open" => 0,
                "sub_menu" => 0,
            ],
        ]
    ],
    // product
    [
        //商品管理
        "parent_id" => 0,
        "id" => 1001,
        "name" => "product",
        "link" => "",
        "sub_menu" => 1,
        "access" => "1,2,11,12",
        "open" => 0,
        "child" => [
            [
                //商品類別設置
                "id" => 10011,
                "name" => "product.category",
                "link" => "admin.product.category",
                "sub_menu" => 0,
                "parent_id" => 1001,
                "access" => "1,2,11,12",
                "open" => 1,
                "rank" => 1
            ],
            [
                //商品管理
                "id" => 10012,
                "parent_id" => 1001,
                "name" => "product.manage",
                "link" => "admin.product.manage",
                "sub_menu" => 0,
                "access" => "1,2,11,12",
                "open" => 1,
                "rank" => 2,
            ],
            [
                //運費管理
                "id" => 10013,
                "parent_id" => 1001,
                "name" => "product.shipping",
                "link" => "admin.product.shipping",
                "sub_menu" => 0,
                "access" => "1,2,11,12",
                "open" => 1,
                "rank" => 3
            ],
            [
                //付款方式
                "id" => 10014,
                "parent_id" => 1001,
                "name" => "product.pay",
                "link" => "admin.product.pay",
                "sub_menu" => 0,
                "access" => "1,2,11,12",
                "open" => 1,
                "rank" => 4
            ],
            [
                //商品修改記錄
                "id" => 10019,
                "parent_id" => 1001,
                "name" => "product.log",
                "link" => "admin.product.log",
                "sub_menu" => 0,
                "access" => "1,2",
                "open" => 1,
                "rank" => 9
            ],
        ],
    ],
];

$storage = [
    // order
    [
        //訂單管理
        "id" => 2001,
        "name" => "order",
        "link" => "",
        "vCss" => "fa-list",
        "sub_menu" => 1,
        "parent_id" => 0,
        "access" => "1,2,11,12",
        "open" => 1,
        "child" =>
            [
                [
                    //商品訂單
                    "id" => 20011,
                    "name" => "order.product",
                    "link" => "web/order/product",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 2001,
                    "access" => "1,2,11,12",
                    "open" => 1,
                ],
            ]
    ],
    // activity
    [
        //活動管理
        "id" => 3001,
        "name" => "activity",
        "link" => "",
        "vCss" => "fa-list",
        "sub_menu" => 1,
        "parent_id" => 0,
        "access" => "1,2,11,12",
        "open" => 1,
        "child" =>
            [
                [
                    //優惠券
                    "id" => 30011,
                    "name" => "activity.coupon",
                    "link" => "",
                    "vCss" => "",
                    "sub_menu" => 1,
                    "parent_id" => 3001,
                    "access" => "1,2,11,12",
                    "open" => 0,
                    "child" =>
                        [
                            [
                                //優惠券
                                "id" => 300111,
                                "name" => "activity.coupon.ticket",
                                "link" => "web/activity/coupon/ticket",
                                "vCss" => "",
                                "sub_menu" => 1,
                                "parent_id" => 30011,
                                "access" => "1,2,11,12",
                                "open" => 0,
                            ],
                            [
                                //優惠代碼
                                "id" => 300112,
                                "name" => "activity.coupon.promotion_code",
                                "link" => "web/activity/coupon/promotion_code",
                                "vCss" => "",
                                "sub_menu" => 0,
                                "parent_id" => 30011,
                                "access" => "1,2,11,12",
                                "open" => 1,
                            ],
                            [
                                //優惠券牆
                                "id" => 300113,
                                "name" => "activity.coupon.gallery",
                                "link" => "web/activity/coupon/gallery",
                                "vCss" => "",
                                "sub_menu" => 0,
                                "parent_id" => 30011,
                                "access" => "1,2,11,12",
                                "open" => 0,
                            ],
                        ]
                ],
                [
                    //點數
                    "id" => 30012,
                    "name" => "activity.coin",
                    "link" => "",
                    "vCss" => "",
                    "sub_menu" => 1,
                    "parent_id" => 3001,
                    "access" => "1,2,11,12",
                    "open" => 0,
                    "child" =>
                        [
                            [
                                //點數活動
                                "id" => 300121,
                                "name" => "activity.coin.index",
                                "link" => "web/activity/coin/index",
                                "vCss" => "",
                                "sub_menu" => 1,
                                "parent_id" => 30012,
                                "access" => "1,2,11,12",
                                "open" => 1,
                            ],
                            [
                                //點數管理
                                "id" => 300122,
                                "name" => "activity.coin.manage",
                                "link" => "web/activity/coin/manage",
                                "vCss" => "",
                                "sub_menu" => 0,
                                "parent_id" => 30012,
                                "access" => "1,2,11,12",
                                "open" => 1,
                            ],
                        ]
                ],
                [
                    //活動訊息
                    "id" => 30013,
                    "name" => "activity.reservoir",
                    "link" => "",
                    "vCss" => "",
                    "sub_menu" => 1,
                    "parent_id" => 3001,
                    "access" => "1,2,11,12",
                    "open" => 0,
                    "child" =>
                        [
                            [
                                //活動訊息
                                "id" => 300131,
                                "name" => "activity.reservoir.index",
                                "link" => "web/activity/reservoir/index",
                                "vCss" => "",
                                "sub_menu" => 1,
                                "parent_id" => 30013,
                                "access" => "1,2,11,12",
                                "open" => 1,
                            ],
                        ]
                ],
                [
                    //活動報名
                    "id" => 30014,
                    "name" => "activity.sign_up",
                    "link" => "",
                    "vCss" => "",
                    "sub_menu" => 1,
                    "parent_id" => 3001,
                    "access" => "1,2,11,12",
                    "open" => 0,
                    "child" =>
                        [
                            [
                                //活動報名
                                "id" => 300141,
                                "name" => "activity.sign_up.index",
                                "link" => "web/activity/sign_up/index",
                                "vCss" => "",
                                "sub_menu" => 1,
                                "parent_id" => 30014,
                                "access" => "1,2,11,12",
                                "open" => 1,
                            ],
                        ]
                ],
                [
                    //活動檔期
                    "id" => 30015,
                    "name" => "activity.schedule",
                    "link" => "web/activity/schedule",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 3001,
                    "access" => "1,2,11,12",
                    "open" => 1,
//                            "child" =>
//                                [
//                                    [
//                                        //活動檔期
//                                        "id" => 300151,
//                                        "name" => "activity.schedule.index",
//                                        "link" => "web/activity/schedule/index",
//                                        "vCss" => "",
//                                        "sub_menu" => 0,
//                                        "parent_id" => 30015,
//                                        "access" => "1,2,11,12",
//                                        "open" => 1,
//                                    ],
//                                ]
                ],
            ],
    ],
    [
        //客服專區
        "id" => 5001,
        "name" => "service",
        "link" => "",
        "vCss" => "fa-list",
        "sub_menu" => 1,
        "parent_id" => 0,
        "access" => "1,2,11,12",
        "open" => 0,
        "child" =>
            [
                [
                    //公告訊息
                    "id" => 50011,
                    "name" => "service.message",
                    "link" => "web/service/message",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 5001,
                    "access" => "1,2,11,12",
                    "open" => 0,
                ],
            ]
    ],
    [
        //商家管理
        "id" => 9001,
        "name" => "store",
        "link" => "",
        "vCss" => "fa-list",
        "sub_menu" => 1,
        "parent_id" => 0,
        "access" => "1,2,11,12,41",
        "open" => 0,
        "child" =>
            [
                [
                    //商家資料
                    "id" => 90011,
                    "name" => "store.index",
                    "link" => "web/store/index",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 9001,
                    "access" => "1,2,11,12,41",
                    "open" => 1,
                ],
                [
                    //商家資料
                    "id" => 90012,
                    "name" => "store.attr",
                    "link" => "web/store/attr",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 9001,
                    "access" => "1,2,11,12,41",
                    "open" => 1,
                ],
                [
                    //商家資料
                    "id" => 90013,
                    "name" => "store.slider",
                    "link" => "web/store/slider",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 9001,
                    "access" => "1,2,11,12,41",
                    "open" => 1,
                ],
                [
                    //智付通申請
                    "id" => 90019,
                    "name" => "store.pay_service",
                    "link" => "web/store/pay_service",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 9001,
                    "access" => "1,2,11,12,41",
                    "open" => 1,
                ],
                [
                    //元大支付設定
                    "id" => 900111,
                    "name" => "store.ytbank",
                    "link" => "web/store/ytbank",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 9001,
                    "access" => "1,2,11,12,41",
                    "open" => 1,
                ],
                [
                    //新光支付設定
                    "id" => 900112,
                    "name" => "store.skbank",
                    "link" => "web/store/skbank",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 9001,
                    "access" => "1,2,11,12,41",
                    "open" => 1,
                ],
            ]
    ],
    [
        //
        "id" => 99001,
        "name" => "log",
        "link" => "",
        "vCss" => "fa-list",
        "sub_menu" => 1,
        "parent_id" => 0,
        "access" => "1,2,11,12",
        "open" => 0,
        "child" =>
            [
                [
                    //
                    "id" => 9900101,
                    "name" => "log.log01",
                    "link" => "web/log/log01",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 99001,
                    "access" => "1,2,11,12",
                    "open" => 1,
                ],
            ]
    ],
    [
        //
        "id" => 999001,
        "name" => "other_sys",
        "link" => "",
        "vCss" => "fa-list",
        "sub_menu" => 1,
        "parent_id" => 0,
        "access" => "1,2,11,12",
        "open" => 0,
        "child" =>
            [
                [
                    //
                    "id" => 99900101,
                    "name" => "other_sys.b01",
                    "link" => "web/other_sys/b01",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 999001,
                    "access" => "1,2,11,12",
                    "open" => 1,
                ],
                [
                    //
                    "id" => 99900102,
                    "name" => "other_sys.b02",
                    "link" => "web/other_sys/b02",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 999001,
                    "access" => "1,2,11,12",
                    "open" => 1,
                ],
                [
                    //
                    "id" => 99900103,
                    "name" => "other_sys.b03",
                    "link" => "web/other_sys/b03",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 999001,
                    "access" => "1,2,11,12",
                    "open" => 1,
                ],
                [
                    //
                    "id" => 99900104,
                    "name" => "other_sys.b04",
                    "link" => "web/other_sys/b04",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 999001,
                    "access" => "1,2,11,12",
                    "open" => 1,
                ],
                [
                    //
                    "id" => 100015,
                    "name" => "other_sys.b05",
                    "link" => "web/other_sys/b05",
                    "vCss" => "",
                    "sub_menu" => 0,
                    "parent_id" => 10001,
                    "access" => "1,2,11,12",
                    "open" => 1,
                ],
            ]
    ],
];
