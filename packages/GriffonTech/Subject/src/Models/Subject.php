<?php


namespace GriffonTech\Subject\Models;


use GriffonTech\Question\Models\QuestionProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Subject\Contracts\Subject as SubjectContract;

class Subject extends Model implements SubjectContract
{
    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function questions()
    {
        return $this->hasMany(QuestionProxy::modelClass(), 'subject_id', 'id');
    }

    public function topics()
    {
        return $this->hasMany(SubjectTopicProxy::modelClass(), 'subject_id', 'id');
    }
}
