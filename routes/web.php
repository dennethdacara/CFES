<?php

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'AuthController@checkAuth')->name('checkAuth');

    require_once "custom/web/admin.web.php";
    require_once "custom/web/faculty.web.php";
    require_once "custom/web/student.web.php";

});

