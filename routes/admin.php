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

//
Route::group([
        'middleware' => ['assign.guard:admin,admin/login'/*,'LoginThrottle:5,10'*/]
    ],function(){

    Route::get('/', 'IndexController@index');
    Route::get('/home', 'HomeController@index')->name('home');


    /**********************************************************
     * Upload Images
     *********************************************************/
    Route::post( 'upload_image', 'UploadController@doUploadImage' );
    Route::post( 'upload_image_base64', 'UploadController@doUploadImageBase64' );
    Route::post( 'upload_file', 'UploadController@doUploadFile' );


    /**********************************************************
     * Import Excel
     *********************************************************/
    Route::get( 'import_excel', 'ExcelController@index')->name('excel_index');
    Route::post('import_excel', 'ExcelController@import')->name('import');


    Route::group([
        'middleware' => ['admin.checkPermission']       //權限通過
    ],function(){



    /**********************************************************
     *
     * 帳號管理
     *
     *********************************************************/
        $index = array('url'=>'admins', 'C'=>'AdminsController', 'name'=>'admins');
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
     * 前台-場面介面管理
     *
     *********************************************************/
        Route::group([
            'name' => 'scenes.',
            'prefix' => 'scenes',
            'namespace' => 'Scenes',
        ], function() {
            //
            $index = array('url'=>'home', 'C'=>'HomeController', 'name'=>'scenes.home');
            Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
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
        });




    /**********************************************************
     *
     * 信息管理
     *
     *********************************************************/
        // 最新消息
        $index = array('url'=>'news', 'C'=>'NewsController', 'name'=>'news');
        Route::get(     $index['url'].'/list',        $index['C'].'@list'   )->name($index['name'].'.list');
        Route::resource($index['url'], $index['C']);
        Route::post(    $index['url'].'/update/{id}', $index['C'].'@update' )->name($index['name'].'.update');
        Route::post(    $index['url'].'/destroy/{id}',$index['C'].'@destroy')->name($index['name'].'.destroy');



        /******* member管理 ********/
        Route::group([
//                'prefix' => 'members',
//                'namespace' => 'Member',
                'middleware' => 'CheckAuthLogin'
            ], function() {
            //
            $index = array('url'=>'members', 'C'=>'MemberController', 'name'=>'members');
            Route::get($index['url'].'/list', $index['C'].'@list')->name($index['name'].'.list');
            Route::resource($index['url'], $index['C']);
            Route::post($index['url'].'/update/{id}', $index['C'].'@update')->name($index['name'].'.update');
            Route::post($index['url'].'/destroy/{id}', $index['C'].'@destroy')->name($index['name'].'.destroy');
            Route::post('dosaveshow', $index['C'].'@doSaveShow' );
            Route::post('dosavepassword', $index['C'].'@doSavePassword' );

            Route::group([
                    'prefix' => $index['url'].'/info',
                ], function() {
                //
                Route::get( '', 'InfoController@index' );
                Route::any( 'getlist', 'InfoController@getList' );
                Route::get( 'edit/{id}', 'InfoController@edit' );
                Route::post( 'dosave', 'InfoController@doSave' );
            });
        });

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


    });

});
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


Route::get('group', 'GroupController@index')->name('group.index');
Route::get('group/list', 'GroupController@list')->name('group.list');
Route::post('group', 'GroupController@store')->name('group.store');
Route::get('group/edit', 'GroupController@edit')->name('group.edit');
Route::delete('group/destroy', 'GroupController@destroy')->name('group.destroy');
Route::delete('group/mass_destroy', 'GroupController@massDestroy')->name('group.mass_destroy');



Route::get('/uploadfile', 'UploadfileController@index');
Route::post('/uploadfile', 'UploadfileController@upload');
Route::post('/uploadfile/action', 'UploadfileController@AjaxUpload')->name('ajaxupload.action');



Route::get('/dynamic_dependent', 'AjaxController@dynamicDependent');
Route::post('dynamic_dependent/fetch', 'AjaxController@dynamicDependentFetch')->name('dynamicdependent.fetch');
Route::post('autocomplete/fetch', 'AjaxController@AutoCompleteFetch')->name('autocomplete.fetch');



Route::get('/export_excel', 'ExportController@index');
Route::get('/export_excel/excel', 'ExportController@excel')->name('export_excel.excel');
Route::post('/import_excel/import', 'ExportController@import')->name('import_excel.import');

Route::get('/dynamic_pdf/pdf', 'ProductController@pdf');



Route::get('member', 'MemberController@index')->name('member.index');




Route::get('/livetable', 'LiveTable@index');
Route::get('/livetable/fetch_data', 'LiveTable@fetch_data')->name('livetable.fetch_data');
Route::post('/livetable/add_data', 'LiveTable@add_data')->name('livetable.add_data');
Route::post('/livetable/update_data', 'LiveTable@update_data')->name('livetable.update_data');
Route::post('/livetable/delete_data', 'LiveTable@delete_data')->name('livetable.delete_data');



Route::get('/loadmore', 'ArticleController@index');
Route::post('/loadmore/load_data', 'ArticleController@load_data')->name('loadmore.load_data');






Route::get('message', 'MessageController@index')->name('message.index');
Route::post('message/insert', 'MessageController@insert')->name('message.insert');


