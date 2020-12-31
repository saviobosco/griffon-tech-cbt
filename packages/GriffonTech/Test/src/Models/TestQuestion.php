<?php


namespace GriffonTech\Test\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Test\Contracts\TestQuestion as TestQuestionContract;

class TestQuestion extends Model implements TestQuestionContract
{
    protected $table = 'test_questions';

    protected $fillable = [
        'test_id',
        'question_id',
        'right_mark',
        'negative_mark'
    ];

}
