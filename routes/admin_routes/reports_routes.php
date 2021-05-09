<?php

/**********************************Reports Routes ********************************/
Route::get('admin/newcustomer/list', 'Admin\ReportsController@newcustomer_index')->name('newcustomer.list');
Route::get('admin/allcustomer/list', 'Admin\ReportsController@allcustomer_index')->name('allcustomer.list');
Route::get('admin/corporateusers/list', 'Admin\ReportsController@corporateusers_index')->name('allcorporateuser.list');
Route::post('user/corporate-admin', 'Admin\ReportsController@corporate_admin')->name('user.fetch.corporate');


Route::get('admin/reports/orders', 'Admin\ReportsController@orders_index')->name('reportsorder.list');
Route::get('admin/reports/subscriberusers', 'Admin\ReportsController@subscriberusers_index')->name('subscriberusers.list');
