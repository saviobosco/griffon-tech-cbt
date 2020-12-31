<?php


namespace GriffonTech\Quiz\Models;


use GriffonTech\Question\Models\QuestionProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Quiz\Contracts\QuizQuestion as QuizQuestionContract;

class QuizQuestion extends Model implements QuizQuestionContract
{
    protected $table = 'quiz_questions';

    protected $fillable = [
        'quiz_id',
        'question_id',
        'score'
    ];

    public function quiz()
    {
        return $this->belongsToMany(QuizProxy::modelClass(), 'quiz_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(QuestionProxy::modelClass(), 'question_id', 'id');
    }
}
