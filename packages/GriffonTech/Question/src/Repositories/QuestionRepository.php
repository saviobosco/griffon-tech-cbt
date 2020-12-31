<?php


namespace GriffonTech\Question\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Question\Contracts\Question;

class QuestionRepository extends Repository
{
    public function model()
    {
        return Question::class;
    }

}
