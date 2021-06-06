<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Question\Repositories\QuestionRepository;
use GriffonTech\Test\Models\TestSession;
use GriffonTech\Test\Repositories\TestSessionRepository;

class TestResultsController extends Controller
{
    protected $testSessionRepository;
    protected $questionRepository;

    protected $_config;

    public function __construct(
        TestSessionRepository $testSessionRepository,
        QuestionRepository $questionRepository
    )
    {
        $this->testSessionRepository = $testSessionRepository;
        $this->questionRepository = $questionRepository;

        $this->_config = request('_config');

    }

    public function index()
    {
        $testSessions = $this->testSessionRepository
            ->all();

        return view($this->_config['view'])
            ->with(compact('testSessions'));
    }

    public function show(TestSession $testSession)
    {

        $questions = $this->questionRepository
            ->findWhereIn('id',
                explode(',', $testSession->question_ids));

        $testSessionAnswers = $testSession->test_session_answers()
            ->get()
            ->groupBy('question_id')
            ->toArray();

        return view($this->_config['view'])
            ->with(compact('testSession',
                'questions',
                'testSessionAnswers'));
    }
}
