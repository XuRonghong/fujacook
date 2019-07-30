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
Route::post('doSendVerification', $controller.'@doSendVerification' )->name('password.email');
Route::get( 'resetpassword'     , $controller.'@resetPasswordView' )->name('password.verification');
Route::post('doResetPassword'   , $controller.'@doResetPassword' )->name('password.reset');
//
//Route::post('doRegister'        , 'RegisterController@doRegister' );//
//Route::get( 'doActive/{usercode}', 'RegisterController@doActive' );//


Route::get('/home', 'HomeController@index')->name('home');
//
Route::group(
    [
        'middleware' => [
            'assign.guard:admin,admin/login',
            'CheckAdmin:admin',
//            'admin/login',
//            'LoginThrottle:5,10',
            'CheckLang',
        ]
    ], function(){

    Route::get('/', 'IndexController@index');
    Route::get('/setlang', 'IndexController@setLang')->name('setlang');


    /**********************************************************
     * Upload Images
     *********************************************************/
    Route::post('upload_file', 'UploadController@doUploadFile' );
    Route::post('upload_image', 'UploadController@doUploadImage' );
    Route::post('upload_image_base64', 'UploadController@doUploadImageBase64' );


    /**********************************************************
     * Excel 2019
     *********************************************************/
    Route::get( '/export_excel', 'ExportController@index');
    Route::get( '/export_excel/excel', 'ExportController@excel')->name('export_excel.excel');
    Route::post('/import_excel/import', 'ExportController@import')->name('import_excel.import');


    /**********************************************************
     * PDF function
     *********************************************************/
    Route::get('/dynamic_pdf/pdf', 'ExportController@pdf');


    Route::group(
        [
            'middleware' => [
                'admin.checkPermission',       //權限通過
            ],
        ], function(){

    /**********************************************************
     *
     * 帳號管理
     *
     *********************************************************/
        //管理員帳號
        $index = array('url'=>'admins', 'C'=>'AdminController', 'name'=>'admins');
        Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
        Route::resource($index['url'], $index['C']);
        Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
        Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');
        //一般會員管理
        $index = array('url'=>'members', 'C'=>'MemberController', 'name'=>'members');
        Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
        Route::resource($index['url'], $index['C']);
        Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
        Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');


    /**********************************************************
     *
     * 群組管理 (not completed..)
     *
     *********************************************************/
        Route::group(
            [
                'name' => 'group.', 'prefix' => 'group', 'namespace' => 'Group'
            ],
            function() {
            //一般會員管理
            $index = array('url'=>'member', 'C'=>'gMemberController', 'name'=>'group.member');
            Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'group', 'name'=> $index['name'] ]);
            Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
            Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');
            //店家會員管理
            $index = array('url'=>'store', 'C'=>'gStoreController', 'name'=>'group.store');
            Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'group', 'name'=> $index['name'] ]);
            Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
            Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');
            //供應商會員管理
            $index = array('url'=>'supplier', 'C'=>'gSupplierController', 'name'=>'group.supplier');
            Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'group', 'name'=> $index['name'] ]);
            Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
            Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');
            //管理員帳號
            $index = array('url'=>'admin', 'C'=>'gAdminController', 'name'=>'group.admin');
            Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'group', 'name'=> $index['name'] ]);
            Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
            Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');
        });


    /**********************************************************
     *
     * 系統類別設置 (not completed..)
     *
     *********************************************************/
        Route::group(['prefix' => 'category', 'namespace' => 'Category'], function() {
            //
            $index = array('url'=>'', 'C'=>'CategoryController', 'name'=>'category');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'Category', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });


    /**********************************************************
     *
     * log 管理
     *
     *********************************************************/
        Route::group(['prefix' => 'log', 'namespace' => 'Log'], function() {
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
     * 商店店家
     *
     *********************************************************/
        Route::group(['prefix' => 'store', 'namespace' => 'Store' ], function() {
            //商家管理
            $index = array('url'=>'home', 'C'=>'StoreController', 'name'=>'store');
            Route::get(     $index['url'].'/list'        , $index['C'].'@list')->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'store', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}' , $index['C'].'@update')->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');
            //商家資料
            $index = array('url'=>'attr', 'C'=>'AttrController', 'name'=>'store.attr');
            Route::get(     $index['url'].'/list'        , $index['C'].'@list')->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'store', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}' , $index['C'].'@update')->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');
            //支付設定...

        });


    /**********************************************************
     *
     * 供應商會員管理
     *
     *********************************************************/
        Route::group(
            [
                'name' => 'supplier.', 'prefix' => 'supplier', 'namespace' => 'Supplier'
            ],
            function() {
                //
        });



    /**********************************************************
     *
     * Articles管理
     *
     *********************************************************/
        Route::group(
            [
                'name' => 'articles.', 'prefix' => 'articles', 'namespace' => 'Articles'
            ],
            function() {
            //
            $index = array('url'=>'post', 'C'=>'ArticleController', 'name'=>'post');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C']);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });



    /**********************************************************
     *
     * 信息管理
     *
     *********************************************************/
        Route::group(
            [
                'name' => 'information.',
                'prefix' => 'information',
                'namespace' => 'Information',
            ], function() {

            // 公告
            $index = array('url'=>'announce', 'C'=>'AnnounceController', 'name'=>'information.announce');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'information', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            // 最新消息
            $index = array('url'=>'news', 'C'=>'NewsController', 'name'=>'information.news');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'information', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            // 訊息
            $index = array('url'=>'messages', 'C'=>'MessageController', 'name'=>'information.messages');
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

            // notifications (not completed..)
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
        Route::group(
            [
                'name' => 'product.',
                'prefix' => 'product',
                'namespace' => 'Product',
            ], function() {
            // 商品類別設置
            $index = array('url'=>'category', 'C'=>'pCategoryController', 'name'=>'product.category');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'product', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // 商品管理
            $index = array('url'=>'manage', 'C'=>'ProductController', 'name'=>'product.manage');
            Route::delete(  $index['url'].'/mass_destroy',$index['C'].'@massDestroy')->name($index['name'].'.mass_destroy');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'product', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // 商品規格
            $index = array('url'=>'spec', 'C'=>'SpecController', 'name'=>'product.spec');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'product', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // 組合商品
            $index = array('url'=>'combinations', 'C'=>'CombinationController', 'name'=>'product.combinations');
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
     * 訂單管理
     *
     *********************************************************/
        Route::group(
            [
                'name' => 'order.',
                'prefix' => 'order',
                'namespace' => 'Order',
            ], function() {
            // 商品訂單
            $index = array('url'=>'product', 'C'=>'OrderController', 'name'=>'order.product');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'order', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // 商品訂單詳情
            $index = array('url'=>'detail', 'C'=>'OrderDetailController', 'name'=>'order.detail');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'order', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // 商品訂單寄送地址
            $index = array('url'=>'contact', 'C'=>'OrderContactController', 'name'=>'order.contact');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'order', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });



    /**********************************************************
     *
     * 廣告管理
     *
     *********************************************************/
        Route::group(
            [
                'name' => 'advertising.',
                'prefix' => 'advertising',
                'namespace' => 'Advertising',
            ], function() {
            // 平台推薦商品管理
            $index = array('url'=>'recommend', 'C'=>'RecommendController', 'name'=>'advertising.recommend');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'advertising', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // 促銷活動
            $index = array('url'=>'promotions', 'C'=>'PromotionsController', 'name'=>'advertising.promotions');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'advertising', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // 廣告類別設置
            $index = array('url'=>'category', 'C'=>'adCategoryController', 'name'=>'advertising.category');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'advertising', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // 廣告管理
            $index = array('url'=>'manage', 'C'=>'AdController', 'name'=>'advertising.manage');
            Route::delete(  $index['url'].'/mass_destroy',$index['C'].'@massDestroy')->name($index['name'].'.mass_destroy');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'advertising', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });



    /**********************************************************
     *
     * 前台-場面介面管理
     *
     *********************************************************/
        Route::group(
            [
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
     * 活動管理
     *
     *********************************************************/
        Route::group(
            [
                'name' => 'activity.',
                'prefix' => 'activity',
                'namespace' => 'Activity',
            ], function() {

            // 優惠券
            $index = array('url'=>'coupon', 'C'=>'CouponController', 'name'=>'activity.coupon');
            Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'activity', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            // 點數
            $index = array('url'=>'coin', 'C'=>'CoinController', 'name'=>'activity.coin');
            Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'activity', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            // 活動訊息
            $index = array('url'=>'news', 'C'=>'aNewsController', 'name'=>'activity.news');
            Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'activity', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            // 活動報名
            $index = array('url'=>'sign_up', 'C'=>'SignupController', 'name'=>'activity.sign_up');
            Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'activity', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');

            // 活動檔期
            $index = array('url'=>'schedule', 'C'=>'ScheduleController', 'name'=>'activity.schedule');
            Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'activity', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });



    /**********************************************************
     *
     * 客服專區
     *
     *********************************************************/
        Route::group(
            [
                'name' => 'service.',
                'prefix' => 'service',
                'namespace' => 'Service',
            ], function() {
            // 連繫我們
            $index = array('url'=>'contactus', 'C'=>'ContactusController', 'name'=>'service.contactus');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'service', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
            // 留言專區
            $index = array('url'=>'message', 'C'=>'sMessageController', 'name'=>'service.message');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'service', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
        });



    /**********************************************************
     *
     * 系統設置
     *
     *********************************************************/
        Route::group(
            [
                'name' => 'setting.',
                'prefix' => 'setting',
                'namespace' => 'Setting',
            ], function() {
            //關鍵字管理
            $index = array('url'=>'search_keywords', 'C'=>'KeywordController', 'name'=>'setting.search_keywords');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
            Route::resource($index['url'], $index['C'], ['as'=> 'setting', 'name'=> $index['name'] ]);
            Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
            Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');
                //關鍵字記錄
                Route::get( $index['url'].'/log',   $index['C'].'@log'  )->name($index['name'].'.log');

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

            //匯率管理 (not completed..)
            Route::group(
                [
                    'name' => 'exchange_rate.', 'prefix' => 'exchange_rate'
                ],
                function() {
                    //匯率設定
                    $index = array('url'=>'set', 'C'=>'ExchangeRateController', 'name'=>'setting.exchange_rate.set');
                    Route::get( $index['url'].'/list',   $index['C'].'@list'  )->name($index['name'].'.list');
                    Route::get( $index['url'],           $index['C'].'@index' )->name($index['name'].'.index');
                    Route::get( $index['url'].'/create', $index['C'].'@create')->name($index['name'].'.create');
                    Route::post($index['url'],           $index['C'].'@store' )->name($index['name'].'.store');
                    Route::get( $index['url'].'/{id}',   $index['C'].'@show'  )->name($index['name'].'.show');
                    Route::get( $index['url'].'/{id}'.'/edit', $index['C'].'@edit'   )->name($index['name'].'.edit');
                    Route::post($index['url'].'/update/{id}',  $index['C'].'@update' )->name($index['name'].'.update');
                    Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');
                    //歷史匯率
                    $index = array('url'=>'log', 'C'=>'ExchangeRateController', 'name'=>'setting.exchange_rate.log');
                    Route::get( $index['url'].'/log',   $index['C'].'@log'  )->name($index['name']);
                });
        });


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


Route::resource('product', 'ProductController');

Route::get('member', 'MemberController@index')->name('member.index');
*/

