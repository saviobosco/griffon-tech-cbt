<?php


namespace GriffonTech\Candidate\Http\Controllers;


use GriffonTech\Test\Repositories\TestRepository;

class DashboardController extends Controller
{

    protected $_config;
    protected $testRepository;


    public function __construct(
        TestRepository $testRepository
    )
    {
        $this->testRepository = $testRepository;
        $this->_config = request('_config');
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


}
