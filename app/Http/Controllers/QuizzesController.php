<?php


namespace App\Http\Controllers;


use App\Quiz;
use Illuminate\Http\Request;

class QuizzesController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    public function __construct()
    {
        $this->_config = request('_config');
    }


    public function index()
    {
        $quizzes = Quiz::all();
        return view($this->_config['view'])
            ->with(compact('quizzes'));
    }


    public function create()
    {
        return view($this->_config['view']);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable|min:20',
            'start_date' => 'required|integer',
            'end_date' => 'nullable|integer',
            'duration' => 'required',
            'pass_percentage' => 'required'
        ]);

        $quiz = Quiz::create($request->input());
    }

    public function edit(Quiz $quiz)
    {
        return view($this->_config['view'])
            ->with(compact('quiz'));
    }


    public function update(Request $request, Quiz $quiz)
    {

    }

    public function show(Quiz $quiz)
    {
        return view($this->_config['view'])
            ->with(compact('quiz'));
    }


    public function destroy(Quiz $quiz)
    {

    }
}
