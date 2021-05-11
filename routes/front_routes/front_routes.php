<?php

// Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::get('about-us', 'PagesController@aboutus')->name('aboutus');
Route::get('contact-us', 'PagesController@contactus')->name('aboutus');
Route::post('contact-us', 'PagesController@contactstore')->name('contact-store');
Route::get('pricing', 'PagesController@pricing')->name('aboutus');
Route::get('place-order', 'PagesController@placeorder')->name('place-order');
Route::post('place-order', 'PagesController@placestore')->name('place-order-store');
Route::get('order/thank-you/{order_id}','PagesController@orderthankyou');




Route::get('profile/{id}','PagesController@get_profile')->name('user.main');
Route::get('profile','PagesController@get_profile')->name('user.main');

Route::get('add-to-contact', 'PagesController@addtocontact')->name('add-to-contact');
Route::post('add-to-contact', 'PagesController@addtocontact')->name('add-to-contact-store');

Route::get('user/profile/{id}','PagesController@get_profile')->name('user.main');

Route::get('corporate/profile/{id}','PagesController@get_profile')->name('corporate.main');


Route::get('corporate_profile','PagesController@get_profile')->name('corporate.main');
//Route::get('myprofile/{id}','PagesController@get_profile_new');