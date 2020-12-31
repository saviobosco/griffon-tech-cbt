<?php


namespace GriffonTech\Subject\Models;

use Illuminate\Database\Eloquent\Model;
use GriffonTech\Subject\Contracts\SubjectTopic as SubjectTopicContract;
class SubjectTopic extends Model implements SubjectTopicContract
{

    protected $table = 'subject_topics';

    protected $fillable = [
        'topic',
        'subject_id'
    ];
}
