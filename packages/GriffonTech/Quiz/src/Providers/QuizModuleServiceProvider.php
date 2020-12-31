<?php


namespace GriffonTech\Quiz\Providers;


use GriffonTech\Quiz\Models\Quiz;
use GriffonTech\Quiz\Models\QuizQuestion;
use Konekt\Concord\BaseModuleServiceProvider;

class QuizModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        Quiz::class,
        QuizQuestion::class
    ];

}
