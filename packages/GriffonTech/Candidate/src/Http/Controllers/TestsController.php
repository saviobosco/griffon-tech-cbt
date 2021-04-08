<?php


namespace GriffonTech\Candidate\Http\Controllers;


use Illuminate\Http\Request;

class TestsController extends Controller
{
    protected $_config;

    public function __construct()
    {
        $this->_config = request('_config');
    }


    public function index()
    {
        return view($this->_config['view']);
    }


    public function show($testa)
    {
        return view($this->_config['view']);
    }


    public function start(Request $request)
    {

        return redirect()
            ->route('candidate.test_template.jamb');
    }
}
