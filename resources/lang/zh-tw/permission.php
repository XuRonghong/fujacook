<?php
return [
    'admin' =>
        [
            'admins' =>
                [
                    'title'  => '帳號管理-後台帳號管理',
                    'index'  => ' 總覽',
                    'show'   => ' 檢視',
                    'create' => ' 新增',
                    'edit'   => ' 更新',
                    'destroy'=> ' 刪除',
                ],
            'permissions' =>
                [
                    'title'  => '系統參數設定-權限列表',
                    'index'  => ' 總覽',
                    'show'   => ' 檢視',
                    'create' => ' 新增',
                    'edit'   => ' 更新',
                    'destroy'=> ' 刪除',
                ],
            'admin_permission' =>
                [
                    'title'  => '系統參數設定-管理員權限',
                    'index'  => ' 總覽',
                    'show'   => ' 檢視',
                    'create' => ' 新增',
                    'edit'   => ' 更新',
                    'destroy'=> ' 刪除',
                ],
            'menus' =>
                [
                    'title'  => '系統參數設定-menu列表',
                    'index'  => ' 總覽',
                    'show'   => ' 檢視',
                    'create' => ' 新增',
                    'edit'   => ' 更新',
                    'destroy'=> ' 刪除',
                ],
            'admin_menu' =>
                [
                    'title'  => '系統參數設定-管理員menu',
                    'index'  => ' 總覽',
                    'show'   => ' 檢視',
                    'create' => ' 新增',
                    'edit'   => ' 更新',
                    'destroy'=> ' 刪除',
                ],
            'log' =>
                [
                    'login' =>
                        [
                            'title' => '登入紀錄',
                            'index'  => ' 總覽',
                            'show'   => ' 檢視',
                            'create' => ' 新增',
                            'edit'   => ' 更新',
                            'destroy'=> ' 刪除',
                        ],
                    'action' =>
                        [
                            'title' => '操作紀錄',
                            'index'  => ' 總覽',
                            'show'   => ' 檢視',
                            'create' => ' 新增',
                            'edit'   => ' 更新',
                            'destroy'=> ' 刪除',
                        ],
                ],
            'scenes' =>
                [
                    'home' =>
                        [
                            'title' => '首頁場景',
                            'index'  => ' 總覽',
                            'show'   => ' 檢視',
                            'create' => ' 新增',
                            'edit'   => ' 更新',
                            'destroy'=> ' 刪除',
                        ],
                    'news' =>
                        [
                            'title' => '新聞場景',
                            'index'  => ' 總覽',
                            'show'   => ' 檢視',
                            'create' => ' 新增',
                            'edit'   => ' 更新',
                            'destroy'=> ' 刪除',
                        ],
                ],
            'setting' =>
                [
                    'search_keywords' =>
                        [
                            'title' => '前台網站設定-搜尋關鍵字',
                            'index'  => ' 總覽',
                            'show'   => ' 檢視',
                            'create' => ' 新增',
                            'edit'   => ' 更新',
                            'destroy'=> ' 刪除',
                        ],
                    'parameters' =>
                        [
                            'title' => '系統參數設定',
                            'index'  => ' 總覽',
                            'show'   => ' 檢視',
                            'create' => ' 新增',
                            'edit'   => ' 更新',
                            'destroy'=> ' 刪除',
                        ],
                ],
            'news' =>
                [
                    'title' => '最新消息',
                    'index'  => ' 總覽',
                    'show'   => ' 檢視',
                    'create' => ' 新增',
                    'edit'   => ' 更新',
                    'destroy'=> ' 刪除',
                ],
        ],

    'advertising' =>
        [
            'title' => '平台行銷廣告',
            'recommend' =>
                [
                    'title' => '推薦商品管理',
                    'sub' =>
                        [
                            'title' => '推薦商品'
                        ]
                ],
            'keyword' =>
                [
                    'title' => '關鍵字管理',
                    'index' => [
                        'title' => '關鍵字設置',
                    ],
                    'log' => [
                        'title' => '關鍵字記錄',
                    ],
                ],
            'promotions' =>
                [
                    'title' => '促銷活動',
                    'full_amount_m01' =>
                        [
                            'title' => '滿額折扣',
                            'sub' =>
                                [
                                    'title' => '折扣設置'
                                ]
                        ],
                    'full_amount_m02' =>
                        [
                            'title' => '滿額贈送',
                            'sub' =>
                                [
                                    'title' => '商品設置'
                                ]
                        ],
                    'full_amount_m03' =>
                        [
                            'title' => '滿件折扣',
                            'sub' =>
                                [
                                    'title' => '商品設置'
                                ]
                        ],
                    'choose' =>
                        [
                            'title' => '任選活動',
                            'sub' =>
                                [
                                    'title' => '商品設置'
                                ]
                        ],
                    'day_by_day' =>
                        [
                            'title' => '天天特價',
                            'sub' =>
                                [
                                    'title' => '商品設置'
                                ]
                        ]
                ],
            'red_with_green' =>
                [
                    'title' => '紅配綠活動',
                    'promo_p01' =>
                        [
                            'title' => '配對商品享折扣',
                            'sub' =>
                                [
                                    'title' => '商品設置'
                                ]
                        ],
                    'promo_p02' =>
                        [
                            'title' => '配對商品組合價',
                            'sub' =>
                                [
                                    'title' => '商品設置'
                                ]
                        ]
                ],
            'e_gift' =>
                [
                    'title' => '電子禮券',
                    'index' =>
                        [
                            'title' => '電子禮券',
                            'sub' =>
                                [
                                    'title' => '設置禮券'
                                ]
                        ],
                    'member' =>
                        [
                            'title' => '領取人名單',
                        ]
                ],
            'gift' =>
                [
                    'title' => '實體禮券',
                    'index' =>
                        [
                            'title' => '實體禮券',
                        ],
                    'member' =>
                        [
                            'title' => '領取人名單',
                        ]
                ],
            'e_paper' =>
                [
                    'title' => '電子報管理',
                    'index' =>
                        [
                            'title' => '電子報',
                        ],
                    'member' =>
                        [
                            'title' => '收件人名單',
                        ]
                ],
        ],
    'scenes' =>
        [
            'title' => '平台介面管理',
            'navbar' =>
                [
                    'title' => 'navbar',
                    'home' =>
                        [
                            'title' => '首頁畫面',
                        ],
                ],
            'slider' =>
                [
                    'title' => '滑動圖編輯',
                    'home' =>
                        [
                            'title' => '首頁畫面',
                        ],
                ],
            'header' =>
                [
                    'title' => 'header',
                    'home' =>
                        [
                            'title' => '首頁畫面',
                        ],
                ],
            'introduce' =>
                [
                    'title' => '文字介紹編輯',
                    'home' =>
                        [
                            'title' => '首頁畫面',
                        ],
                ],
            'image' =>
                [
                    'title' => 'image編輯',
                    'home' =>
                        [
                            'title' => '首頁畫面',
                        ],
                ],
            'footer' =>
                [
                    'title' => 'footer',
                    'home' =>
                        [
                            'title' => '首頁畫面',
                        ],
                ],



            'login' =>
                [
                    'title' => '登入畫面',
                    'background' =>
                        [
                            'title' => '背景圖編輯',
                        ],
                ],
            'category' =>
                [
                    'title' => '類別畫面',
                    'banner' =>
                        [
                            'title' => 'banner編輯',
                        ],
                ],
            'product' =>
                [
                    'title' => '商品畫面',
                    'banner' =>
                        [
                            'title' => 'banner編輯',
                        ],
                ],
            'cart' =>
                [
                    'title' => '購物車畫面',
                    'banner' =>
                        [
                            'title' => 'banner編輯',
                        ],
                ],
            'order' =>
                [
                    'title' => '訂單畫面',
                    'banner' =>
                        [
                            'title' => 'banner編輯',
                        ],
                ],
            'news' =>
                [
                    'title' => '消息畫面',
                    'banner' =>
                        [
                            'title' => 'banner編輯',
                        ],
                ],
            'member_center' =>
                [
                    'title' => '會員中心畫面',
                    'banner' =>
                        [
                            'title' => 'banner編輯',
                        ],
                ],
        ],
    'product' =>
        [
            'title' => '商品管理',
            'category' => [
                'title' => '商品類別管理',
                'sub' => [
                    'title' => '子類別管理',
                ],
            ],
            'manage' => [
                'title' => '商品庫管理',
                'museum_a01' => [
                    'title' => '一般商品',
                    'add' =>
                        [
                            'title' => '新增商品'
                        ],
                    'edit' =>
                        [
                            'title' => '編輯商品'
                        ],
                    'attributes' =>
                        [
                            'title' => '商品說明'
                        ],
                    'specification' =>
                        [
                            'title' => '商品規格種類',
                            'add' =>
                                [
                                    'title' => '新增商品規格'
                                ],
                        ],
                    'purchase' =>
                        [
                            'title' => '加購商品',
                            'add' =>
                                [
                                    'title' => '新增加購商品'
                                ],
                        ],
                    'recommend' =>
                        [
                            'title' => '推薦商品',
                            'add' =>
                                [
                                    'title' => '新增推薦商品'
                                ],
                        ],
                    'gifts' =>
                        [
                            'title' => '贈品',
                            'add' =>
                                [
                                    'title' => '新增贈品'
                                ],
                        ],
                    'appraise' =>
                        [
                            'title' => '商品評價',
                            'add' =>
                                [
                                    'title' => '新增商品評價'
                                ],
                        ],
                ],
                'museum_a02' => [
                    'title' => 'A02',
                    'add' =>
                        [
                            'title' => '新增商品'
                        ],
                    'edit' =>
                        [
                            'title' => '編輯商品'
                        ],
                    'attributes' =>
                        [
                            'title' => '商品說明'
                        ],
                    'specification' =>
                        [
                            'title' => '商品規格種類',
                            'add' =>
                                [
                                    'title' => '新增商品規格'
                                ],
                        ],
                ],
            ],
            'shipping' => [
                'title' => '運費管理',
                'add' =>
                    [
                        'title' => '新增'
                    ],
                'edit' =>
                    [
                        'title' => '編輯'
                    ]
            ],
            'pay' => [
                'title' => '付款方式',
                'add' =>
                    [
                        'title' => '新增'
                    ],
                'edit' =>
                    [
                        'title' => '編輯'
                    ]
            ],
            'log' => [
                'title' => '商品管理記錄',
            ],
        ],
    'order' =>
        [
            'title' => '訂單功能',
            'product' =>
                [
                    'title' => '訂單管理',
                    'meta' =>
                        [
                            'title' => '訂單明細'
                        ]
                ],
        ],
    'activity' =>
        [
            'title' => '活動管理',
            'coupon' =>
                [
                    'title' => '優惠管理',
                    'ticket' =>
                        [
                            'title' => '優惠券',
                            'add' =>
                                [
                                    'title' => '新增'
                                ],
                            'edit' =>
                                [
                                    'title' => '編輯'
                                ]
                        ],
                    'promotion_code' =>
                        [
                            'title' => '優惠代碼',
                            'add' =>
                                [
                                    'title' => '新增'
                                ],
                            'edit' =>
                                [
                                    'title' => '編輯'
                                ]
                        ],
                    'gallery' =>
                        [
                            'title' => '優惠廣告牆',
                            'add' =>
                                [
                                    'title' => '新增'
                                ],
                            'edit' =>
                                [
                                    'title' => '編輯'
                                ],
                        ]
                ],
            'coin' =>
                [
                    'title' => '飛幣管理',
                    'index' =>
                        [
                            'title' => '飛幣記錄',
                            'add' =>
                                [
                                    'title' => '新增'
                                ],
                            'edit' =>
                                [
                                    'title' => '編輯'
                                ]
                        ],
                    'manage' =>
                        [
                            'title' => '活動管理',
                            'add' =>
                                [
                                    'title' => '新增'
                                ],
                            'edit' =>
                                [
                                    'title' => '編輯'
                                ]
                        ]
                ],
            'news' =>
                [
                    'title' => '活動訊息',
                    'index' =>
                        [
                            'title' => '活動公告',
                            'add' =>
                                [
                                    'title' => '新增'
                                ],
                            'edit' =>
                                [
                                    'title' => '編輯'
                                ]
                        ],
                ],
            'schedule' =>
                [
                    'title' => '活動檔期',
                    'add' =>
                        [
                            'title' => '新增',
                        ],
                    'edit' =>
                        [
                            'title' => '編輯',
                        ],

                    'recommend' =>
                        [
                            'title' => '檔期商品',
                        ],
                    'people' =>
                        [
                            'title' => '檔期人群',
                        ]
                ],
            'sign_up' =>
                [
                    'title' => '報名管理',
                    'index' =>
                        [
                            'title' => '報名表管理',
                            'add' =>
                                [
                                    'title' => '新增'
                                ],
                            'edit' =>
                                [
                                    'title' => '編輯'
                                ]
                        ]
                ]
        ],
    'information' =>
        [
            'title' => '信息管理',
            'announceme' =>
                [
                    'title' => '公告',
                    'index' =>
                        [
                            'title' => '資訊專區',
                        ],
                ],
            'news' =>
            [
                'title' => '最新消息',
                'index' =>
                    [
                        'title' => '資訊專區',
                    ],
            ],
            'messages' =>
                [
                    'title' => '訊息',
                    'index' =>
                        [
                            'title' => '資訊專區',
                        ],
                ],
            'reports' =>
                [
                    'title' => '媒體報導',
                    'index' =>
                        [
                            'title' => '資訊專區',
                        ],
                ],
        ],
    'service' =>
        [
            'title' => '客服專區',
            'message' =>
                [
                    'title' => '留言專區'
                ],
            'contactus' =>
                [
                    'title' => '連繫我們',
                    'index' =>
                        [
                            'title' => '資訊專區',
                        ],
                ],
        ],
];
