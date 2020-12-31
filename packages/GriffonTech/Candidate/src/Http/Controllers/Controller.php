<?php


namespace GriffonTech\Candidate\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    protected $_config;

    public function __construct()
    {
        $this->_config = request('_config');
    }

    public function index()
    {

    }

    public function create()
    {

    }

    public function store()
    {

    }

}
