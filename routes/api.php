<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['force-json', 'auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});



//Route::group(
//    [
//        'namespace' => '_API',
//    ], function() {
//
//
//    /*************************************
//     * 做其他的撈資料(前端建翰)
//     *************************************/
//    Route::any('getdata', '_APIController@getModData');
////        Route::post('putdata', '_APIController@addModData');
////        Route::put('editdata/{id}', '_APIController@editModData');
////        Route::delete('deldata/{id}', '_APIController@delModData');
//    //
////        Route::get('device_token', '_APIController@getDeviceToken');
////        Route::post('puttoken', '_APIController@addDeviceToken');
////        Route::put('edittoken/{id}', '_APIController@editDeviceToken');
////        Route::delete('deltoken/{id}', '_APIController@delDeviceToken');
//
//
//    /*************************************
//     * 登入與註冊
//     *************************************/
//    Route::group(
//        [
//            'prefix' => 'auth',
//        ], function (){
//
//        $controller = 'LoginController';
//
//        Route::get( '' , $controller . '@indexView')->name('index') ;
//        //            Route::get( 'register', $controller . '@index' );
//        Route::post('doRegister', $controller . '@doRegister' );
//        Route::get( 'doActive/{usercode}', $controller . '@doActive' );
//        Route::get( 'login' , $controller . '@indexView') ;
//        Route::group(
//            [
////                        'middleware'=> ['LoginThrottle:5,10']
//            ], function() use ($controller){
//            Route::post('doLogin' , $controller . '@doLogin' );
//            Route::post('doLoginMobile' , $controller . '@doLoginMobile' );
//        });
////                Route::get(  'forgotpassword' , $controller . '@forgotpassword' );
//        Route::post( 'doSendVerification' , $controller . '@doSendVerification' );
//        Route::post( 'doResetPassword' , $controller . '@doResetPassword' );
//        Route::get(  'logout' , $controller . '@logoutView' );
//        Route::post( 'dologout' , $controller . '@doLogout' );
//        //設定語系
////                Route::post( 'doSetLocale/{locale}', 'LocaleController@doSetLocale' );
//
//        //登入後
//        Route::post( 'getMemberInfo' , $controller . '@getMemberInformation' );
//        Route::post( 'doSavePassword' , $controller . '@doSavePassword' );
//        Route::post( 'doSave' , $controller . '@doSave' );
//
//        //錢包排程
//        Route::get( 'get_member_wallet' , $controller . '@getMemberWallet' );
//        Route::get(  'get_revenue_daily' , $controller . '@getRevenueDaily' );
//        Route::post( 'set_revenue_daily' , $controller . '@setRevenueDaily' );
//
//        //錢包綁定
//        Route::post( 'addrConfirm' , $controller . '@inSysMemberWallet' );
//    });
//
//
//    /*************************************
//     * 訂單與智能合約
//     *************************************/
//    Route::group(
//        [
//            'prefix' => 'order',
//        ], function() {
//
//        $controller = 'OrderController';
//
//        //get order list of member
//        Route::any( 'getlist' , $controller . '@getList' );
//        //find order information
//        Route::get( 'find' , $controller . '@find' );
//
//        // A.ETH
//        Route::post('buy_eth' , $controller . '@buyEth' );
//        Route::post('doadd2' , $controller . '@doAdd2' );
//        // A.餘額購買
//        Route::post('buy_vault' , $controller . '@buyVault' );
//        // A.BUY_ADDRESS
//        Route::any( 'buy_address' , $controller . '@buyAddress' );
//        Route::any( 'buy_address2' , $controller . '@buyAddress2' );    //無入用，移到_web去實現
//        Route::any( 'buy_ecpay' , $controller . '@buyECPay' );
//        Route::any( 'buy_ecpay_feedback' , $controller . '@buyECPayFeedback' );
//        Route::any( 'buy_ecpay_receive' , $controller . '@buyECPayReceive' );
//
//        // A.帳戶提領
//        Route::post('withdraw' , $controller . '@withdraw' );
//
//        // B.查詢智能合約-GET ETH BALANCE
//        Route::post('get_eth' , $controller . '@getEth' );
//        // B.查詢智能合約-GET TOKEN
//        Route::post('get_token' , $controller . '@getToken' );
//
//        // C.定時更新智能合約
//        Route::post('update_txhash' , $controller . '@updateTxhash' );


        /*************************************
         * 無入用，測試用
         *************************************/
//        Route::get( 'edit/{id}' , $controller . '@edit' );
//        Route::post('dosave' , $controller . '@doSave' );
//    } );



    /*************************************
     * 無入用，測試用
     *************************************/
//    Route::group(
//        [
//            'prefix' => 'category',
//            'namespace' => 'Category',
//        ], function() {
//        Route::get( 'getlist', 'IndexController@getList' );
//    } );
//    Route::group(
//        [
//            'prefix' => 'product',
//            'namespace' => 'Product',
//        ], function() {
//        Route::get( 'dosearch', 'IndexController@doSearch' );
//        Route::get( 'getlist', 'IndexController@getList' );
//    } );
//    //
//    Route::group(
//        [
//            'prefix' => 'news',
//        ], function() {
//        Route::get( 'getlist', 'NewsController@getList' );
//    } );
//    //
//    Route::group(
//        [
//            'prefix' => 'search',
//        ], function() {
//        Route::get( 'getlist', 'SearchController@getList' );
//    } );
//});


/*******************
 * Test Api Route
 *******************/
Route::group(['middleware' => ['auth.api:member']], function () {
    //會員系統
    Route::get('member', 'MemberController@index')->name('member.index');//會員資訊
    Route::get('member/info', 'MemberController@show')->name('member.show');//會員資料詳細
    Route::put('member/info', 'MemberController@update')->name('member.update');//會員資料更新
    Route::put('member/setPassword', 'MemberController@setPassword')->name('member.setPassword');//修改密碼
    Route::get('member/orders', 'OrderController@index')->name('orders.index');//會員訂單記錄
    Route::get('member/orders/{orderId}', 'OrderController@show')->name('orders.show');//訂單詳細
    Route::put('member/orders', 'OrderController@updateBankLastNo')->name('orders.updateBankLastNo');//訂單更新（匯款帳號後五碼）
    Route::post('member/upload', 'MemberController@upload')->name('member.upload');//上傳圖片
    //會員常用資訊
    Route::apiResource('member/contacts', 'ContactController')->only(['index', 'update', 'store', 'destroy']);
    Route::apiResource('member/bonus', 'BonusController')->only(['index', 'show']);
    //會員通知
    Route::get('member/notify', 'MemberNotificationController@index')->name('member.notification');
    Route::put('member/notify/{id}', 'MemberNotificationController@isRead')->name('member.isRead');
    Route::get('member/notifyUnreadCount', 'MemberNotificationController@getUnreadCount')->name('member.UnreadCount');

    //購物車
    Route::get('cart/getBonus', 'BonusController@getBonus')->name('member.getBonus');// 會員點數

    //Route::post('member/resetPassword', 'Auth\ResetPasswordController@resetPassword')->name('member.resetPassword');
});

//頻道
Route::get('category/parent', 'CategoryController@getProductParentCategories')->name('category.parent');

//Meta設定
Route::get('parameter/meta', 'ParameterController@getFrontendMetas')->name('parameter.meta');

//首頁選單
Route::get('layout/menu', 'CategoryController@getValidParentCategories')->name('layout.menu');

//首頁頻道商品
Route::get('index/categories_product_combinations', 'CategoryController@getIndexParentCategories')
    ->name('index.categories_product_combinations');

//會員系統
Route::post('member/register', 'Auth\RegisterController@register')->name('member.register');//會員註冊.
Route::post('login', 'Auth\LoginController@login')->name('login');//會員登入.
Route::post('facebook/login', 'Auth\FacebookLoginController@login')->name('facebook.login');//會員登入.

//熱搜關鍵字
Route::get('search', 'SearchKeywordController@search')->name('search-keyword.search');
Route::get('search-keyword', 'SearchKeywordController@index')->name('search-keyword.index');

//文章
Route::get('article/{parent_category}', 'ArticleController@parentIndex')->name('article.parentIndex');//文章大分類
Route::get('article/{parent_category}/{category}', 'ArticleController@childIndex')->name('article.childIndex');//文章小分類
Route::get('article/{parent_category}/{category}/{id}', 'ArticleController@show')->name('article.show');//文章內頁

//輪播
Route::get('banners', 'BannerController@getBanners')->name('banners.getBanners');

//組合商品
Route::get('product_combinations/popular', 'ProductCombinationController@popular')->name('product_combinations.popular');
Route::get('product_combinations/hot_search', 'ProductCombinationController@hotSearch')->name('product_combinations.hot_search');
Route::get('product_combinations/additional_purchase', 'ProductCombinationController@additionalPurchase')->name('product_combinations.additional_purchase');

//限時商品
Route::get('product_combinations/feature', 'CategoryController@feature')->name('category.feature');

//前台商品頁
Route::get('product_combinations/product', 'ProductCombinationController@getProduct')->name('product_combinations.product');
Route::get('product_combinations/{id}', 'ProductCombinationController@show')->name('product_combinations.show');

//頻道頁
Route::get('getProductsByCategory', 'CategoryController@index')->name('category.index');
Route::get('getProductsLoadmore', 'CategoryController@getProductsLoadmore')->name('category.getPoduct');

//商品評價頁
Route::get('order_review/{token}', 'OrderReviewController@show')->name('order_review.show');

//商品評價
Route::post('product_combination_review', 'ProductCombinationReviewController@store')->name('product_combination_review.store');//新增商品評價

//系統參數
Route::get('parameters/{id}', 'ParameterController@show')->name('parameters.show');

//sitemap
Route::get('web/sitemap', 'SitemapController@index')->name('web.sitemap');

//前台忘記密碼重設
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.request');
// 優惠券
Route::get('cart/checkCoupon/{coupon_code}', 'CouponController@checkCoupon')->name('coupon.checkCoupon');// 優惠券

// 建立訂單
Route::post('orders', 'OrderController@store')->name('orders.store');
