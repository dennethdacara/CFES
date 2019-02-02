<?php

Route::resource('gradelevels', 'Admin\GradelevelController');
Route::resource('sections', 'Admin\SectionController');
Route::resource('subjects', 'Admin\SubjectController');
Route::resource('sy', 'Shared\SyController');
Route::get('syStartYearApi', 'Shared\SyController@syStartYearApi');
Route::get('sy/setAsActive/{id}', 'Shared\SyController@setAsActive')->name('sy.setAsActive');
Route::resource('semesters', 'Shared\SemesterController', ['only' => ['index']]);
Route::get('semesters/setAsActive/{id}', 'Shared\SemesterController@setAsActive')->name('semesters.setAsActive');
Route::resource('questions', 'Admin\QuestionController');

Route::resource('faculties', 'Admin\FacultyController');
Route::get('faculties/toggleActivation/{userID}', 'Admin\FacultyController@toggleActivation')->name('faculties.toggle_activation');

Route::resource('users', 'Admin\UserController');
Route::resource('schedules', 'Admin\ScheduleController');
Route::resource('students', 'Admin\StudentController');

Route::resource('evaluationSettings', 'Admin\EvaluationDurationSettingsController', ['only' => ['index', 'update']]);
