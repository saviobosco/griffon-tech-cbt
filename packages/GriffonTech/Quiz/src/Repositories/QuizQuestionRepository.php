<?php


namespace GriffonTech\Quiz\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Quiz\Contracts\QuizQuestion;

class QuizQuestionRepository extends Repository
{
    public function model()
    {
        return QuizQuestion::class;
    }
}
