<?php

Route::group(['middleware' => ['web']], function() {

    Route::prefix('user')->group(function (){

        Route::get('/login', 'GriffonTech\User\Http\Controllers\LoginController@showLoginForm')->defaults('_config', [
            'view' => 'user::user.login.index'
        ])->name('user.login.index');

        Route::post('/login', 'GriffonTech\User\Http\Controllers\LoginController@login')->defaults('_config', [
            'redirect' => 'user.dashboard.index'
        ])->name('user.login.store');

        Route::get('/register', 'GriffonTech\User\Http\Controllers\LoginController@showLoginForm')->defaults('_config', [
            'view' => 'user::user.login.index'
        ])->name('user.login.index');

        Route::post('/register', 'GriffonTech\User\Http\Controllers\LoginController@login')->defaults('_config', [
            'redirect' => 'user.dashboard.index'
        ])->name('user.login.store');


        Route::get('/quizzes', 'GriffonTech\User\Http\Controllers\QuizzesController@index')
            ->defaults('_config', [
            'view' => 'user::user.quizzes.index'
        ])->name('user.quizzes.index');
    });
});
