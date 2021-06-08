<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Candidate\Repositories\CandidateRepository;
use GriffonTech\Question\Repositories\QuestionRepository;
use GriffonTech\Test\Repositories\TestRepository;
use GriffonTech\Test\Repositories\TestSessionRepository;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Exceptions\RepositoryException;

class DashboardController extends Controller
{
    protected $_config;

    protected $questionRepository;
    protected $testRepository;
    protected $candidateRepository;
    protected $testSessionRepository;

    public function __construct(
        QuestionRepository $questionRepository,
        TestRepository $testRepository,
        CandidateRepository $candidateRepository,
        TestSessionRepository $testSessionRepository
    )
    {
        $this->questionRepository = $questionRepository;
        $this->testRepository = $testRepository;
        $this->candidateRepository = $candidateRepository;
        $this->testSessionRepository = $testSessionRepository;

        $this->_config = request('_config');
    }

    public function index()
    {
        // generate dates for the last days.
        $days_ranges = [];
        for($num = 5; $num >= 0; $num--) {
            $days_ranges[] = now()->subDays($num)->format('d-m-Y');
        }

        $begin_date = now()->subDays(5)->format('Y-m-d');
        $end_date = now()->format('Y-m-d');

        // get the last six days ranges for candidates registrations
        $days_interval_reg_counts = $this->candidateRepository
            ->getModel()->query()
            ->select(DB::raw('count(id) as total_count, DATE_FORMAT(created_at, "%d-%m-%Y") as date'))
            ->whereRaw("(DATE(created_at) BETWEEN '{$begin_date}' AND '{$end_date}')")
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->pluck('total_count', 'date')
            ->toArray();

        $real_days = [];
        foreach ($days_ranges as $day) {
            $real_days[$day] = (isset($days_interval_reg_counts[$day])) ? $days_interval_reg_counts[$day] : 0;
        }
        $real_days = array_values($real_days);

        $days_ranges = json_encode($days_ranges);
        $real_days = json_encode($real_days);

        // monthly registration count
        $month_ranges = [];
        for($num = 5; $num >= 0; $num--) {
            $month_ranges[] = now()->subMonths($num)->format('F');
        }

        $begin_month = now()->subMonths(5)->day(1)->format('Y-m-d');
        $end_month = now()->format('Y-m-d');

        // get the last six month ranges for candidates registrations
        $month_interval_reg_counts = $this->candidateRepository
            ->getModel()->query()
            ->select(DB::raw('count(id) as total_count, DATE_FORMAT(created_at, "%M") as month'))
            ->whereRaw("(DATE(created_at) BETWEEN '{$begin_month}' AND '{$end_month}')")
            ->groupBy('month')
            //->orderBy(DB::raw('DATE_FORMAT(created_at,"%M")'))
            ->get()
            ->pluck('total_count', 'month')
            ->toArray();

        $real_months = [];
        foreach ($month_ranges as $month) {
            $real_months[$month] = (isset($month_interval_reg_counts[$month])) ? $month_interval_reg_counts[$month] : 0;
        }

        $real_months = array_values($real_months);

        $month_ranges = json_encode($month_ranges);
        $real_months = json_encode($real_months);

        // get all test
        $tests = $this->testRepository->pluck('name', 'id')->toArray();

        $testSessions = $this->testSessionRepository->getModel()
            ->select(DB::raw('count(id) as count, test_id'))
            //->having('test_id')
            ->where('status', 3)
            ->groupBy('test_id')
            ->get()
            ->pluck('count', 'test_id')
            ->toArray();

        $real_tests = [];
        foreach (array_keys($tests) as $test_id) {
            $real_tests[] = (isset($testSessions[$test_id])) ? $testSessions[$test_id] : 0;
        }

        $test_ranges = json_encode(array_values($tests));
        $test_session_counts = json_encode($real_tests);

        //dd($testSessions);




        $total_questions = 0;
        $total_tests = 0;
        $total_candidates = 0;
        $total_products = 0;

        try {
            $total_questions = $this->questionRepository->count();
            $total_tests = $this->testRepository->count();
            $total_candidates = $this->candidateRepository->count();
        } catch (RepositoryException $e) {
            // suppress error
        }
        return view($this->_config['view'])
            ->with(compact('total_tests',
                'total_questions',
            'total_candidates',
            'total_products', 'days_ranges', 'real_days', 'month_ranges',
                'real_months', 'test_ranges', 'test_session_counts'));
    }

}
