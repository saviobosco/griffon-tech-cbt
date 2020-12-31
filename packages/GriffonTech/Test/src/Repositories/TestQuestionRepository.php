<?php


namespace GriffonTech\Test\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Test\Contracts\TestQuestion;

class TestQuestionRepository extends Repository
{
    public function model()
    {
        return TestQuestion::class;
    }

}
