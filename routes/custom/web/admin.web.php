<?php

Route::resource('gradelevels', 'Admin\GradelevelController');
Route::resource('sections', 'Admin\SectionController');
Route::resource('subjects', 'Admin\SubjectController');
Route::resource('sy', 'Shared\SyController');
Route::get('syStartYearApi', 'Shared\SyController@syStartYearApi');
Route::get('sy/setAsActive/{id}', 'Shared\SyController@setAsActive')->name('sy.setAsActive');
Route::resource('questions', 'Admin\QuestionController');
Route::resource('faculties', 'Admin\FacultyController');
Route::resource('users', 'Admin\UserController');
Route::resource('schedules', 'Admin\ScheduleController');
Route::resource('students', 'Admin\StudentController');
