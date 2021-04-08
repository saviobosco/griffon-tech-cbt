<?php


namespace GriffonTech\Candidate\Repositories;


use GriffonTech\Candidate\Contracts\Candidate;
use GriffonTech\Core\Eloquent\Repository;

class CandidateRepository extends Repository
{

    public function model()
    {
        return Candidate::class;
    }

}
