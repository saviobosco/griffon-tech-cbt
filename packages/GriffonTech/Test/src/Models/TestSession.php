<?php


namespace GriffonTech\Test\Models;


use GriffonTech\Candidate\Models\CandidateProxy;
use Illuminate\Database\Eloquent\Model;
use GriffonTech\Test\Contracts\TestSession as TestSessionContract;

class TestSession extends Model implements TestSessionContract
{
    protected $table = 'test_sessions';

    protected $fillable = [
        'candidate_id',
        'test_id',
        'subject_ids',
        'question_ids',
        'start_time',
        'end_time',
        'attempted_ip',
        'individual_time',
        'total_score',
        'total_time',
        'status'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    public function candidate()
    {
        return $this->belongsTo(CandidateProxy::modelClass(), 'candidate_id', 'id');
    }

    public function test()
    {
        return $this->belongsTo(TestProxy::modelClass(), 'test_id', 'id');
    }

    public function test_session_answers()
    {
        return $this->hasMany(TestSessionAnswerProxy::modelClass(), 'test_session_id', 'id');
    }


    public function submit()
    {
        // get all test session answers
        // sum up all the scores
        // register sum in the test total
        // mark the test as completed if all scores has been registered
        // else mark as pending if essay is included.
        // return true if it completed successfully .

        $answers = $this->test_session_answers;

        $scoreSum = 0;
        $missingScore = false;

        if ($answers->isNotEmpty()) {
            foreach($answers as $answer) {
                if (!is_null($answer->score)) {
                    $scoreSum += $answer->score;
                } else {
                    $missingScore = true;
                }
            }
        }
        $updateData = [
            'total_score' => $scoreSum
        ];
        if ($missingScore) {
            $updateData['status'] = 3;
        } else {
            $updateData['status'] = 2;
        }

        return $this->update($updateData);
    }
}
