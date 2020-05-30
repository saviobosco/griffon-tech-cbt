<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $fillable = [
        'name',
        'description',
        'start_time',
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

}
