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

Route::middleware('auth:api')->get('/user', function (Request $request) {
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
