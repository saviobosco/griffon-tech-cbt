<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $table = 'quiz_questions';

    protected $fillable = [
        'quiz_id',
        'question_id',
        'score'
    ];


    public function quiz()
    {
        return $this->belongsToMany(Quiz::class, 'quiz_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }


}
