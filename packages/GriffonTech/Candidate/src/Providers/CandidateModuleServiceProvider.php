<?php


namespace GriffonTech\Candidate\Providers;


use GriffonTech\Candidate\Models\Group;
use Konekt\Concord\BaseModuleServiceProvider;

class CandidateModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $models = [
        Group::class
    ];
}
