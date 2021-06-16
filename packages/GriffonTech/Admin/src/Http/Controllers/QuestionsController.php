<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Question\Models\Question;
use GriffonTech\Question\Repositories\QuestionTagRepository;
use GriffonTech\Subject\Models\Subject;
use GriffonTech\Question\Repositories\QuestionRepository;
use GriffonTech\Subject\Repositories\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    protected $_config;

    protected $questionRepository;
    protected $subjectRepository;
    protected $questionTagRepository;

    public function __construct(
        QuestionRepository $questionRepository,
        SubjectRepository $subjectRepository,
        QuestionTagRepository $questionTagRepository
    )
    {
        $this->_config = request('_config');

        $this->questionRepository = $questionRepository;
        $this->subjectRepository = $subjectRepository;
        $this->questionTagRepository = $questionTagRepository;
    }

    public function index()
    {
        $questions = $this->questionRepository->all();
        $subjectLists = $this->subjectRepository->pluck('name', 'id');

        return view($this->_config['view'])
            ->with(compact('questions', 'subjectLists'));
    }


    public function create()
    {
        $subjects = Subject::pluck('name', 'id');
        $subjects = ['0' => 'Select Subject'] + $subjects->toArray();

        return view($this->_config['view'])
            ->with(compact('subjects'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
        ]);

        /*if (in_array($request->input('type'), [
            'multiple_choice',
            'multiple_response',
            'match_the_column',
            'true_or_false'])) {

            $request->validate([
                'right_mark' => ,
                'negative_mark' => 'required',
                'difficulty_level' => 'required'
            ]);
        }*/

        $postData = $request->input();

        if ($postData['type'] === 'multiple_choice') {
            if (!isset($postData['option_answer_correct'])) {
                session()->flash('error', 'Please select at least one option as the answer to the question.');
                return back()->withInput();
            }
        }

        if ($postData['type'] === 'multiple_response') {
            $answer_provided = false;
            if (!empty($postData['option_answer_correct'])) {
                $answer_provided = true;
            }

            if ($answer_provided === false) {
                session()->flash('error', 'Please select one or more option(s) as the answer(s) to the question.');
                return back()->withInput();
            }
        }

        if ($postData['type'] === 'match_the_column') {
            if (empty($postData['option_answer'])) {
                session()->flash('error', 'Please add one or more option(s) as the answer(s) to the question.');
                return back()->withInput();
            }
        }

        if ($postData['type'] === 'fill_the_blank') {
            if (strlen(trim($postData['option_answer'][1]['text'])) <= 0) {
                session()->flash('error', 'Please add an answer for the question.');
                return back()->withInput();
            }
        }

        $postData['right_mark'] = (isset($postData['right_mark']) && !empty($postData['right_mark'])) ? $postData['right_mark'] : 1;
        $postData['negative_mark'] = (isset($postData['negative_mark']) && !empty($postData['negative_mark'])) ? $postData['negative_mark'] : 1;
        $postData['difficulty_level'] = (isset($postData['difficulty_level']) && !empty($postData['difficulty_level'])) ? $postData['difficulty_level'] : 'normal';

        $question = Question::create($postData);

        if ($question) {
            if ($postData['type'] === 'multiple_choice') {
                foreach ($postData['option_answer'] as $index => $answer) {
                    if (empty($answer['text'])) continue;

                    $option_data = [];
                    $option_data['option'] = $answer['text'];
                    if ((int)$index === (int)$postData['option_answer_correct']) {
                        $option_data['is_correct'] = 1;
                        $option_data['score'] = 1;
                    }
                    $question->options()->create($option_data);
                }
            }

            if ($postData['type'] === 'multiple_response') {
                foreach ($postData['option_answer'] as $index => $answer) {
                    if (empty($answer['text'])) continue;

                    $option_data = [];
                    $option_data['option'] = $answer['text'];
                    if (in_array($index, $postData['option_answer_correct'])) {
                        $option_data['is_correct'] = 1;
                        $option_data['score'] = $postData['right_mark'] / count($postData['option_answer_correct']);
                    }
                    $question->options()->create($option_data);
                }
            }

            if ($postData['type'] === 'match_the_column') {
                $score = $postData['right_mark'] / count($postData['option_answer']);
                foreach ($postData['option_answer'] as $answer) {
                    if (empty($answer['text_1']) || empty($answer['text_2'])) continue;

                    $option_data = [];
                    $option_data['option'] = $answer['text_1'];
                    $option_data['option_match'] = $answer['text_2'];
                    $option_data['is_correct'] = 1;
                    $option_data['score'] = $score;
                    $question->options()->create($option_data);
                }
            }

            if ($postData['type'] === 'true_or_false') {

                foreach (['True', 'False'] as $answer) {
                    $option_data = [];
                    $option_data['option'] = $answer;
                    if ($postData['option_answer_correct'] === strtolower($answer)) {
                        $option_data['is_correct'] = 1;
                        $option_data['score'] = $postData['right_mark'];
                    } else if ($postData['option_answer_correct'] === strtolower($answer)) {
                        $option_data['is_correct'] = 1;
                        $option_data['score'] = $postData['right_mark'];
                    }
                    $question->options()->create($option_data);
                }
            }

            if ($postData['type'] === 'fill_the_blank') {
                $option_data = [];
                $option_data['option'] = $postData['option_answer'][1]['text'];
                $option_data['is_correct'] = 1;
                $option_data['score'] = $postData['right_mark'];

                $question->options()->create($option_data);
            }

            // Save the question tags
            $this->saveTags($question, $request);

            session()->flash('success', 'Question was successfully added.');
        }
        return back();
        // process the question submission
    }

    // saving the question tags
    // move this to the model later.
    protected function saveTags(Question $question, Request $request)
    {
        // add question tags
        if ($request->input('tags')) {
            $tagsArray = array_map('trim', explode(',', $request->input('tags')));
            // remove all empty tags
            $tagsArray = array_filter($tagsArray);
            // Reduce duplicated tags
            $tagsArray = array_unique($tagsArray);

            $out = [];

            $query = $this->questionTagRepository
                ->whereIn('tag', $tagsArray);

            // Remove existing tags from the list of new tags.
            foreach ($query->pluck('tag') as $existing) {
                $index = array_search($existing, $tagsArray);
                if ($index !== false) {
                    unset($tagsArray[$index]);
                }
            }

            // Add existing tags.
            foreach ($query->get() as $tag) {
                $out[] = $tag->id;
            }
            // Add new tags.
            foreach($tagsArray as $tag) {
                $out[] = $this->questionTagRepository
                    ->create(['tag' => $tag])['id'];
            }

            $question->tags()->sync($out);
        }
    }


    public function edit(Question $question)
    {
        $subjects = Subject::pluck('name', 'id');
        $subjects = ['' => 'Select Subject'] + $subjects->toArray();

        $topics = $question->subject->topics()->pluck('topic', 'id');

        return view($this->_config['view'])
            ->with(compact('question', 'subjects', 'topics'));
    }


    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required'
        ]);

        $postData = $request->input();

        if ($question->update($request->input())) {
            session()->flash('success', 'Question was successfully updated.');
        } else {
            session()->flash('error', 'Question could not be updated.');
        }

        if ($question->type === 'multiple_choice') {
            foreach ($postData['option_answer'] as $index => $option) {
                if (empty($option['text'])) continue;
                $option['is_correct'] = 0;
                $option['score'] = 0;

                if (isset($option['id'])) {
                    $question_option = $question->options()->find($option['id']);
                    if ((int)$postData['option_answer_correct'] === (int)$index) {
                        $option['is_correct'] = 1;
                        $option['score'] = $postData['right_mark'];
                    }
                    $option['option'] = $option['text'];
                    $question_option->update($option);
                } else {
                    if ((int)$postData['option_answer_correct'] === (int)$index) {
                        $option['is_correct'] = 1;
                        $option['score'] = $postData['right_mark'];
                    }
                    $option['option'] = $option['text'];
                    $question->options()->create($option);
                }
            }
        } else if ($question->type === 'multiple_response') {
            foreach($postData['option_answer'] as $index => $option) {
                if (empty($option['text'])) continue;
                $option['is_correct'] = 0;
                $option['score'] = 0;
                $option['option'] = $option['text'];

                if (isset($option['id'])) {
                    $question_option = $question->options()->find($option['id']);
                    if (in_array($index, $postData['option_answer_correct'])) {
                        $option['is_correct'] = 1;
                        $option['score'] = $postData['right_mark'] / count($postData['option_answer_correct']);
                    }
                    $question_option->update($option);
                } else {
                    if (in_array($index, $postData['option_answer_correct'])) {
                        $option['is_correct'] = 1;
                        $option['score'] = $postData['right_mark'] / count($postData['option_answer_correct']);
                    }
                    $question->options()->create($option);
                }
            }
        } else if ($question->type === 'true_or_false') {
            foreach ($question->options as $question_option) {
                $option['is_correct'] = 0;
                $option['score'] = 0;
                if ($postData['option_answer_correct'] === $question_option['option']) {
                    $option['is_correct'] = 1;
                    $option['score'] = $postData['right_mark'];
                }
                $question_option->update($option);
            }
        } else if ($question->type === 'match_the_column') {
            foreach ($postData['option_answer'] as $option) {
                if (empty($option['text_1'])) continue;
                $option['option'] = $option['text_1'];
                $option['option_match'] = $option['text_2'];
                $option['score'] = $postData['right_mark'] / count($postData['option_answer']);
                if (isset($option['id'])) {
                    $question_option = $question->options()->find($option['id']);
                    $question_option->update($option);
                } else {
                    $question->options()->create($option);
                }
            }
        } else if ($question->type === 'fill_the_blank') {
            if (!empty($postData['option_answer'])) {
                $question_option = $question->options()->find($postData['option_answer'][1]['id']);
                $question_option->update(['option' => $postData['option_answer'][1]['text'] ]);
            }
        }

        $this->saveTags($question, $request);

        return back();
    }


    public function show(Question $question)
    {
        return view($this->_config['view'])
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


    public function getQuestionTypeTemplate(Request $request)
    {
        $question_type = $request->query('question_type');

        if (!$question_type) {
            return '<p class="text-center"> Invalid Template Selected. </p>';
        }
        if (view()->exists("admin::admin.questions.templates.{$question_type}")) {
            return view("admin::admin.questions.templates.{$question_type}");
        }
        return '<p class="text-center"> Invalid Template Selected. </p>';
    }


}
