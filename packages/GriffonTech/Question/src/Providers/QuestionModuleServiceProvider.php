<?php


namespace GriffonTech\Question\Providers;


use GriffonTech\Question\Models\Question;
use GriffonTech\Question\Models\QuestionOption;
use GriffonTech\Question\Models\QuestionTag;
use GriffonTech\Question\Models\QuestionType;
use Konekt\Concord\BaseModuleServiceProvider;

class QuestionModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $models = [
        Question::class,
        QuestionOption::class,
        QuestionType::class,
        QuestionTag::class

    ];

}
