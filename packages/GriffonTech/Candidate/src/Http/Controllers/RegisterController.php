<?php


namespace GriffonTech\Candidate\Http\Controllers;


use GriffonTech\Candidate\Repositories\CandidateRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $redirectTo = '/candidate/dashboard/index';

    protected $_config;

    protected $candidateRepository;

    public function __construct(
        CandidateRepository $candidateRepository
    )
    {
        $this->_config = request('_config');

        $this->candidateRepository = $candidateRepository;
    }

    public function showRegisterForm()
    {
        return view($this->_config['view']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:candidates'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $data = $request->input();

        $candidate = $this->candidateRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => (isset($data['gender']) && !empty($data['gender'])) ? $data['gender'] : null
        ]);

        if ($candidate) {
            // Todo
            // login the user in
            // redirect to the user dashboard
            session()->flash('success', 'Your account was successfully created. You can login now');
        } else {
            session()->flash('error', 'Your account could not be created!. Please try again.');
        }
        return back();
    }


    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

}
