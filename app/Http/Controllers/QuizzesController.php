<?php


namespace App\Http\Controllers;


use App\Quiz;
use App\QuizQuestion;
use Carbon\Carbon;
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
            'start_date' => 'required',
            'end_date' => 'nullable',
            'duration' => 'required',
            'pass_percentage' => 'required'
        ]);

        $postData = $request->input();
        $postData['start_date'] = (new Carbon($postData['start_date']))->toDateTimeString();;
        $postData['end_date'] = (new Carbon($postData['end_date']))->toDateTimeString();;
        if (empty($postData['ip_addresses'])) {
            $postData['ip_addresses'] = '*';
        }

        $quiz = Quiz::create($postData);
        if ($quiz) {
            session()->flash('success', 'Quiz was successfully created!');
        } else {
            session()->flash('error', 'Quiz could not be created. Please try again later.');
            return back();
        }
        return redirect()->route($this->_config['redirect']);
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
        $questions = QuizQuestion::query()
            ->with(['question'])
            ->where('quiz_id', $quiz->id)
            ->get();

        return view($this->_config['view'])
            ->with(compact('quiz', 'questions'));
    }



    public function destroy(Quiz $quiz)
    {

    }
}
