<?php


namespace GriffonTech\Test\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Test\Contracts\TestSession;

class TestSessionRepository extends Repository
{

    public function model()
    {
        return TestSession::class;
    }
}
