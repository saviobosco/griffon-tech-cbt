<?php

Route::group(['middleware' => ['web']], function(){

    Route::prefix('candidate')->group(function (){

        Route::get('/register', 'GriffonTech\Candidate\Http\Controllers\RegisterController@showregisterForm')->defaults('_config', [
            'view' => 'candidate::candidate.auth.register'
        ])->name('candidate.register.index');


        Route::post('/register', 'GriffonTech\Candidate\Http\Controllers\RegisterController@store')->defaults('_config', [
            'redirect' => 'candidate.dashboard.index'
        ])->name('candidate.register.store');


        Route::get('/login', 'GriffonTech\Candidate\Http\Controllers\LoginController@showLoginForm')->defaults('_config', [
            'view' => 'candidate::candidate.auth.login'
        ])->name('candidate.login.index');

        Route::post('/login', 'GriffonTech\Candidate\Http\Controllers\LoginController@login')->defaults('_config', [
            'redirect' => 'candidate.dashboard.index'
        ])->name('candidate.login.store');


        Route::group(['middleware' => ['auth']], function() {

            Route::get('/logout', 'GriffonTech\Candidate\Http\Controllers\LoginController@logout')
                ->defaults('_config', [
                    'redirect' => 'candidate.login.index'
                ])->name('candidate.logout');


            /** Candidate dashboard */
            Route::get('dashboard/index', 'GriffonTech\Candidate\Http\Controllers\DashboardController@index')->defaults('_config', [
                'view' => 'candidate::candidate.dashboard.index'
            ])->name('candidate.dashboard.index');


            /** My Tests */
            Route::get('tests/index', 'GriffonTech\Candidate\Http\Controllers\TestsController@index')->defaults('_config', [
                'view' => 'candidate::candidate.tests.index'
            ])->name('candidate.tests.index');

            Route::get('tests/view/{testa}', 'GriffonTech\Candidate\Http\Controllers\TestsController@show')->defaults('_config', [
                'view' => 'candidate::candidate.tests.show'
            ])->name('candidate.tests.view');

            Route::post('tests/start/{testa}', 'GriffonTech\Candidate\Http\Controllers\TestsController@start')->defaults('_config', [
                'redirect' => 'candidate.tests.show'
            ])->name('candidate.tests.start');


            /** My Test Sessions */

            Route::get('test-sessions/in-progress/{testSession}', 'GriffonTech\Candidate\Http\Controllers\TestsController@inProgress')
                ->defaults('_config', [
                'view' => 'candidate::candidate.test_sessions.in_progress'
            ])->name('candidate.test_sessions.in_progress');



            /** My Test Reports */
            Route::get('test-reports/index', 'GriffonTech\Candidate\Http\Controllers\TestReportsController@index')->defaults('_config', [
                'view' => 'candidate::candidate.test_reports.index'
            ])->name('candidate.test_reports.index');

            Route::get('test-reports/view/{testReport}', 'GriffonTech\Candidate\Http\Controllers\TestReportsController@show')->defaults('_config', [
                'view' => 'candidate::candidate.test_reports.show'
            ])->name('candidate.test_reports.view');


        });



    });
});
