<?php


namespace GriffonTech\Test\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Test\Contracts\TestInstruction;

class TestInstructionRepository extends Repository
{
    public function model()
    {
        return TestInstruction::class;
    }

}
