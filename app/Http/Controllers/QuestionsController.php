<?php


namespace App\Http\Controllers;


use App\Question;
use App\QuestionOption;
use App\Subject;
use Illuminate\Http\Request;

class QuestionsController extends Controller
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
        $questions = Question::all();

        return view($this->_config['view'])
            ->with(compact('questions'));
    }


    public function create()
    {
        $subjects = Subject::pluck('name', 'id');
        $subjects = ['' => 'Select Subject'] + $subjects->toArray();
        return view('questions.create')
            ->with(compact('subjects'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
        ]);

        $postData = $request->input();

        if ($postData['type'] === 'multiple_select_single_answer') {
            if (!isset($postData['option_answer_correct'])) {
                session()->flash('error', 'Please select at least one option as the answer to the question.');
                return back();
            }
        }

        if ($postData['type'] === 'multiple_select_multiple_answer') {
            $answer_provided = false;
            foreach ($postData['option_answer'] as $answer) {
                if (isset($answer['correct'])) {
                    $answer_provided = true;
                    break;
                }
            }
            if ($answer_provided === false) {
                session()->flash('error', 'Please select one or more option(s) as the answer(s) to the question.');
                return back();
            }
        }

        if ($postData['type'] === 'match_the_column') {
            if (empty($postData['option_answer'])) {
                session()->flash('error', 'Please add one or more option(s) as the answer(s) to the question.');
                return back();
            }
        }

        $question = Question::create($postData);
        if ($question) {
            if ($postData['type'] === 'multiple_select_single_answer') {
                foreach ($postData['option_answer'] as $index => $answer) {
                    if (empty($answer['text'])) continue;

                    $option_data = [];
                    $option_data['option'] = $answer['text'];
                    if ((int)$index === (int)$postData['option_answer_correct']) {
                        $option_data['is_correct'] = 1;
                        $option_data['score'] = 1;
                    }
                    $question->question_options()->create($option_data);
                }
            }

            if ($postData['type'] === 'multiple_select_multiple_answer') {
                foreach ($postData['option_answer'] as $answer) {
                    if (empty($answer['text'])) continue;

                    $option_data = [];
                    $option_data['option'] = $answer['text'];
                    if (isset($answer['correct'])) {
                        $option_data['is_correct'] = 1;
                        $option_data['score'] = 1;
                    }
                    $question->question_options()->create($option_data);
                }
            }

            if ($postData['type'] === 'match_the_column') {
                $score = 1 / count($postData['option_answer']);
                foreach ($postData['option_answer'] as $answer) {
                    if (empty($answer['text_1']) || empty($answer['text_2'])) continue;

                    $option_data = [];
                    $option_data['option'] = $answer['text_1'];
                    $option_data['option_match'] = $answer['text_2'];
                    $option_data['is_correct'] = 1;
                    $option_data['score'] = $score;
                    $question->question_options()->create($option_data);
                }
            }
            session()->flash('success', 'Question was successfully added.');
        }
        return back();
        // process the question submission
    }


    public function edit(Question $question)
    {
        $subjects = Subject::pluck('name', 'id');
        $subjects = ['' => 'Select Subject'] + $subjects->toArray();
        return view('questions.edit')
            ->with(compact('question', 'subjects'));
    }


    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required'
        ]);

        $postData = $request->input();

        $question->update($postData);
        if ($question) {
            if (in_array($question->type, ['multiple_select_single_answer', 'multiple_select_multiple_answer', 'match_the_column'])) {
                $options = $question->options;

                if ($question->type === 'multiple_select_single_answer') {
                    foreach ($options as $option) {
                        $option_data['option'] = $postData['option_answer'][$option->id]['text'];
                        if ((int)$option->id === (int)$postData['option_answer_correct']) {
                            $option_data['is_correct'] = 1;
                            $option_data['score'] = 1;
                        } else {
                            $option_data['is_correct'] = 0;
                            $option_data['score'] = 0;
                        }
                        $option->update($option_data);
                    }
                }

                if ($question->type === 'multiple_select_multiple_answer') {
                    foreach ($options as $option) {
                        $option_data['option'] = $postData['option_answer'][$option->id]['text'];
                        if (isset($postData['option_answer'][$option->id]['correct'])) {
                            $option_data['is_correct'] = 1;
                            $option_data['score'] = 1;
                        } else {
                            $option_data['is_correct'] = 0;
                            $option_data['score'] = 0;
                        }
                        $option->update($option_data);
                    }
                }

                if ($question->type === 'match_the_column') {
                    foreach ($options as $option) {
                        $option_data['option'] = $postData['option_answer'][$option->id]['text_1'];
                        $option_data['option_match'] = $postData['option_answer'][$option->id]['text_2'];
                        $option->update($option_data);
                    }
                }
            }

            session()->flash('success', 'Question was successfully updated.');
        }
        return back();
    }


    public function show(Question $question)
    {
        return view('questions.view')
            ->with(compact('question'));
    }


    public function destroy(Question $question)
    {
        try {
            $options = $question->options;
            if ($question->delete()) {
                foreach ( $options as $option) {
                    $option->delete();
                }
                session()->flash('success', 'Question was successfully deleted.');
            } else {
                session()->flash('error', 'Question could not be deleted. Please try again');
            }
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }
        return redirect()->route($this->_config['redirect']);
    }

}
