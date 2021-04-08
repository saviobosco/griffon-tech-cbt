<?php


namespace GriffonTech\Candidate\Http\Controllers;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating candidates for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $_config;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/candidate/dashboard/index';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->_config = request('_config');

    }

    public function showLoginForm()
    {
        return view($this->_config['view']);
    }

}
