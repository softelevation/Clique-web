<?php

/********************************** Testimonials Routes ********************************/
    Route::get('admin/testimonials/list', 'Admin\TestimonialsController@index')->name('testimonials.list');
    Route::get('admin/create-testimonials', 'Admin\TestimonialsController@create')->name('add-testimonials');
    Route::post('admin/create-testimonials', 'Admin\TestimonialsController@store');
    Route::get('admin/edit-testimonials', 'Admin\TestimonialsController@edit')->name('edit-testimonials');
    Route::post('admin/update-testimonials','Admin\TestimonialsController@updatestore');
    Route::post('admin/testimonials/destroy','Admin\TestimonialsController@destroy');
