<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Subject\Repositories\SubjectTopicRepository;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class SubjectTopicsController extends Controller
{
    protected $_config;

    protected $subjectTopicRepository;

    public function __construct(
        SubjectTopicRepository $subjectTopicRepository
    )
    {
        $this->_config = request('_config');
        $this->subjectTopicRepository = $subjectTopicRepository;
    }

    public function index($subject_id)
    {
        $topics = $this->subjectTopicRepository
            ->findWhere(['subject_id' => $subject_id], ['subject_id', 'id', 'topic']);

        if (\request()->ajax()) {
            return response()->json([
                'type' => 'subject_topics',
                'data' => $topics
            ]);
        }
        return view($this->_config['view']);
    }

    public function create()
    {
        return view($this->_config['view']);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'subject_id' => 'required|numeric',
            'topic' => 'required|string'
        ]);

        try {
            $topic = $this->subjectTopicRepository->create($request->input());

            if ($topic) {
                return response()->json([
                    'type' => 'subject_topic',
                    'data' => $topic
                ], 201);
            } else {
                return response()->json([
                    'type' => 'error_message',
                    'message' => 'Could not create the subject topic'
                ]);
            }

        } catch(ValidatorException $validatorException) {
            return response()->json([
                'type' => 'error_message',
                'message' => 'A model validation error occurred :' . $validatorException->getMessage()
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'type' => 'error_message',
                'message' => 'Subject topic could not be created. The following errors occurred :' . $exception->getMessage()
            ]);
        }
    }

}
