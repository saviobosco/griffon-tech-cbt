<?php


namespace GriffonTech\Subject\Providers;


use GriffonTech\Subject\Models\Subject;
use GriffonTech\Subject\Models\SubjectTopic;
use Konekt\Concord\BaseModuleServiceProvider;

class SubjectModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $models = [
        Subject::class,
        SubjectTopic::class
    ];
}
