<?php


namespace GriffonTech\Candidate\Http\Controllers;


use Carbon\Carbon;
use GriffonTech\Question\Repositories\QuestionRepository;
use GriffonTech\Test\Models\Test;
use GriffonTech\Test\Repositories\TestRepository;
use GriffonTech\Test\Repositories\TestSessionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestsController extends Controller
{
    protected $_config;
    protected $testSessionRepository;
    protected $questionRepository;
    protected $testRepository;

    public function __construct(
        TestSessionRepository $testSessionRepository,
        QuestionRepository $questionRepository,
        TestRepository $testRepository
    )
    {
        $this->_config = request('_config');

        $this->testSessionRepository = $testSessionRepository;
        $this->questionRepository = $questionRepository;
        $this->testRepository = $testRepository;
    }


    public function index()
    {
        $tests = $this->testRepository
            ->findWhere([
                'is_published' => 1
            ]);

        return view($this->_config['view'])
            ->with(compact('tests'));
    }


    public function show(Test $test)
    {
        return view($this->_config['view'])
            ->with(compact('test'));
    }


    public function start(Request $request, Test $test)
    {
        // check if the user has a running test
        $activeTestSession = $this->testSessionRepository
            ->findWhere([
                'test_id' => $test->id,
                'candidate_id' => auth()->user()->id,
                'status' => 1
            ])->first();

        if ($activeTestSession) {
            return redirect()
                ->route('candidate.test_sessions.in_progress', $activeTestSession->id);
        }

        // and resume the session.
        $currentTime = now();
        if ($test->start_date->timestamp > $currentTime->timestamp) {

            session()->flash('error', 'Test is currently unavailable.');
            return back();
        }

        if ($test->end_date->timestamp < $currentTime->timestamp) {

            session()->flash('error', 'Test timeframe has expired.');
            return back();
        }

        if (now()->diff(new Carbon($test->start_time))->format('%R') == '+') {
            session()->flash('error', 'Test start time has not reached yet.');
            return back();
        }

        if (now()->diff(new Carbon($test->end_time))->format('%R') == '-') {
            session()->flash('error', 'Test start time has ended for the day.');
            return back();
        }

        // check if the test is with the time frame in start and end date
        // also in start and end time

        // if test in not multiple times,
        // check if user has taken the test before
        if ((int)$test->multiple_attempt === 0) {
            $testSessionsCount = $this->testSessionRepository
                ->findWhere([
                    'test_id' => $test->id,
                    'candidate_id' => auth()->user()->id,
                ])->count();
            if ($testSessionsCount > 0) {

                session()->flash('error', 'You have completed this test and it can only be taken once.');
                return back();
            }
        }

        $questionIds = $test->questions()->pluck('question_id')
            ->toArray();

        $subjectIds = $this->questionRepository->getModel()
            ->select(DB::raw('distinct subject_id'))
            ->whereIn('id', $questionIds)
            ->pluck('subject_id')
            ->toArray();

        $testSession = $this->testSessionRepository->create([
            'candidate_id' => auth()->user()->id,
            'test_id' => $test->id,
            'subject_ids' => implode(",", $subjectIds),
            'question_ids' => implode(",",$questionIds),
            'start_time' => now(),
            'end_time' => now()->addMinutes($test->duration),
            'attempted_ip' => $request->getClientIp(),
        ]);

        if ($testSession) {
            return redirect()
                ->route('candidate.test_sessions.in_progress', $testSession->id);
        }

        // prepare the test
        // get all test questions
        // get all question subjects
        // take user to the test-sessions/current/{testSession}
        // store all the test information

        session()->flash('error', 'An error occurred. Could not prepare test. Please try again');
        return back();
    }
}
