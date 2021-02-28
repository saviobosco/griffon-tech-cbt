<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Subject\Models\SubjectTopic;
use GriffonTech\Subject\Repositories\SubjectRepository;
use GriffonTech\Subject\Repositories\SubjectTopicRepository;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class SubjectTopicsController extends Controller
{
    protected $_config;

    protected $subjectTopicRepository;
    protected $subjectRepository;

    public function __construct(
        SubjectTopicRepository $subjectTopicRepository,
        SubjectRepository $subjectRepository
    )
    {
        $this->_config = request('_config');
        $this->subjectTopicRepository = $subjectTopicRepository;
        $this->subjectRepository = $subjectRepository;
    }

    public function index($subject_id)
    {
        $subject = $this->subjectRepository
            ->findOrFail($subject_id);

        $topics = $this->subjectTopicRepository
            ->findWhere(['subject_id' => $subject_id],
                ['subject_id', 'id', 'topic']);

        if (\request()->ajax()) {
            return response()->json([
                'type' => 'subject_topics',
                'data' => $topics
            ]);
        }
        return view($this->_config['view'])
            ->with(compact('topics',
                'subject'));
    }

    public function create($subject_id = null)
    {
        $subject = $this->subjectRepository
            ->findOrFail($subject_id);

        return view($this->_config['view'])
            ->with(compact('subject'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'subject_id' => 'required|numeric',
            'topic' => 'required|string'
        ]);

        try {
            $topic = $this->subjectTopicRepository->create($request->input());

            if ($request->ajax()) {
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
            }

            if ($topic) {
                session()->flash('success', 'Topic was successfully added.');
            } else {
                session()->flash('error', 'Topic could not be added. Please try again');
            }
            return redirect()
                ->route($this->_config['redirect'], $request->get('subject_id'));

        } catch(ValidatorException $validatorException) {
            if ($request->ajax()) {
                return response()->json([
                    'type' => 'error_message',
                    'message' => 'A model validation error occurred :' . $validatorException->getMessage()
                ]);
            }
            session()->flash('error', 'A model validation error occurred :' . $validatorException->getMessage());
            return redirect()
                ->route($this->_config['redirect'], $request->get('subject_id'));
        } catch (\Exception $exception) {
            if ($request->ajax()) {
                return response()->json([
                    'type' => 'error_message',
                    'message' => 'The following errors occurred :' . $exception->getMessage()
                ]);
            }

            session()->flash('error', 'The following errors occurred :' . $exception->getMessage());
            return redirect()
                ->route($this->_config['redirect'], $request->get('subject_id'));
        }
    }

    public function edit(SubjectTopic $topic)
    {
        return view($this->_config['view'])
            ->with(compact('topic'));
    }

    public function update(Request $request, SubjectTopic $topic)
    {
        $this->validate($request,[
            'topic' => 'required|string'
        ]);

        if ($topic->update($request->input())) {
            session()->flash('success', 'Topic record was successfully updated');
        } else {
            session()->flash('success', 'Topic record could not be updated. Please try again.');
            return back();
        }
        return redirect()
            ->route($this->_config['redirect'], $topic->subject->id);
    }


    public function destroy(SubjectTopic $topic)
    {
        if ($topic->questions()->count() > 0) {
            session()->flash('error', 'Please detach topic from questions before deleting.');
            return back();
        }

        try {
            if ($topic->delete()) {
                session()->flash('success', 'Topic was successfully deleted.');
            } else {
                session()->flash('error', 'Topic could not be deleted. Try again.');
            }
        } catch (\Exception $e) {
            session()->flash('warning', 'An error occurred while processing your request.');
        }
        return back();
    }


}
