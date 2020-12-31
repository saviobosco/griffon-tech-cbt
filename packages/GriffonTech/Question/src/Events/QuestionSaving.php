<?php


namespace GriffonTech\Question\Events;


use GriffonTech\Question\Models\Question;
use GriffonTech\Question\Repositories\QuestionTagRepository;
use Illuminate\Support\Facades\DB;

class QuestionSaving
{

    public $question;

    public function __construct(Question $question)
    {
        $this->question = $question;

    }

    public function addTags()
    {

    }
}
