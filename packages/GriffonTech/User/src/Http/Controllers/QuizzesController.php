<?php


namespace GriffonTech\User\Http\Controllers;


use GriffonTech\Quiz\Repositories\QuizRepository;

class QuizzesController extends Controller
{
    protected $_config;

    protected $quizRepository;

    public function __construct(
        QuizRepository $quizRepository
    )
    {
        $this->_config = request('_config');

        $this->quizRepository = $quizRepository;
    }

    public function index()
    {
        // if user is guest get all free quizzes without authentication.
        // and display to the user ...
        // else get both those that requires authentications...
        return view($this->_config['view']);
    }
}
