<?php


namespace GriffonTech\Candidate\Http\Controllers;


class DashboardController extends Controller
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


}
