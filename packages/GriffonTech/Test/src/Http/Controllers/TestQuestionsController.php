<?php


namespace GriffonTech\Test\Http\Controllers;


use GriffonTech\Question\Repositories\QuestionRepository;
use GriffonTech\Subject\Repositories\SubjectRepository;
use GriffonTech\Test\Models\Test;
use GriffonTech\Test\Repositories\TestQuestionRepository;
use GriffonTech\Test\Repositories\TestRepository;
use Illuminate\Http\Request;

class TestQuestionsController extends Controller
{
    protected $_config;
    protected $testRepository;
    protected $subjectRepository;
    protected $questionRepository;
    protected $testQuestionRepository;

    public function __construct(
        TestRepository $testRepository,
        SubjectRepository $subjectRepository,
        QuestionRepository $questionRepository,
        TestQuestionRepository $testQuestionRepository
    )
    {
        $this->_config = request('_config');

        $this->testRepository = $testRepository;
        $this->subjectRepository = $subjectRepository;
        $this->questionRepository = $questionRepository;
        $this->testQuestionRepository = $testQuestionRepository;
    }

    public function getQuestions(Request $request, Test $test)
    {
        $getParams = $request->query();

        if (
            (isset($getParams['subject_id']) && !empty($getParams['subject_id'])) &&
            (isset($getParams['topic_id']) && !empty($getParams['topic_id'])) &&
            (isset($getParams['question_type']) && !empty($getParams['question_type'])) ) {

            $questions = $this->questionRepository
                ->findWhere([
                    'subject_id' => $getParams['subject_id'],
                    'topic_id' => $getParams['topic_id'],
                    'type' => $getParams['question_type']
                ]);

            $testQuestions = $this->testQuestionRepository
                ->findWhere([
                    'test_id' => $test->id
                ])
                ->groupBy('question_id')->toArray();

            return view($this->_config['view'])
                ->with(compact('questions', 'test', 'testQuestions'));
        } else {
            return view($this->_config['view']);
        }
    }


    public function edit(Test $test)
    {
        $subjects = $this->subjectRepository
            ->pluck('name', 'id');

        return view($this->_config['view'])
            ->with(compact('test', 'subjects'));
    }


    public function update(Request $request, Test $test)
    {
        $postData = $request->input();
        if (!empty($postData['questions'])) {
            foreach ($postData['questions'] as $question) {
                if (isset($question['test_question_id'])) {
                    $testQuestion = $this->testQuestionRepository
                        ->find($question['test_question_id']);

                    $testQuestion->update([
                        'right_mark' => @$question['right_mark'],
                        'negative_mark' => @$question['negative_mark']
                    ]);
                } else {
                    $this->testQuestionRepository
                        ->create([
                            'test_id' => $test->id,
                            'question_id' => @$question['question_id'],
                            'right_mark' => @$question['right_mark'],
                            'negative_mark' => @$question['negative_mark']
                        ]);
                }
            }
        }
    }

}
