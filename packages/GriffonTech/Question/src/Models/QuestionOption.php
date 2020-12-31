<?php


namespace GriffonTech\Question\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Question\Contracts\QuestionOption as QuestionOptionContract;

class QuestionOption extends Model implements QuestionOptionContract
{
    protected $table = 'question_options';

    protected $fillable = [
        'option',
        'option_match',
        'is_correct',
        'score'
    ];


    public function options()
    {
        return $this->hasMany(QuestionOptionProxy::modelClass(), 'question_id', 'id');
    }
}
