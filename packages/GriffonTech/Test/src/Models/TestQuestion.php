<?php


namespace GriffonTech\Test\Models;


use GriffonTech\Question\Models\QuestionProxy;
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

    public function question()
    {
        return $this->belongsTo(QuestionProxy::modelClass(), 'question_id', 'id');
    }

}
