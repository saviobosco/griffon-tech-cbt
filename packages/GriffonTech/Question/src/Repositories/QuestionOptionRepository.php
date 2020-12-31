<?php


namespace GriffonTech\Question\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Question\Contracts\QuestionOption;

class QuestionOptionRepository extends Repository
{
    public function model()
    {
        return QuestionOption::class;
    }
}
