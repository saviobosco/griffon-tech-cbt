<?php


namespace GriffonTech\Test\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Test\Contracts\TestSessionAnswer as TestSessionAnswerContract;

class TestSessionAnswer extends Model implements TestSessionAnswerContract
{
    protected $table = 'test_session_answers';

    protected $fillable = [
        'test_session_id',
        'question_id',
        'question_option_id',
        'answer_text',
        'score',
        'time_spent'
    ];

    public function test_session()
    {
        return $this->belongsTo(TestSessionProxy::modelClass(), 'test_session_id', 'id');
    }
}
