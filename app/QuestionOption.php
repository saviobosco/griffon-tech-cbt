<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{

    protected $table = 'question_options';

    protected $fillable = [
        'option',
        'option_match',
        'is_correct',
        'score'
    ];
}
