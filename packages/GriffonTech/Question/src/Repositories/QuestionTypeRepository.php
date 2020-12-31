<?php


namespace GriffonTech\Question\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Question\Contracts\QuestionType;

class QuestionTypeRepository extends Repository
{
    public function model()
    {
        return QuestionType::class;
    }

    /**
     * return the questions types for the
     * html form input select widget
     * @return \Illuminate\Support\Collection
     */
    public function getSelectDisplay()
    {
        return $this->model->query()
            ->pluck('name', 'id')
            ->prepend('select question type', 0);
    }
}
