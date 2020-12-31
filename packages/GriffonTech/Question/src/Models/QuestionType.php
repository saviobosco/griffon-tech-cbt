<?php


namespace GriffonTech\Question\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Question\Contracts\QuestionType as QuestionTypeContract;
class QuestionType extends Model implements QuestionTypeContract
{
    protected $table = 'question_types';

    protected $fillable = [
        'key',
        'name',
        'sort_order',
        'visibility'
    ];

}
