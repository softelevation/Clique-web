<?php
    Route::get('admin/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::get('admin/users/list', 'Admin\UserController@user_index')->name('users.list');
    Route::post('admin/users/destroy','Admin\UserController@destroy');
    Route::get('admin/create-user', 'Admin\UserController@create')->name('add-user');
    Route::post('admin/create-user', 'Admin\UserController@store');

    Route::get('admin/system-admin-list', 'Admin\UserController@systemadminindex')->name('systemadmin.list');
    Route::get('admin/create/system-admin', 'Admin\UserController@createsystemadmin')->name('system-user');
    Route::post('admin/createsystemadmin', 'Admin\UserController@store');
    Route::get('admin/edit/system-admin', 'Admin\UserController@editsystemadmin')->name('edit.systemadmin.user');

    Route::get('admin/corporate-list', 'Admin\UserController@corporateadminindex')->name('corporateadmin.list');
    Route::get('admin/create/corporate-admin', 'Admin\UserController@createcorporateadmin')->name('corporateadmin-user');
    Route::post('admin/createcorporateadmin', 'Admin\UserController@store');
    Route::get('admin/edit/corporate-admin', 'Admin\UserController@editcorporateadmin')->name('edit.corporateadmin.user');
    Route::post('admin/edit/corporate-admin', 'Admin\UserController@update_corporateAdmin_user')->name('store.corporateadmin.user');

    Route::get('admin/create/corporate-user', 'Admin\UserController@createcorporateuser')->name('corporate-user');
    Route::post('admin/createcorporateuser', 'Admin\UserController@store');

    Route::get('admin/create/individual-user', 'Admin\UserController@createindividualuser')->name('individual-user');
    Route::post('admin/createindividualuser', 'Admin\UserController@store');

    Route::get('admin/edit-user', 'Admin\UserController@edit')->name('edit-user');
    Route::post('admin/update-user','Admin\UserController@updatestore');
    Route::post('admin/update-password','Admin\UserController@update_user_password');

    Route::get('/logout', 'Admin\UserController@logout');

    //////****************Ragistration routs */
    // Route::get('create/system-admin', 'Admin\UserController@createsystemadmin')->name('system-user');
    Route::post('auth/createsystemadmin', 'Auth\RegisterController@store');
    
    //// get user profile image
    Route::post('admin/getprofilepath', 'Admin\UserController@profilepath')->name('user-profilepath');

    Route::get('corporate-register', 'Auth\RegisterController@company_register')->name('company-register');
    Route::post('corporate-register', 'Auth\RegisterController@company_register_store')->name('company-register-store');
    Route::get('admin/corporate-request-list', 'Admin\ComapnyRequest@index')->name('corporate.request.list');
    Route::post('admin/corporaterequest/destroy','Admin\ComapnyRequest@destroy');


