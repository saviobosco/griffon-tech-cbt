<?php


namespace GriffonTech\Subject\Models;

use GriffonTech\Question\Models\QuestionProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Subject\Contracts\SubjectTopic as SubjectTopicContract;
class SubjectTopic extends Model implements SubjectTopicContract
{

    protected $table = 'subject_topics';

    protected $fillable = [
        'topic',
        'subject_id'
    ];

    public function subject()
    {
        return $this->belongsTo(SubjectProxy::modelClass(), 'subject_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(QuestionProxy::modelClass(), 'topic_id', 'id');
    }

}
