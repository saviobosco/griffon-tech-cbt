<?php


namespace GriffonTech\User\Providers;


use GriffonTech\User\Models\User;
use Konekt\Concord\BaseModuleServiceProvider;

class UserModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        User::class
    ];
}
