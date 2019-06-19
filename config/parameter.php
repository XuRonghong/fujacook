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
];
