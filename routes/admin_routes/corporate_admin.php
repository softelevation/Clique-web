<?php

    Route::get('admin/corporate/dashboard', 'Corporate\DashboardController@index')->name('corporate.dashboard');
    Route::get('admin/corporate/users/list', 'Corporate\UserController@user_index')->name('corporate.users.list');
    Route::post('admin/corporate/users/destroy','Corporate\UserController@destroy');
    Route::get('admin/corporate/create-user', 'Corporate\UserController@create')->name('corporate.add-user');
    Route::post('admin/corporate/create-user', 'Corporate\UserController@store');
    Route::get('admin/corporate/profile', 'Corporate\UserController@profile')->name('corporate.profile');
    Route::post('admin/corporate/profile', 'Corporate\UserController@profileupdate')->name('corporate.profileupdate');

    Route::get('admin/corporate/orders/list', 'Corporate\OrdersController@index')->name('corporate.orders.list');

    Route::get('admin/corporate/create-order', 'Corporate\OrdersController@create_order');

   // Route::get('admin/corporate/place-order', 'Corporate\OrdersController@place_order')->name('corporate.createorder');

    Route::post('admin/corporate/placeorder', 'Corporate\OrdersController@placeorder')->name('corporate.placeorder');


    Route::get('admin/corporate/assign-card-list', 'Corporate\CardController@assigncardlist')->name('corporate.assign.card');

    Route::post('user/fetch', 'Corporate\CardController@fetch')->name('user.fetch.ajax');

    Route::post('admin/corporate/assigncard', 'Corporate\CardController@assigncard')->name('corporate.assigncard');

    Route::post('admin/corporate/revokecard', 'Corporate\CardController@revokecard')->name('corporate.revokecard');


    Route::get('admin/corporate/edit-user', 'Corporate\UserController@edit')->name('corporate-edit-user');
