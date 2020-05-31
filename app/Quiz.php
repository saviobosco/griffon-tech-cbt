<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'question_ids',
        'no_of_questions',
        'ip_addresses',
        'duration',
        'pass_percentage',
        'view_answer',
        'require_camera',
        'question_selection',
        'chart_rank',
        'requires_login',
        'template',
        'price'
    ];


    public function questions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id', 'id');
    }

}
