<?php
$except = ['create', 'edit', 'show'];

Route::get('evaluateTeacherSelection', 'Student\EvaluationController@evaluateTeacherSelection');
Route::get('evaluateTeacher/{sectionID}/{subjectID}/{facultyID}', 'Student\EvaluationController@evaluateTeacher');
Route::post('studentEvaluationStore', 'Student\EvaluationController@studentEvaluationStore')->name('studentEvaluation.store');

//comments
Route::resource('studentComments', 'Student\CommentController', ['only' => ['index', 'store']]);
