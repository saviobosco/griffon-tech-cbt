<?php


namespace GriffonTech\Admin\Http\Controllers;


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
