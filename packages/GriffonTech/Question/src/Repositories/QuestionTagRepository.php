<?php


namespace GriffonTech\Question\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Question\Contracts\QuestionTag;

class QuestionTagRepository extends Repository
{

    public function model()
    {
        return QuestionTag::class;
    }
}
