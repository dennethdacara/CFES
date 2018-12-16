<?php

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'AuthController@checkAuth')->name('checkAuth');
    Route::resource('gradelevels', 'Admin\GradelevelController');
    Route::resource('sections', 'Admin\SectionController');
    Route::resource('subjects', 'Admin\SubjectController');
});

