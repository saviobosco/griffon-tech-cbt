<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'type',
        'question',
        'description',
        'subject_id',
        'level_id',
        'paragraph'
    ];

    public function question_options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id', 'id');
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_id', 'id');
    }

}
