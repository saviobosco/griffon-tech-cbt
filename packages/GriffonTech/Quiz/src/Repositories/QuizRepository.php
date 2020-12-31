<?php


namespace GriffonTech\Quiz\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Quiz\Contracts\Quiz;

class QuizRepository extends Repository
{
    public function model()
    {
        return Quiz::class;
    }

}
