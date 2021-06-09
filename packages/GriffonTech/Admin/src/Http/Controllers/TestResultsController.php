<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Question\Repositories\QuestionRepository;
use GriffonTech\Test\Models\TestSession;
use GriffonTech\Test\Repositories\TestSessionRepository;
use Illuminate\Support\Facades\DB;

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

    public function reProcessResult(TestSession $testSession)
    {
        $testSession->submit();

        session()->flash('success', 'Test result was successfully re calculated.');
        return back();
    }

    public function destroy(TestSession $testSession)
    {
        try {
            DB::beginTransaction();
            $testSession->delete();
            $testSession->test_session_answers()->delete();
            DB::commit();
            session()->flash('success', 'Test result was successfully deleted.');
        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('error', "An error occurred. Could not delete the test result. Please report to the technical team.");
        }
        return redirect()
            ->route($this->_config['redirect']);
    }

}
