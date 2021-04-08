<?php


namespace GriffonTech\Admin\Http\Controllers;


use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    protected $_config;

    public function __construct()
    {
        $this->_config = \request('_config');
    }

    public function index()
    {
        return view($this->_config['view']);
    }

    public function create()
    {
        return view($this->_config['view']);
    }


    public function store(Request $request)
    {
        return redirect()
            ->route($this->_config['redirect']);
    }




}
