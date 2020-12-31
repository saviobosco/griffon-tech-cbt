<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Question\Models\Question;
use GriffonTech\Quiz\Models\Quiz;
use GriffonTech\Quiz\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionsController extends Controller
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
        $quiz_id = \request()->query('quiz_id');
        if (!$quiz_id) {
            return redirect()->route('quizzes.index');
        }
        $quiz = Quiz::find($quiz_id);

        $questions = Question::query()
            ->latest()
            ->get();

        $question_ids = QuizQuestion::where('quiz_id', $quiz_id)
            ->pluck('question_id')->toArray();

        return view($this->_config['view'])
            ->with(compact('questions', 'question_ids', 'quiz'));
    }



    public function create()
    {

    }


    public function store(Request $request)
    {
        $request->validate([
            'score' => 'required',
            'question_id' => 'required',
            'quiz_id' => 'required'
        ]);

        $postData = $request->input();

        // check if question already exists
        $quiz_question = QuizQuestion::query()
            ->where('quiz_id', $postData['quiz_id'])
            ->where('question_id', $postData['question_id'])
            ->first();

        if ($quiz_question) {
            return response()
                ->json([
                    'response' => true
                ]);
        }

        $quiz_question = QuizQuestion::create($request->input());
        if ($quiz_question) {
            return response()
                ->json([
                    'response' => true
                ]);
        } else {
            return response()
                ->json([
                    'response' => false
                ]);
        }
    }

    public function edit($quiz_id)
    {
        $quiz = Quiz::query()
            ->with(['questions.question'])
            ->find($quiz_id);

        return view($this->_config['view'])
            ->with(compact('quiz'));
    }

    public function update(Request $request, QuizQuestion $quizQuestion)
    {
        if ($quizQuestion->update($request->input())) {
            if ($request->ajax()) {
                return response()->json([
                   'message' => 'updated'
                ]);
            }
            session()->flash('success', 'Question record was successfully updated');
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'failed'
                ]);
            }
            session()->flash('error', 'Question record could not be updated. Please try again.');
        }
        return back();
    }



    public function destroy(QuizQuestion $quizQuestion)
    {
        // check if question can be removed ?
        try {
            if ($quizQuestion->delete()) {
                session()->flash('success', 'Question was successfully removed.');
            } else {
                session()->flash('error', 'Question could not be removed.');
            }
        } catch ( \Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
        return back();
    }

}
