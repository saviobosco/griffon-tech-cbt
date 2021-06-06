<?php


namespace GriffonTech\Test\Models;

use GriffonTech\Test\Contracts\TestInstruction as TestInstructionContract;
use Illuminate\Database\Eloquent\Model;

class TestInstruction extends Model implements TestInstructionContract
{

    protected $table = 'test_instructions';

    protected $fillable = [
        'name',
        'instruction'
    ];
}
