<?php


namespace GriffonTech\Subject\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Subject\Contracts\SubjectTopic;

class SubjectTopicRepository extends Repository
{
    public function model()
    {
        return SubjectTopic::class;
    }

}
