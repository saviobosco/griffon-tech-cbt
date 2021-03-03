<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Question\Repositories\QuestionRepository;
use GriffonTech\Test\Repositories\TestRepository;
use Prettus\Repository\Exceptions\RepositoryException;

class DashboardController extends Controller
{
    protected $_config;

    protected $questionRepository;
    protected $testRepository;

    public function __construct(
        QuestionRepository $questionRepository,
        TestRepository $testRepository
    )
    {
        $this->questionRepository = $questionRepository;
        $this->testRepository = $testRepository;

        $this->_config = request('_config');
    }

    public function index()
    {
        $total_questions = 0;
        $total_tests = 0;
        $total_candidates = 0;
        $total_products = 0;

        try {
            $total_questions = $this->questionRepository->count();
            $total_tests = $this->testRepository->count();
        } catch (RepositoryException $e) {
            // suppress error
        }
        return view($this->_config['view'])
            ->with(compact('total_tests',
                'total_questions',
            'total_candidates',
            'total_products'));
    }

}
