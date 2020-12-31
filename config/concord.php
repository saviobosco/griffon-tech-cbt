<?php

return [
    'modules' => [
        /**
         * Example:
         * VendorA\ModuleX\Providers\ModuleServiceProvider::class,
         * VendorB\ModuleY\Providers\ModuleServiceProvider::class
         *
         */
        \GriffonTech\Admin\Providers\AdminModuleServiceProvider::class,
        \GriffonTech\Subject\Providers\SubjectModuleServiceProvider::class,
        \GriffonTech\Question\Providers\QuestionModuleServiceProvider::class,
        \GriffonTech\Quiz\Providers\QuizModuleServiceProvider::class,
        \GriffonTech\User\Providers\UserModuleServiceProvider::class,
        \GriffonTech\Test\Providers\TestModuleServiceProvider::class,
        \GriffonTech\Candidate\Providers\CandidateModuleServiceProvider::class
    ]
];
