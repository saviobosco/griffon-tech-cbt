<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', 'DashboardController@index')->name('dashboard:index');


Route::get('/subjects/index', 'SubjectsController@index')->name('subjects.index')
    ->defaults('_config', ['view' => 'subjects.index']);
Route::get('/subjects/create', 'SubjectsController@create')->name('admin.subjects.create')
    ->defaults('_config', ['view' => 'subjects.create']);
Route::post('/subjects/create', 'SubjectsController@store')->name('subjects.store')
    ->defaults('_config', ['redirect' => 'subjects.index']);
Route::get('/subjects/edit/{subject}', 'SubjectsController@edit')->name('subjects.edit')
    ->defaults('_config', ['view' => 'subjects.edit']);
Route::post('/subjects/edit/{subject}', 'SubjectsController@update')
    ->name('subjects.update')
    ->defaults('_config', ['redirect' => 'subjects.index']);
Route::get('/subjects/view/{subject}', 'SubjectsController@show')->name('subjects.view')
    ->defaults('_config', ['view' => 'subjects.view']);

Route::delete('/subjects/delete/{subject}', 'SubjectsController@destroy')
    ->name('subjects.delete')->defaults('_config', ['redirect' => 'subjects.index']);


// Questions
Route::get('/questions/index', 'QuestionsController@index')->name('questions.index')
    ->defaults('_config', ['view' => 'questions.index']);
Route::get('/questions/create', 'QuestionsController@create')->name('questions.create')
    ->defaults('_config', ['view' => 'questions.create']);

Route::post('/questions/create', 'QuestionsController@store')
    ->name('questions.store')
    ->defaults('_config', ['redirect' => 'questions.index']);

Route::get('/questions/edit/{question}', 'QuestionsController@edit')->name('questions.edit')
    ->defaults('_config', ['view' => 'questions.edit']);

Route::post('/questions/edit/{question}', 'QuestionsController@update')
    ->name('questions.update')
    ->defaults('_config', ['redirect' => 'questions.index']);

Route::get('/questions/view/{question}', 'QuestionsController@show')->name('questions.view')
    ->defaults('_config', ['view' => 'questions.view']);

Route::delete('/questions/delete/{question}', 'QuestionsController@destroy')->name('questions.delete')
    ->defaults('_config', ['redirect' => 'questions.index']);



// Question Options
Route::get('/question_options/create', 'QuestionOptionsController@create')->name('question_options.create');
Route::delete('/question_options/delete/{questionOption}', 'QuestionOptionsController@destroy')->name('question_options.delete');


// Quizzes
Route::get('/quizzes/index', 'QuizzesController@index')->name('quizzes.index')
    ->defaults('_config', ['view' => 'quizzes.index']);
Route::get('/quizzes/create', 'QuizzesController@create')->name('quizzes.create')
    ->defaults('_config', ['view' => 'quizzes.create']);
Route::post('/quizzes/create', 'QuizzesController@store')->name('quizzes.store')
    ->defaults('_config', ['redirect' => 'quizzes.index']);
Route::get('/quizzes/edit/{quiz}', 'QuizzesController@edit')->name('quizzes.edit')
    ->defaults('_config', ['view' => 'quizzes.edit']);
Route::post('/quizzes/edit/{quiz}', 'QuizzesController@update')->name('quizzes.update')
    ->defaults('_config', ['redirect' => 'quizzes.index']);
Route::get('/quizzes/view/{quiz}', 'QuizzesController@show')->name('quizzes.view')
    ->defaults('_config', ['view' => 'quizzes.view']);
Route::delete('/quizzes/delete/{quiz}', 'QuizzesController@destroy')->name('quizzes.delete')
    ->defaults('_config', ['redirect' => 'quizzes.index']);



// Quiz Questions
Route::get('/quiz_questions/index', 'QuizQuestionsController@index')->name('quiz_questions.index')
    ->defaults('_config', ['view' => 'quizzes.index']);

Route::get('/quiz_questions/create', 'QuizQuestionsController@create')->name('quiz_questions.create')
    ->defaults('_config', ['view' => 'quizzes.index']);

Route::post('/quiz_questions/create', 'QuizQuestionsController@store')->name('quiz_questions.store');

Route::get('/quiz_questions/edit/{quiz_id}', 'QuizQuestionsController@edit')->name('quiz_questions.edit')
    ->defaults('_config', ['view' => 'quiz_questions.edit']);

Route::post('/quiz_questions/edit/{quizQuestion}', 'QuizQuestionsController@update')->name('quiz_questions.update');

Route::delete('/quiz_questions/delete/{quizQuestion}', 'QuizQuestionsController@destroy')->name('quiz_questions.delete');
