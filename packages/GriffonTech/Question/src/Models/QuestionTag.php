<?php


namespace GriffonTech\Question\Models;


use Illuminate\Database\Eloquent\Model;
use \GriffonTech\Question\Contracts\QuestionTag as QuestionTagContract;

class QuestionTag extends Model implements QuestionTagContract
{
    protected $fillable = [
        'tag'
    ];


}
