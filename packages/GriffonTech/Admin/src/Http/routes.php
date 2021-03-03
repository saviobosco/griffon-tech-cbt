<?php

Route::group(['middleware' => ['web']], function() {


    /** Admin routes */
    Route::prefix('admin')->group(function (){

        Route::get('/login', 'GriffonTech\Admin\Http\Controllers\LoginController@showLoginForm')->defaults('_config', [
           'view' => 'admin::admin.login.index'
        ])->name('admin.login.index');


        Route::post('/login', 'GriffonTech\Admin\Http\Controllers\LoginController@login')->defaults('_config', [
            'redirect' => 'admin.dashboard.index'
        ])->name('admin.login.store');


        Route::group(['middleware' => ['admin']], function(){

            Route::get('/logout', 'GriffonTech\Admin\Http\Controllers\LoginController@logout')
                ->defaults('_config', [
                'redirect' => 'admin.login.index'
            ])->name('admin.logout');

            /** Admin dashboard */
            Route::get('dashboard/index', 'GriffonTech\Admin\Http\Controllers\DashboardController@index')->defaults('_config', [
                'view' => 'admin::admin.dashboard.index'
            ])->name('admin.dashboard.index');


            /** Subjects */
            Route::get('subjects/index', 'GriffonTech\Admin\Http\Controllers\SubjectsController@index')->defaults('_config', [
                'view' => 'admin::admin.subjects.index'
            ])->name('admin.subjects.index');

            Route::get('subjects/create', 'GriffonTech\Admin\Http\Controllers\SubjectsController@create')->defaults('_config', [
                'view' => 'admin::admin.subjects.create'
            ])->name('admin.subjects.create');

            Route::post('subjects/create', 'GriffonTech\Admin\Http\Controllers\SubjectsController@store')->defaults('_config', [
                'redirect' => 'admin.subjects.index'
            ])->name('admin.subjects.store');

            Route::get('subjects/edit/{subject}', 'GriffonTech\Admin\Http\Controllers\SubjectsController@edit')->defaults('_config', [
                'view' => 'admin::admin.subjects.edit'
            ])->name('admin.subjects.edit');

            Route::post('subjects/edit/{subject}', 'GriffonTech\Admin\Http\Controllers\SubjectsController@update')->defaults('_config', [
                'redirect' => 'admin.subjects.edit'
            ])->name('admin.subjects.update');

            Route::get('subjects/view/{subject}', 'GriffonTech\Admin\Http\Controllers\SubjectsController@show')->defaults('_config', [
                'view' => 'admin::admin.subjects.view'
            ])->name('admin.subjects.view');

            Route::delete('subjects/delete/{subject}', 'GriffonTech\Admin\Http\Controllers\SubjectsController@destroy')->defaults('_config', [
                'redirect' => 'admin.subjects.index'
            ])->name('admin.subjects.delete');


            /** Subject Topics */
            Route::get('subjects/{subject_id}/topics/index', 'GriffonTech\Admin\Http\Controllers\SubjectTopicsController@index')->defaults('_config', [
                'view' => 'admin::admin.subject_topics.index'
            ])->name('admin.subject_topics.index');

            Route::get('subjects/{subject_id}/topics/create', 'GriffonTech\Admin\Http\Controllers\SubjectTopicsController@create')->defaults('_config', [
                'view' => 'admin::admin.subject_topics.create'
            ])->name('admin.subject_topics.create');

            Route::post('subject-topics/create', 'GriffonTech\Admin\Http\Controllers\SubjectTopicsController@store')->defaults('_config', [
                'redirect' => 'admin.subject_topics.index'
            ])->name('admin.subject_topics.store');

            Route::get('subject-topics/edit/{topic}', 'GriffonTech\Admin\Http\Controllers\SubjectTopicsController@edit')->defaults('_config', [
                'view' => 'admin::admin.subject_topics.edit'
            ])->name('admin.subject_topics.edit');

            Route::post('subject-topics/edit/{topic}', 'GriffonTech\Admin\Http\Controllers\SubjectTopicsController@update')->defaults('_config', [
                'redirect' => 'admin.subject_topics.index'
            ])->name('admin.subject_topics.update');

            Route::delete('subject-topics/delete/{topic}', 'GriffonTech\Admin\Http\Controllers\SubjectTopicsController@destroy')->defaults('_config', [
                'redirect' => 'admin.subject_topics.index'
            ])->name('admin.subject_topics.delete');


            /** Questions */
            Route::get('/questions/index','GriffonTech\Admin\Http\Controllers\QuestionsController@index')
                ->defaults('_config', ['view' => 'admin::admin.questions.index'])
                ->name('admin.questions.index');

            Route::get('/questions/create', 'GriffonTech\Admin\Http\Controllers\QuestionsController@create')
                ->defaults('_config', ['view' => 'admin::admin.questions.create'])
                ->name('admin.questions.create');

            Route::post('/questions/create', 'GriffonTech\Admin\Http\Controllers\QuestionsController@store')
                ->defaults('_config', ['redirect' => 'admin.questions.index'])
                ->name('admin.questions.store');

            Route::get('/questions/edit/{question}', 'GriffonTech\Admin\Http\Controllers\QuestionsController@edit')
                ->defaults('_config', ['view' => 'admin::admin.questions.edit'])
                ->name('admin.questions.edit');

            Route::post('/questions/edit/{question}', 'GriffonTech\Admin\Http\Controllers\QuestionsController@update')
                ->defaults('_config', ['redirect' => 'admin.questions.index'])
                ->name('admin.questions.update');

            Route::get('/questions/view/{question}', 'GriffonTech\Admin\Http\Controllers\QuestionsController@show')
                ->defaults('_config', ['view' => 'admin::admin.questions.view'])
                ->name('admin.questions.view');

            Route::delete('/questions/delete/{question}', 'GriffonTech\Admin\Http\Controllers\QuestionsController@destroy')
                ->defaults('_config', ['redirect' => 'admin.questions.index'])
                ->name('admin.questions.delete');

            Route::get('questions/get-template', 'GriffonTech\Admin\Http\Controllers\QuestionsController@getQuestionTypeTemplate')->defaults('_config', [
                'view' => 'admin::admin.questions.get_template'
            ])->name('admin.questions.get_template');


            // Question Options
            Route::get('/question-options/create', 'GriffonTech\Admin\Http\Controllers\QuestionOptionsController@create')
                ->name('admin.question_options.create');

            Route::delete('/question-options/delete/{questionOption}', 'GriffonTech\Admin\Http\Controllers\QuestionOptionsController@destroy')
                ->name('admin.question_options.delete');


            // Quizzes
            Route::get('/quizzes/index', 'GriffonTech\Admin\Http\Controllers\QuizzesController@index')
                ->defaults('_config', ['view' => 'admin::admin.quizzes.index'])
                ->name('admin.quizzes.index');

            Route::get('/quizzes/create', 'GriffonTech\Admin\Http\Controllers\QuizzesController@create')
                ->defaults('_config', ['view' => 'admin::admin.quizzes.create'])
                ->name('admin.quizzes.create');

            Route::post('/quizzes/create', 'GriffonTech\Admin\Http\Controllers\QuizzesController@store')
                ->defaults('_config', ['redirect' => 'admin.quizzes.index'])
                ->name('admin.quizzes.store');

            Route::get('/quizzes/edit/{quiz}', 'GriffonTech\Admin\Http\Controllers\QuizzesController@edit')
                ->defaults('_config', ['view' => 'admin::admin.quizzes.edit'])
                ->name('admin.quizzes.edit');


            Route::post('/quizzes/edit/{quiz}', 'GriffonTech\Admin\Http\Controllers\QuizzesController@update')
                ->defaults('_config', ['redirect' => 'admin.quizzes.index'])
                ->name('admin.quizzes.update');


            Route::get('/quizzes/view/{quiz}', 'GriffonTech\Admin\Http\Controllers\QuizzesController@show')
                ->defaults('_config', ['view' => 'admin::admin.quizzes.view'])
                ->name('admin.quizzes.view');


            Route::delete('/quizzes/delete/{quiz}', 'GriffonTech\Admin\Http\Controllers\QuizzesController@destroy')
                ->defaults('_config', ['redirect' => 'admin.quizzes.index'])
                ->name('admin.quizzes.delete');


            // Quiz Questions
            Route::get('/quiz_questions/index', 'GriffonTech\Admin\Http\Controllers\QuizQuestionsController@index')
                ->defaults('_config', ['view' => 'admin::admin.quiz_questions.index'])
                ->name('admin.quiz_questions.index');

            Route::get('/quiz_questions/create', 'GriffonTech\Admin\Http\Controllers\QuizQuestionsController@create')
                ->defaults('_config', ['view' => 'admin::admin.quiz_questions.index'])
                ->name('admin.quiz_questions.create');

            Route::post('/quiz_questions/create', 'GriffonTech\Admin\Http\Controllers\QuizQuestionsController@store')
                ->name('admin.quiz_questions.store');

            Route::get('/quiz_questions/edit/{quiz_id}', 'GriffonTech\Admin\Http\Controllers\QuizQuestionsController@edit')
                ->defaults('_config', ['view' => 'admin::admin.quiz_questions.edit'])
                ->name('admin.quiz_questions.edit');

            Route::post('/quiz_questions/edit/{quizQuestion}', 'GriffonTech\Admin\Http\Controllers\QuizQuestionsController@update')
                ->name('admin.quiz_questions.update');

            Route::delete('/quiz_questions/delete/{quizQuestion}', 'GriffonTech\Admin\Http\Controllers\QuizQuestionsController@destroy')
                ->name('quiz_questions.delete');


            // Tests it uses the TestsController in the Test Namespace.
            // and view files in the admin view namespace.
            Route::get('/tests/index', 'GriffonTech\Test\Http\Controllers\TestsController@index')
                ->defaults('_config', ['view' => 'admin::admin.tests.index'])
                ->name('admin.tests.index');

            Route::get('/tests/create', 'GriffonTech\Test\Http\Controllers\TestsController@create')
                ->defaults('_config', ['view' => 'admin::admin.tests.create'])
                ->name('admin.tests.create');

            Route::post('/tests/create', 'GriffonTech\Test\Http\Controllers\TestsController@store')
                ->defaults('_config', ['redirect' => 'admin.tests.edit'])
                ->name('admin.tests.store');

            Route::get('/tests/edit/{test}', 'GriffonTech\Test\Http\Controllers\TestsController@edit')
                ->defaults('_config', ['view' => 'admin::admin.tests.edit'])
                ->name('admin.tests.edit');

            Route::post('/tests/edit/{test}', 'GriffonTech\Test\Http\Controllers\TestsController@update')
                ->defaults('_config', ['redirect' => 'admin.tests.index'])
                ->name('admin.tests.update');

            Route::get('/tests/view/{test}', 'GriffonTech\Test\Http\Controllers\TestsController@show')
                ->defaults('_config', ['view' => 'admin::admin.tests.view'])
                ->name('admin.tests.view');

            Route::delete('/tests/delete/{test}', 'GriffonTech\Test\Http\Controllers\TestsController@destroy')
                ->defaults('_config', ['redirect' => 'admin.tests.delete'])
                ->name('admin.tests.delete');

            Route::get('/tests/get-step/{test}', 'GriffonTech\Test\Http\Controllers\TestsController@getStepTemplate')->defaults('_config', [
            ])->name('admin.test.get_step_template');


            // Test Questions
            Route::get('/test-questions/edit/{test}', 'GriffonTech\Test\Http\Controllers\TestQuestionsController@edit')->defaults('_config', [
                'view' => 'admin::admin.test_questions.edit'
            ])->name('admin.test_questions.edit');

            Route::get('/test-questions/get-questions/{test}', 'GriffonTech\Test\Http\Controllers\TestQuestionsController@getQuestions')->defaults('_config', [
                'view' => 'admin::admin.test_questions.get_questions'
            ])->name('admin.test_questions.get_questions');

            Route::post('/test-questions/edit/{test}', 'GriffonTech\Test\Http\Controllers\TestQuestionsController@update')->defaults('_config', [
                'redirect' => ''
            ])->name('admin.test_questions.update');



            // Test Categories routes
            Route::get('/test-categories/index', 'GriffonTech\Test\Http\Controllers\TestCategoriesController@index')
                ->defaults('_config', ['view' => 'admin::admin.test_categories.index'])
                ->name('admin.test_categories.index');

            Route::get('/test-categories/create', 'GriffonTech\Test\Http\Controllers\TestCategoriesController@create')
                ->defaults('_config', ['view' => 'admin::admin.test_categories.create'])
                ->name('admin.test_categories.create');

            Route::post('/test-categories/create', 'GriffonTech\Test\Http\Controllers\TestCategoriesController@store')
                ->defaults('_config', ['redirect' => 'admin.test_categories.index'])
                ->name('admin.test_categories.store');

            Route::get('/test-categories/edit/{testCategory}', 'GriffonTech\Test\Http\Controllers\TestCategoriesController@edit')
                ->defaults('_config', ['view' => 'admin::admin.test_categories.edit'])
                ->name('admin.test_categories.edit');

            Route::post('/test-categories/edit/{testCategory}', 'GriffonTech\Test\Http\Controllers\TestCategoriesController@update')
                ->defaults('_config', ['redirect' => 'admin.test_categories.index'])
                ->name('admin.test_categories.update');

            Route::delete('/test-categories/delete/{testCategory}', 'GriffonTech\Test\Http\Controllers\TestCategoriesController@destroy')
                ->defaults('_config', ['redirect' => 'admin.test_categories.index'])
                ->name('admin.test_categories.delete');



            // Products
            Route::get('/products/index', 'GriffonTech\Product\Http\Controllers\ProductsController@index')
                ->defaults('_config', ['view' => 'admin::admin.products.index'])
                ->name('admin.products.index');

            Route::get('/products/create', 'GriffonTech\Product\Http\Controllers\ProductsController@create')
                ->defaults('_config', ['view' => 'admin::admin.products.create'])
                ->name('admin.products.create');

            Route::post('/products/create', 'GriffonTech\Product\Http\Controllers\ProductsController@store')
                ->defaults('_config', ['redirect' => 'admin.products.index'])
                ->name('admin.products.store');

            Route::get('/products/edit/{product}', 'GriffonTech\Product\Http\Controllers\ProductsController@edit')
                ->defaults('_config', ['view' => 'admin::admin.products.edit'])
                ->name('admin.products.edit');

            Route::post('/products/edit/{product}', 'GriffonTech\Product\Http\Controllers\ProductsController@update')
                ->defaults('_config', ['redirect' => 'admin.products.index'])
                ->name('admin.products.update');

            Route::delete('/products/delete/{product}', 'GriffonTech\Product\Http\Controllers\ProductsController@destroy')
                ->defaults('_config', ['redirect' => 'admin.products.index'])
                ->name('admin.products.delete');


            /** Candidate Groups */
            Route::get('/candidate-groups/index', 'GriffonTech\Admin\Http\Controllers\CandidateGroupsController@index')
                ->defaults('_config', ['view' => 'admin::admin.candidate_groups.index'])
                ->name('admin.candidate_groups.index');

            Route::get('/candidate-groups/create', 'GriffonTech\Admin\Http\Controllers\CandidateGroupsController@create')
                ->defaults('_config', ['view' => 'admin::admin.candidate_groups.create'])
                ->name('admin.candidate_groups.create');

            Route::post('/candidate-groups/create', 'GriffonTech\Admin\Http\Controllers\CandidateGroupsController@store')
                ->defaults('_config', ['redirect' => 'admin.candidate_groups.index'])
                ->name('admin.candidate_groups.store');

            Route::get('/candidate-groups/edit/{group}', 'GriffonTech\Admin\Http\Controllers\CandidateGroupsController@edit')
                ->defaults('_config', ['view' => 'admin::admin.candidate_groups.edit'])
                ->name('admin.candidate_groups.edit');

            Route::post('/candidate-groups/edit/{group}', 'GriffonTech\Admin\Http\Controllers\CandidateGroupsController@update')
                ->defaults('_config', ['redirect' => 'admin.candidate_groups.index'])
                ->name('admin.candidate_groups.update');

            Route::delete('/candidate-groups/delete/{group}', 'GriffonTech\Admin\Http\Controllers\CandidateGroupsController@destroy')
                ->defaults('_config', ['redirect' => 'admin.candidate_groups.index'])
                ->name('admin.candidate_groups.delete');


            /** Candidates Admin Routes */
            Route::get('/candidates/index', 'GriffonTech\Admin\Http\Controllers\CandidatesController@index')
                ->defaults('_config', ['view' => 'admin::admin.candidates.index'])
                ->name('admin.candidates.index');

            Route::get('/candidates/create', 'GriffonTech\Admin\Http\Controllers\CandidatesController@create')
                ->defaults('_config', ['view' => 'admin::admin.candidates.create'])
                ->name('admin.candidates.create');

            Route::post('/candidates/create', 'GriffonTech\Admin\Http\Controllers\CandidatesController@store')
                ->defaults('_config', ['redirect' => 'admin.candidates.index'])
                ->name('admin.candidates.store');

            Route::get('/candidates/edit/{group}', 'GriffonTech\Admin\Http\Controllers\CandidatesController@edit')
                ->defaults('_config', ['view' => 'admin::admin.candidates.edit'])
                ->name('admin.candidates.edit');

            Route::post('/candidates/edit/{group}', 'GriffonTech\Admin\Http\Controllers\CandidatesController@update')
                ->defaults('_config', ['redirect' => 'admin.candidates.index'])
                ->name('admin.candidates.update');

            Route::delete('/candidates/delete/{group}', 'GriffonTech\Admin\Http\Controllers\CandidatesController@destroy')
                ->defaults('_config', ['redirect' => 'admin.candidates.index'])
                ->name('admin.candidates.delete');

        });

    });
});
