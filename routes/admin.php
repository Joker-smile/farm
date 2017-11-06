<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

});

//后台路由
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('configs/banner', 'ConfigController@banner')->name('configs.banner');
    Route::post('configs/banner', 'ConfigController@storeBanner')->name('configs.store.banner');
    Route::get('configs/product', 'ConfigController@product')->name('configs.product');
    Route::post('configs/product', 'ConfigController@storeProduct')->name('configs.store.product');

    Route::resource('orders', 'OrderController');
    Route::resource('withdraws', 'WithdrawController');
    Route::resource('users', 'UserController');
    Route::resource('subscribes', 'SubscribeController');

    //订单
    Route::get('order/list', 'OrderController@index')->name('order.list');
    Route::post('order/update', 'OrderController@update')->name('order.update');
    Route::get('order/add', 'OrderController@add')->name('order.add');
    Route::post('order/store', 'OrderController@store')->name('order.store');
    Route::get('order/edit/{id}', 'OrderController@edit')->name('order.edit');
    Route::get('order/detail/{id}', 'OrderController@detail')->name('order.detail');
    Route::get('order/logistic/{id}', 'OrderController@logistic')->name('order.logistic');
    Route::post('order/logistic/update', 'OrderController@logisticUpdate')->name('order.logistic.update');
    Route::post('order/status', 'OrderController@status')->name('order.status');
    Route::get('order/search', 'OrderController@search')->name('order.search');
    Route::get('order/searchlist', 'OrderController@searchlist')->name('order.searchlist');

    //商品相关
    Route::get('product/list', 'ProductController@index')->name('product.list');
    Route::get('product/add', 'ProductController@create')->name('product.add');
    Route::post('product/store', 'ProductController@store')->name('product.store');
    Route::post('product/update', 'ProductController@update')->name('product.update');
    Route::get('product/edit/{id}', 'ProductController@edit')->name('product.edit');
    Route::get('product/delete/{id}', 'ProductController@delete')->name('product.delete');
    Route::post('product/status', 'ProductController@productStatus')->name('product.status');  //商品状态

    //用户信息
    Route::get('user/list', 'UserController@index')->name('user.list');
    Route::post('user/update', 'UserController@update')->name('user.update');
    Route::get('user/edit/{id}', 'UserController@edit')->name('user.edit');

    //用户提现路由
    Route::get('withdraw/list', 'WithdrawController@index')->name('withdraw.list');
    Route::post('withdraw/status', 'WithdrawController@status')->name('withdraw.status');

    //商品分类
    Route::get('category/list', 'CategoryController@index')->name('category.list');
    Route::get('category/add', 'CategoryController@add')->name('category.add');
    Route::post('category/store', 'CategoryController@store')->name('category.store');
    Route::post('category/update', 'CategoryController@update')->name('category.update');
    Route::any('category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::get('category/delete/{id}', 'CategoryController@delete')->name('category.delete');

    //认购管理
    Route::get('subscribe/list', 'SubscribeController@index')->name('subscribe.index');
    Route::get('subscribe/add', 'SubscribeController@add')->name('subscribe.add');
    Route::get('subscribe/edit/{id}', 'SubscribeController@edit')->name('subscribe.edit');
    Route::post('subscribe/update', 'SubscribeController@update')->name('subscribe.update');
    Route::get('subscribe/delete/{id}', 'SubscribeController@delete')->name('subscribe.delete');

    //管理员管理
    Route::get('show/list', 'AdminController@index')->name('show.list');
    Route::get('show/add',  'AdminController@add')->name('show.add');
    Route::get('show/edit/{id}', 'AdminController@edit')->name('show.edit');
    Route::post('show/update', 'AdminController@update')->name('show.update');
    Route::post('show/store', 'AdminController@store')->name('show.store');
    Route::get('show/delete/{id}', 'AdminController@delete')->name('show.delete');
});

//认证路由
Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\LoginController@login')->name('admin.login');
Route::post('/admin/logout', 'Admin\LoginController@logout')->name('admin.logout');
