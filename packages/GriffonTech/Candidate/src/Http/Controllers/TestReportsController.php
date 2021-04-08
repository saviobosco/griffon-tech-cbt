<?php


namespace GriffonTech\Candidate\Http\Controllers;


class TestReportsController extends Controller
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


    public function show($testReport)
    {
        return view($this->_config['view']);
    }

}
