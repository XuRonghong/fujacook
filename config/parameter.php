<?php
return [
    'mail' =>
        [
          'ttb' =>
            [
                'address' => 'ronghong@kahap.com'
            ],
        ],
    'admin_access' => [ 1, 2 ],
    'activity' => [
        'coin' => [
            'register_time' => 86400 * 30 * 3,
            'login_time' => 86400 * 30 * 3
        ]
    ],
    'coin_fee' => 0.1,
    'agent_code' => "kahap",
    'center_connection' => env( 'DB_CENTER_CONNECTION' ),
    'fb_appid' => env( 'FB_APPID' ),
    'fb_secret' => env( 'FB_SECRET' ),
    'fb_ver' => env( 'FB_VER' ),
    'g_plus_client_id' => env( 'G_PLUS_CLIENT_ID' ),
    'g_plus_client_pw' => env( 'G_PLUS_CLIENT_PW' ),
    'mall_connection' => env( 'DB_CONNECTION' ),
    'order_limit_time' => env( 'ORDER_LIMIT_TIME' ),
    'order_num_header' => env( 'ORDER_NUM_HEADER', 'TTW' ),
    'order_pay_status' =>
        [
            '0' => '未付款',
            '1' => '已付款',
            '2' => '已取消授權',
            '3' => '已退款',
            '11' => '已取號',
            '99' => '付款失敗',
        ],
    'order_status' =>
        [
            '0' => '尚未處理',
            '1' => '訂單已完成',
            '2' => '訂單已取消',
            '3' => '處理中',
            '4' => '處理中',
            '5' => '已出貨',
            '6' => '待提貨',
        ],
    'productType' => [
        'museum_a01' => 201,
        'museum_a02' => 202,
        'museum_a03' => 203,
        'museum_a04' => 204,
        'museum_a05' => 205,
        'museum_a06' => 206,
        'museum_a07' => 207,
        'museum_a08' => 208,
        'museum_a09' => 209,
        'museum_a10' => 210,
        'museum_a11' => 211,
        'museum_a12' => 212,
    ],
    'sys_category' => [
        'product' => [
            'type' => 1,
            'pid' => 1,
        ],
        'pay' => [
            'type' => 2,
            'pid' => 2,
        ],
        'news' => [
            'type' => 3,
            'pid' => 3,
        ],
        'activity' => [
            'type' => 4,
            'pid' => 4,
        ],
        'museum' => [
            'type' => 5,
            'pid' => 5,
        ],
    ],
    'verification' =>
        [
            'limit' => 12,
            'time' => 3600,
        ],


    'str_num' =>
        [
            'A' => '01',
            'B' => '02',
            'C' => '03',
            'D' => '04',
            'E' => '05',
            'F' => '06',
            'G' => '07',
            'H' => '08',
            'I' => '09',
            'J' => '10',
            'K' => '11',
            'L' => '12',
            'M' => '13',
            'N' => '14',
            'O' => '15',
            'P' => '16',
            'Q' => '17',
            'R' => '18',
            'S' => '19',
            'T' => '20',
            'U' => '21',
            'V' => '22',
            'W' => '23',
            'X' => '24',
            'Y' => '25',
            'Z' => '26'
        ],
    'weekly' =>
        [
            '1' => '一',
            '2' => '二',
            '3' => '三',
            '4' => '四',
            '5' => '五',
            '6' => '六',
            '0' => '日'
        ],
    'str_arr' =>
        [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            //'I',
            'J',
            'K',
            'L',
            'M',
            'N',
            //'O',
            'P',
            'Q',
            'R',
            'S',
            'T',
            'U',
            'V',
            'W',
            'X',
            'Y',
            'Z'
        ],
    'global_keyword' => [
        'admin.logout' => '登出,logout,exit,',
        'admins.create' => '創建管理者,新增管理者,新建管理,新管理,新使用者,加入管理者,create admins,admin create,add admins,new admins',
        'admins.index' => '管理者列表,後台管理員,後臺管理員,admins,manager,administration',
        'admin_permission.create' => '創建權限,新權限,新增權限,加入權限,加權限,create permissions,permission create,add permissions,new permissions',
        'admin_permission.index' => '權限列表,後台權限管理,管理權限,permissions list,all permissions,',
        'permissions.create' => '創建權限,新權限,新增權限,加入權限,加權限,create permissions,permission create,add permissions,new permissions',
        'permissions.index' => '權限列表,後台權限管理,管理權限,permissions list,all permissions,',
        'admin_menu.create' => '創建選項,新選項,新增選項,加入選項,加選項,create menus,menu create,add menus,new menus',
        'admin_menu.index' => '選項列表,後台選項管理,管理選項,menus list,all menus,',
        'menus.create' => '創建選項,新選項,新增選項,加入選項,加選項,create menus,menu create,add menus,new menus',
        'menus.index' => '選項列表,後台選項管理,管理選項,menus list,all menus,',
        'scenes.navbar.index' => '前台選項欄位,前台選單欄位,場景選項欄位,背景選項欄位,scenes,navbar',
        'scenes.navbar.create' => '創建選項,新選項,新增選項,加入選項,加選項,create menus,menu create,add menus,new menus',
        'scenes.slider.index' => '前台滑動圖欄位,前台廣告圖欄位,場景滑動圖欄位,背景滑動圖欄位,scenes,navbar',
        'scenes.slider.create' => '創建滑動圖,新滑動圖,新增滑動圖,加入滑動圖,加滑動圖,create menus,menu create,add menus,new menus',
        'scenes.introduce.index' => '前台文字介紹欄位,前台文字內文欄位,場景文字介紹欄位,背景文字介紹欄位,scenes,navbar',
        'scenes.introduce.create' => '創建文字介紹,新文字介紹,新增文字介紹,加入文字介紹,加文字介紹,create menus,menu create,add menus,new menus',
        'scenes.image.index' => '前台圖片欄位,前台照片欄位,場景圖片欄位,背景圖片欄位,scenes,navbar',
        'scenes.image.create' => '創建圖片,新圖片,新增圖片,加入圖片,加圖片,create menus,menu create,add menus,new menus',
        'scenes.footer.index' => '前台腳板欄位,前台底塊欄位,場景腳板欄位,背景腳板欄位,scenes,navbar',
        'scenes.footer.create' => '創建腳板,新腳板,新增腳板,加入腳板,加腳板,create menus,menu create,add menus,new menus',
        'setting.search_keywords.index' => '前台搜尋關鍵字欄位,前台搜尋關鍵詞欄位,場景搜尋關鍵字欄位,背景搜尋關鍵字欄位,scenes,navbar',
        'setting.search_keywords.create' => '創建搜尋關鍵字,新搜尋關鍵字,新增搜尋關鍵字,加入搜尋關鍵字,加搜尋關鍵字,create menus,menu create,add menus,new menus',
        'setting.parameters.index' => '前台系統參數欄位,前台選單欄位,場景系統參數欄位,背景系統參數欄位,scenes,navbar',
        'setting.parameters.create' => '創建系統參數,新系統參數,新增系統參數,加入系統參數,加系統參數,create menus,menu create,add menus,new menus',
        'setting.parameters.global_keyword.index' => '前台搜尋字詞欄位,前台選單欄位,場景搜尋字詞欄位,背景搜尋字詞欄位,scenes,navbar',
        'setting.parameters.global_keyword.create' => '創建搜尋字詞,新搜尋字詞,新增搜尋字詞,加入搜尋字詞,加搜尋字詞,create menus,menu create,add menus,new menus',
        'news.index' => '前台最新消息欄位,前台最新新聞欄位,場景最新消息欄位,背景最新消息欄位,scenes,navbar',
        'news.create' => '創建最新消息,新最新消息,新增最新消息,加入最新消息,加最新消息,create menus,menu create,add menus,new menus',
    ],
];
