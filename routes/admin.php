<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


//Route::get('/', 'HomeController@index')->middleware('auth:admin')->name('admin.home');

Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.index');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// 密碼重置連結的路由...
//Route::get('password/email', 'Auth\ForgotPasswordController@getEmail')->name('password.forgot');
//Route::post('password/email', 'Auth\ForgotPasswordController@postEmail')->name('password.email');
// 密碼重置的路由...
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@getReset');
//Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');
//
$controller = 'LoginController';
//Route::get( 'forgotpassword' , $controller . '@forgotPasswordView' )->name('password.forgot');
Route::post( 'doSendVerification' , $controller . '@doSendVerification' )->name('password.email');
Route::get( 'resetpassword' , $controller . '@resetPasswordView' )->name('password.verification');
Route::post( 'doResetPassword' , $controller . '@doResetPassword' )->name('password.reset');
//
//Route::post('doRegister'        , 'RegisterController@doRegister' );//
//Route::get( 'doActive/{usercode}', 'RegisterController@doActive' );//


Route::get('/home', 'HomeController@index')->name('home');
//
Route::group([
        'middleware' => [
            'assign.guard:admin,admin/login',
            'CheckAdmin:admin',
//            'admin/login',
//            'LoginThrottle:5,10',
        ]
    ],function(){

    Route::get('/', 'IndexController@index');

    /**********************************************************
     * Upload Images
     *********************************************************/
    Route::post( 'upload_image', 'UploadController@doUploadImage' );
    Route::post( 'upload_image_base64', 'UploadController@doUploadImageBase64' );
    Route::post( 'upload_file', 'UploadController@doUploadFile' );


    /**********************************************************
     * Excel
     *********************************************************/
//    Route::get( 'import_excel', 'ExcelController@index')->name('excel_index');
//    Route::post('import_excel', 'ExcelController@import')->name('import');
    /**********************************************************
     * Excel 2019
     *********************************************************/
    Route::get('/export_excel', 'ExportController@index');
    Route::get('/export_excel/excel', 'ExportController@excel')->name('export_excel.excel');
    Route::post('/import_excel/import', 'ExportController@import')->name('import_excel.import');


    /**********************************************************
     * PDF function
     *********************************************************/
    Route::get('/dynamic_pdf/pdf', 'ExportController@pdf');



    Route::group([
        'middleware' => ['admin.checkPermission']       //權限通過
    ],function(){

    /**********************************************************
     *
     * 帳號管理
     *
     *********************************************************/
        $index = array('url'=>'admins', 'C'=>'AdminController', 'name'=>'admins');
        Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
        Route::resource($index['url'], $index['C']);
        Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
        Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');



    /**********************************************************
     *
     * 系統參數設定-權限設定
     *
     *********************************************************/
        $index = array('url'=>'permissions', 'C'=>'PermissionController', 'name'=>'permissions');
        Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
        Route::resource($index['url'], $index['C']);
        Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
        Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        /******* 管理者權限 ********/
        $index = array('url'=>'permission/admin_permission', 'C'=>'AdminPermissionController', 'name'=>'admin_permission');
        Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
        Route::get( $index['url'],           $index['C'].'@index' )->name($index['name'].'.index');
        Route::get( $index['url'].'/create', $index['C'].'@create')->name($index['name'].'.create');
        Route::post($index['url'],           $index['C'].'@store' )->name($index['name'].'.store');
        Route::get( $index['url'].'/{id}',   $index['C'].'@show'  )->name($index['name'].'.show');
        Route::get( $index['url'].'/{id}'.'/edit', $index['C'].'@edit'   )->name($index['name'].'.edit');
        Route::post($index['url'].'/update/{id}',  $index['C'].'@update' )->name($index['name'].'.update');
        Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');



    /**********************************************************
     *
     * 系統參數設定-選單Menu管理
     *
     *********************************************************/
        $index = array('url'=>'menus', 'C'=>'MenuController', 'name'=>'menus');
        Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
        Route::resource($index['url'], $index['C']);
        Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
        Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        /******* 管理者選項Menu ********/
        $index = array('url'=>'menu/admin_menu', 'C'=>'AdminMenuController', 'name'=>'admin_menu');
        Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
        Route::get( $index['url'],           $index['C'].'@index' )->name($index['name'].'.index');
        Route::get( $index['url'].'/create', $index['C'].'@create')->name($index['name'].'.create');
        Route::post($index['url'],           $index['C'].'@store' )->name($index['name'].'.store');
        Route::get( $index['url'].'/{id}',   $index['C'].'@show'  )->name($index['name'].'.show');
        Route::get( $index['url'].'/{id}'.'/edit', $index['C'].'@edit'   )->name($index['name'].'.edit');
        Route::post($index['url'].'/update/{id}',  $index['C'].'@update' )->name($index['name'].'.update');
        Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');



    /**********************************************************
     *
     * log 管理
     *
     *********************************************************/
        Route::group(['prefix' => 'log', 'namespace' => 'log'], function() {
            //
            $index = array('url'=>'login', 'C'=>'LogLoginController', 'name'=>'log.login');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'log', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            //
            $index = array('url'=>'action', 'C'=>'LogActionController', 'name'=>'log.action');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'log', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });


    /**********************************************************
     *
     * 前台-場面介面管理
     *
     *********************************************************/
        Route::group([
            'name' => 'scenes.',
            'prefix' => 'scenes',
            'namespace' => 'Scenes',
        ], function() {
            //
            $index = array('url'=>'navbar', 'C'=>'NavbarController', 'name'=>'scenes.navbar');
            Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'scenes', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            //
            $index = array('url'=>'slider', 'C'=>'SliderController', 'name'=>'scenes.slider');
            Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'scenes', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            //
            $index = array('url'=>'introduce', 'C'=>'IntroduceController', 'name'=>'scenes.introduce');
            Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'scenes', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            //
            $index = array('url'=>'image', 'C'=>'ImageController', 'name'=>'scenes.image');
            Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'scenes', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            //
            $index = array('url'=>'footer', 'C'=>'FooterController', 'name'=>'scenes.footer');
            Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'scenes', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });



    /**********************************************************
     *
     * 系統設置
     *
     *********************************************************/
        Route::group([
            'name' => 'setting.',
            'prefix' => 'setting',
            'namespace' => 'Setting',
        ], function() {
            //搜尋關鍵字
            $index = array('url'=>'search_keywords', 'C'=>'KeywordController', 'name'=>'setting.search_keywords');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'setting', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            //系統參數 meta
            $index = array('url'=>'parameters', 'C'=>'ParameterController', 'name'=>'setting.parameters');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'setting', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
                //global keyword
                $index = array('url'=>'parameter/global_keyword', 'C'=>'GlobalKeywordController', 'name'=>'setting.parameter.global_keyword');
                Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
                Route::get( $index['url'],           $index['C'].'@index' )->name($index['name'].'.index');
                Route::get( $index['url'].'/create', $index['C'].'@create')->name($index['name'].'.create');
                Route::post($index['url'],           $index['C'].'@store' )->name($index['name'].'.store');
                Route::get( $index['url'].'/{id}',   $index['C'].'@show'  )->name($index['name'].'.show');
                Route::get( $index['url'].'/{id}'.'/edit', $index['C'].'@edit'   )->name($index['name'].'.edit');
                Route::post($index['url'].'/update/{id}',  $index['C'].'@update' )->name($index['name'].'.update');
                Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');
        });



    /**********************************************************
     *
     * 信息管理
     *
     *********************************************************/
        Route::group([
            'name' => 'information.',
            'prefix' => 'information',
            'namespace' => 'Information',
        ], function() {

            // 最新消息
            $index = array('url'=>'news', 'C'=>'NewsController', 'name'=>'information.news');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'information', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            // 媒體報導
            $index = array('url'=>'reports', 'C'=>'ReportController', 'name'=>'information.reports');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'information', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            // notifications
            $index = array('url'=>'notifications', 'C'=>'NotificationController', 'name'=>'information.notifications');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'information', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });




    /**********************************************************
     *
     * 產品管理
     *
     *********************************************************/
        Route::group([
            'name' => 'product.',
            'prefix' => 'product',
            'namespace' => 'Product',
        ], function() {
                // 商品類別設置
            $index = array('url'=>'category', 'C'=>'CategoryController', 'name'=>'product.category');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'product', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // 商品管理
            $index = array('url'=>'manage', 'C'=>'ManageController', 'name'=>'product.manage');
            Route::delete(  $index['url'].'/mass_destroy',$index['C'].'@massDestroy')->name($index['name'].'.mass_destroy');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'product', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // 運費管理
            $index = array('url'=>'shipping', 'C'=>'ShippingController', 'name'=>'product.shipping');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'product', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            //付款方式
            $index = array('url'=>'pay', 'C'=>'PayController', 'name'=>'product.pay');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'product', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            //商品修改記錄
            $index = array('url'=>'log', 'C'=>'LogController', 'name'=>'product.log');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'product', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });




        /**********************************************************
         *
         * Order 管理
         *
         *********************************************************/
        Route::group([
            'name' => 'order.',
            'prefix' => 'order',
            'namespace' => 'Order',
        ], function() {
            // 商品類別設置
            $index = array('url'=>'category', 'C'=>'CategoryController', 'name'=>'order.category');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'order', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // order管理
            $index = array('url'=>'manage', 'C'=>'ManageController', 'name'=>'order.manage');
            Route::delete(  $index['url'].'/mass_destroy',$index['C'].'@massDestroy')->name($index['name'].'.mass_destroy');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'order', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            //付款方式
            $index = array('url'=>'pay', 'C'=>'PayController', 'name'=>'order.pay');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'order', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            //商品修改記錄
            $index = array('url'=>'log', 'C'=>'LogController', 'name'=>'order.log');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'order', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });



    /**********************************************************
     *
     * 客服專區
     *
     *********************************************************/
        // 連繫我們
        Route::group([
            'name' => 'service.',
            'prefix' => 'service',
            'namespace' => 'Service',
        ], function() {
            //
            $index = array('url'=>'contactus', 'C'=>'ContactusController', 'name'=>'service.contactus');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'service', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });




        /******* member管理 ********/
//        Route::group([
////                'prefix' => 'members',
////                'namespace' => 'Member',
//                'middleware' => 'CheckAuthLogin'
//            ], function() {
//            //
//            $index = array('url'=>'members', 'C'=>'MemberController', 'name'=>'members');
//            Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
//            Route::resource($index['url'], $index['C']);
//            Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
//            Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');
//            Route::post('dosaveshow', $index['C'].'@doSaveShow' );
//            Route::post('dosavepassword', $index['C'].'@doSavePassword' );
//
//            Route::group([
//                    'prefix' => $index['url'].'/info',
//                ], function() {
//                //
//                Route::get( '', 'InfoController@index' );
//                Route::any( 'getlist', 'InfoController@getList' );
//                Route::get( 'edit/{id}', 'InfoController@edit' );
//                Route::post( 'dosave', 'InfoController@doSave' );
//            });
//        });

        /******* 商店店家 ********/
        $index = array('url'=>'store', 'C'=>'StoreController', 'name'=>'store');
        Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
        Route::resource($index['url'], $index['C']);
        Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
        Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');

        /******* 群組管理 ********/
        $index = array('url'=>'group', 'C'=>'GroupController', 'name'=>'group');
        Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
        Route::resource($index['url'], $index['C']);
        Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
        Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');

        /******* Coupon管理 ********/
        $index = array('url'=>'coupons', 'C'=>'CouponController', 'name'=>'coupons');
        Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
        Route::resource($index['url'], $index['C']);
        Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
        Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');

        /******* Articles管理 ********/
        $index = array('url'=>'articles', 'C'=>'ArticleController', 'name'=>'articles');
        Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
        Route::resource($index['url'], $index['C']);
        Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
        Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

        /******* Advertise管理 ********/
        $index = array('url'=>'advertise', 'C'=>'AdvertiseController', 'name'=>'advertise');
        Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
        Route::resource($index['url'], $index['C']);
        Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
        Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
    });

});

/*

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');
//
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::resource('product', 'ManageController');

Route::get('member', 'MemberController@index')->name('member.index');
*/

