<?php


namespace GriffonTech\Question\Models;


use GriffonTech\Subject\Models\SubjectProxy;
use GriffonTech\Subject\Models\SubjectTopicProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Question\Contracts\Question as QuestionContract;

class Question extends Model implements QuestionContract
{
    protected $table = 'questions';

    protected $fillable = [
        'type',
        'question',
        'description',
        'subject_id',
        'topic_id',
        'level_id',
        'paragraph',
        'difficulty_level',
        'right_mark',
        'negative_mark',
    ];

    /*protected $dispatchesEvents = [
        'saving' => \GriffonTech\Question\Events\QuestionSaving::class
    ];*/


    public function subject()
    {
        return $this->belongsTo(SubjectProxy::modelClass(), 'subject_id', 'id');
    }

    public function topic()
    {
        return $this->belongsTo(SubjectTopicProxy::modelClass(), 'topic_id', 'id');
    }

    public function options()
    {
        return $this->hasMany(QuestionOptionProxy::modelClass(), 'question_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(QuestionTagProxy::modelClass(), 'question_tag', 'question_id', 'tag_id');
    }

    public function getTagStringAttribute()
    {
        if ($this->tags->isEmpty()) {
            return '';
        }

        $string = $this->tags->reduce(function($str, $tag){
            return $str . $tag->tag . ', ';
        }, '');

        return trim($string, ', ');
    }

}
