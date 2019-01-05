<?php

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'AuthController@checkAuth')->name('checkAuth');
    Route::resource('gradelevels', 'Admin\GradelevelController');
    Route::resource('sections', 'Admin\SectionController');
    Route::resource('subjects', 'Admin\SubjectController');
    Route::resource('sy', 'Shared\SyController');
    Route::get('syStartYearApi', 'Shared\SyController@syStartYearApi');
    Route::get('sy/setAsActive/{id}', 'Shared\SyController@setAsActive')->name('sy.setAsActive');
    Route::resource('questions', 'Admin\QuestionController');
});

