<?php

/**********************************Custome pages Routes ********************************/
Route::get('admin/pages/list', 'Admin\PagesController@index')->name('pages.list');
Route::get('admin/create-pages', 'Admin\PagesController@create')->name('add-pages');
Route::post('admin/create-pages', 'Admin\PagesController@store');
Route::get('admin/edit-pages', 'Admin\PagesController@edit')->name('edit-pages');
Route::post('admin/pages/destroy','Admin\PagesController@destroy');
