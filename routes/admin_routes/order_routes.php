<?php

/********************************** Orders Routes ********************************/
Route::get('admin/orders/list', 'Admin\OrdersController@index')->name('orders.list');
Route::post('admin/orders/destroy','Admin\OrdersController@destroy');
Route::post('admin/orders/delivered','Admin\OrdersController@delivered');
Route::post('admin/orders/orderdetail','Admin\OrdersController@orderdetail');
