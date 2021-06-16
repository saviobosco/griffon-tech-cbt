<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Question\Repositories\QuestionRepository;
use GriffonTech\Subject\Repositories\SubjectRepository;
use Illuminate\Http\Request;

class QuestionsImportController extends Controller
{
    protected $_config;

    protected $questionRepository;
    protected $subjectRepository;

    public function __construct(
        QuestionRepository $questionRepository,
        SubjectRepository $subjectRepository
    )
    {
        $this->questionRepository = $questionRepository;
        $this->subjectRepository = $subjectRepository;

        $this->_config = request('_config');
    }


    public function index()
    {
        $subjects = $this->subjectRepository->pluck('name', 'id');

        return view($this->_config['view'])
            ->with(compact('subjects'));
    }


    public function import(Request $request)
    {
        $this->validate($request, [
            'file_type' => 'required',
            'subject_id' => 'required',
            'topic_id' => 'required'
        ]);

        if (!$request->hasFile('import_file')) {
            session()->flash('error', 'Import file not given');

            return back();
        }

        $importFile = $request->file('import_file');
        $content = file_get_contents($importFile->path());
        $questions = json_decode($content, true);
        $options = array_flip(['A','B','C','D','E','F']);
        if (!empty($questions)) {
            foreach ($questions as $question) {
                if (!empty($question['num'])) {

                    $storedQuestion = $this->questionRepository->create([
                        'subject_id' => $request->input('subject_id'),
                        'topic_id' => $request->input('topic_id'),
                        'type' => $request->input('question_type'),
                        'difficulty_level' => $request->input('difficulty_level'),
                        'right_mark' => 1,
                        'negative_mark' => 0,
                        'question' => $question['question']
                    ]);

                    if ($storedQuestion) {
                        // get the correct answer
                        $correct_answer = explode(' ', $question['answer_container']['answer'])[2];
                        $correct_answer_index = $options[$correct_answer];

                        if (!empty($question['options'])) {
                            foreach ($question['options'] as $index => $option) {
                                if (!empty($option['text'])) {
                                    $newOption = [
                                        'question_id' => $storedQuestion->id,
                                        'option' => $option['text'],
                                    ];
                                    if ($index == $correct_answer_index) {
                                        $newOption['is_correct'] = 1;
                                        $newOption['score'] = 1;
                                    }
                                    $storedQuestion->options()->create($newOption);
                                }

                            }
                        }
                    }

                }

            }
        }

        session()->flash('success', 'Successful');
        return back();
    }

}
