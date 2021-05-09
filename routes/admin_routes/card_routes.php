<?php

/********************************** Card Routes ********************************/
Route::get('admin/card/list', 'Admin\CardController@index')->name('card.list');
Route::get('admin/card/create', 'Admin\CardController@create')->name('create.card');
Route::post('admin/card/create', 'Admin\CardController@store')->name('create.store');
Route::post('admin/card/import', 'Admin\CardController@import')->name('create.import');
Route::post('admin/card/destroy','Admin\CardController@destroy');

Route::post('admin/add-single-card', 'Admin\CardController@singlecardstore')->name('single.card.store');

Route::get('admin/assign-card-list/{order_id}', 'Admin\CardController@assigncardlist')->name('assign.card');
Route::post('admin/assign-card-save', 'Admin\CardController@assign_card_save');

Route::post('admin/fetch', 'Admin\CardController@fetch')->name('admin.fetch.ajax');
Route::post('admin/card/assigncard', 'Admin\CardController@assigncard')->name('admin.assigncard');
Route::post('admin/card/revokecard', 'Admin\CardController@revokecard')->name('admin.revokecard');
