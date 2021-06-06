<?php


namespace GriffonTech\Test\Providers;


use GriffonTech\Test\Models\Test;
use GriffonTech\Test\Models\TestCategory;
use GriffonTech\Test\Models\TestInstruction;
use GriffonTech\Test\Models\TestQuestion;
use GriffonTech\Test\Models\TestSession;
use GriffonTech\Test\Models\TestSessionAnswer;
use Konekt\Concord\BaseModuleServiceProvider;

class TestModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        Test::class,
        TestCategory::class,
        TestQuestion::class,
        TestInstruction::class,
        TestSession::class,
        TestSessionAnswer::class,
    ];

}
