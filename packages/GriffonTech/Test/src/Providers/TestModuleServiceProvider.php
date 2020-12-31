<?php


namespace GriffonTech\Test\Providers;


use GriffonTech\Test\Models\Test;
use GriffonTech\Test\Models\TestCategory;
use GriffonTech\Test\Models\TestQuestion;
use Konekt\Concord\BaseModuleServiceProvider;

class TestModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        Test::class,
        TestCategory::class,
        TestQuestion::class
    ];

}
