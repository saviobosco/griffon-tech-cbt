<?php


namespace GriffonTech\Candidate\Repositories;


use GriffonTech\Candidate\Contracts\Group;
use GriffonTech\Core\Eloquent\Repository;

class GroupRepository extends Repository
{

    public function model()
    {
        return Group::class;
    }
}
