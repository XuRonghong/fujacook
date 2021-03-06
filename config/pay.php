<?php
return [
    'ATM_ExpireDate' => 0,
    'return_url' => env( 'PAY_ReturnUrl' ),
    'customer_url' => env( 'PAY_CustomerUrl' ),
    'pay_host' => env( 'PAY_HOST' ),
    'pay_service' => [ 'Spgateway' ],
    'payment_type' => [ 'CREDIT', 'WEBATM' ],
    'pay2go' =>
        [
            'MerchantID' => env( 'PAY2GO_MerchantID' ),
            'HashKey' => env( 'PAY2GO_HashKey' ),
            'HashIV' => env( 'PAY2GO_HashIV' ),
            'MPG_API' => env( 'PAY2GO_MPG_API' ),
            'Version' => env( 'PAY2GO_Version' ),
            'RespondType' => env( 'PAY2GO_RespondType' ),
            'INVOICE' => env( 'PAY2GO_INVOICE' ),
        ],
    'spgateway' =>
        [
            'MerchantID' => env( 'SPGATEWAY_MerchantID' ),
            'HashKey' => env( 'SPGATEWAY_HashKey' ),
            'HashIV' => env( 'SPGATEWAY_HashIV' ),
            'MerchantID_DF' => env( 'SPGATEWAY_MerchantID_DF' ),
            'HashKey_DF' => env( 'SPGATEWAY_HashKey_DF' ),
            'HashIV_DF' => env( 'SPGATEWAY_HashIV_DF' ),

            'MPG_API' => env( 'SPGATEWAY_MPG_API' ),
            'Version' => env( 'SPGATEWAY_Version' ),
            'RespondType' => env( 'SPGATEWAY_RespondType' ),
            'INVOICE' => env( 'SPGATEWAY_INVOICE' ),
            'API_CREDITCARD_CANCEL' => env( 'SPGATEWAY_API_CREDITCARD_CANCEL' ), //取消授權
            'API_CREDITCARD_CLOSE' => env( 'SPGATEWAY_API_CREDITCARD_CLOSE' ), //請款 退款,
        ],
    'newebpay' =>
        [
            'userid' => env( 'NEWEBPAY_USERID' ),
            'passwd' => env( 'NEWEBPAY_PASSWD' ),
            'MerchantNumber' => env( 'NEWEBPAY_MERCHANTNUMBER' ),
            'Code' => env( 'NEWEBPAY_CODE' ),
        ],
    'PTW_MerchantID' => env( 'PTW_MerchantID' ),
    'PTW_HashKey' => env( 'PTW_HashKey' ),
    'PTW_HashIV' => env( 'PTW_HashIV' ),
    'PTW_Version' => env( 'PTW_Version' ),
    'PTW_RespondType' => env( 'PTW_RespondType' ),
    "PTW_Params" => [
        'CODE' => 'PTW',
        'CREDIT' => 1,
        'CREDIT_FEE' => 0.03,
        'CREDIT3' => 1,
        'CREDIT3_FEE' => 0.0325,
        'CREDIT6' => 1,
        'CREDIT6_FEE' => 0.0425,
        'CREDIT12' => 1,
        'CREDIT12_FEE' => 0.075,
        'CREDIT24' => 0,
        'CREDIT24_FEE' => 0,
        'CREDIT30' => 0,
        'CREDIT30_FEE' => 0,
        'WEBATM' => 1,
        'WEBATM_FEE' => 0.012,
        'VACC' => 1,
        'VACC_FEE' => 0.012,
        'CVS' => 1,
        'CVS_FEE' => 30,
        'BARCODE' => 1,
        'BARCODE_FEE' => 30,
        'UnionPay' => 0,
        'UnionPay_FEE' => 0,
        'ForeignCard' => 0,
        'ForeignCard_FEE' => 0
    ]
];
