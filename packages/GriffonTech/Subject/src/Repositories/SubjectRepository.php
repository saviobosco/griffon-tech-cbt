<?php


namespace GriffonTech\Subject\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Subject\Contracts\Subject;

class SubjectRepository extends Repository
{

    public function model()
    {
        return Subject::class;
    }
}
