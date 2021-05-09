<?php
/**********************************Comapny Routes ********************************/
Route::get('admin/company/list', 'Admin\CompanyController@index')->name('company.list');
Route::get('admin/create-company', 'Admin\CompanyController@create')->name('add-company');
Route::post('admin/create-company', 'Admin\CompanyController@store');
Route::get('admin/edit-comapny', 'Admin\CompanyController@edit')->name('edit-user');
Route::post('admin/update-comapny','Admin\CompanyController@updatestore');
Route::post('admin/company/destroy','Admin\CompanyController@destroy');

Route::get('admin/create-company-user', 'Admin\CompanyController@createuser')->name('add-company-user');
Route::post('admin/create-company-user', 'Admin\CompanyController@storeuser');
