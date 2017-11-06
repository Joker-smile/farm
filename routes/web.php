<?php

//前台路由
Route::group(['namespace' => 'Home', 'middleware' => ['wechat.oauth']], function () {

    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/farm', 'HomeController@farm')->name('farm');
    Route::get('products/{id}', 'ProductController@show')->name('products.show');

    Route::get('users', 'UserController@profile')->name('users.profile');

    //个人中心资料设置
    Route::get('users/option', 'UserController@option')->name('users.option');
    Route::get('users/address', 'UserController@address')->name('users.address');
    Route::post('users/address/add', 'UserController@addressadd')->name('users.address.add');
    Route::get('users/wallet', 'UserController@wallet')->name('users.wallet');
    Route::get('users/withdraw', 'UserController@withdraw')->name('users.withdraw');
    Route::get('users/success', 'UserController@success')->name('users.success');
    Route::get('users/amount', 'UserController@amount')->name('users.amount');
    Route::get('users/myfruits', 'UserController@myfruits')->name('users.myfruits');
    Route::get('users/amountfruits', 'UserController@amountfruits')->name('users.amountfruits');
    Route::post('users/fruits', 'UserController@fruits')->name('users.fruits');
    Route::get('users/fruitsrecord', 'UserController@fruitsrecord')->name('users.fruitsrecord');
    Route::get('users/mytree', 'UserController@mytree')->name('users.mytree');
    Route::get('users/amounttree', 'UserController@amounttree')->name('users.amounttree');
    Route::get('users/treerecord', 'UserController@treerecord')->name('users.treerecord');
    Route::post('users/value', 'UserController@value')->name('users.value');
    Route::post('users/trees', 'UserController@trees')->name('users.trees');
    Route::get('users/subscribes', 'UserController@subscribes')->name('users.subscribes');
    Route::post('users/keep', 'UserController@keep')->name('users.keep');
    Route::get('users/share', 'UserController@share')->name('users.share');

    Route::any('users/withdrawhandle', 'UserController@withdrawhandle')->name('users.withdrawhandle');
    Route::get('users/personaldata', 'UserController@personaldata')->name('users.personaldata');
    Route::get('users/aboutus', 'UserController@aboutus')->name('users.aboutus');


    Route::get('wxpay/subscribes', 'SubscribeController@index')->name('subscribes');  //认购交钱页面
    Route::get('wxpay/carts', 'CartController@carts')->name('carts');//购物车界面
    Route::post('subscribes', 'SubscribeController@subscribes')->name('pay.subscribes');
    Route::get('subscribes/{id}', 'SubscribeController@show')->name('subscribes.show');

    Route::post('orders', 'OrderController@order')->name('unified.orders');     //下单
    Route::get('orders/success', 'OrderController@success')->name('orders.success');
    Route::get('wxpay/orders', 'OrderController@orders')->name('orders');
    Route::get('orders/{id}', 'OrderController@show')->name('orders.show');

    Route::get('cart-add', 'CartController@add')->name('cart.add');
    Route::put('cart', 'CartController@update')->name('cart.update');
    Route::delete('cart/{rawId}', 'CartController@delete')->name('cart.delete');
    Route::get('cart/items', 'CartController@items')->name('cart.index');

    Route::resource('address', 'AddressController');
});

//通知路由
Route::post('/notify/subscribe', 'PayController@subscribe')->name('notify.subscribe');
Route::post('/notify/order', 'PayController@order')->name('notify.order');





