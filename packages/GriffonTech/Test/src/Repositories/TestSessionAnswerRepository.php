<?php


namespace GriffonTech\Test\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Test\Contracts\TestSessionAnswer;

class TestSessionAnswerRepository extends Repository
{

    public function model()
    {
        return TestSessionAnswer::class;
    }
}
