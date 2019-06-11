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

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::group([
        'middleware' => 'assign.guard:admin,admin/login'
    ],function(){

    Route::get('/', 'HomeController@index')->name('admin');


    /******* 最新消息 ********/
    Route::get('news/list', 'NewsController@list')->name('news.list');
    Route::resource('news', 'NewsController');
    Route::post('news/update/{id}', 'NewsController@update')->name('news.update');
    Route::post('news/destroy/{id}', 'NewsController@destroy');


    /******* 商店店家 ********/
    Route::get('store/list', 'StoreController@list')->name('store.list');
    Route::resource('store', 'StoreController');
    Route::post('store/update', 'StoreController@update')->name('store.update');
    Route::post('store/destroy/{id}', 'StoreController@destroy');

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


