<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Subject\Models\Subject;
use GriffonTech\Subject\Repositories\SubjectRepository;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    protected $_config;

    protected $subjectRepository;

    public function __construct(
        SubjectRepository $subjectRepository
    )
    {
        $this->_config = request('_config');
        $this->subjectRepository = $subjectRepository;
    }


    public function index()
    {
        $subjects = $this->subjectRepository->all();

        return view($this->_config['view'])
            ->with(compact('subjects'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view($this->_config['view'])
            ->with(compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $subject = Subject::create($request->post() + ['status' => 1]);
        if ($subject) {
            if ($request->ajax()) {
                return response()->json([
                    'type' => 'subject',
                    'data' => $subject
                ]);
            }
            session()->flash('success', 'Subject was successfully added.');
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'type' => 'error_message',
                    'message' => 'Could not add subject.'
                ]);
            }
            session()->flash('error', 'Subject could not be added. Please try again.');
            return back()->withInput();
        }
        return redirect()->route($this->_config['redirect']);
    }

    public function show(Subject $subject)
    {
        return view($this->_config['view'])
            ->with(compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view($this->_config['view'])
            ->with(compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ]);

        $updated = $subject->update($request->post());
        if ($updated) {
            session()->flash('success', 'Subject record was successfully updated');
        } else {
            session()->flash('error', 'Subject record could not be updated.Please try again.');
            return back()->withInput();
        }
        return redirect()->route($this->_config['redirect'], $subject->id);
    }


    public function destroy(Subject $subject)
    {
        // check if the subject is attached to any questions
        if($subject->questions()->first()) {
            session()->flash('error', 'Could not delete subject because it has question attached to it');
            return back();
        } else {
            try {
                $deleted = $subject->delete();
                $subject->questions()->delete();
                if ($deleted) {
                    session()->flash('success', "Subject was successfully deleted.");
                } else {
                    session()->flash('error', 'We could not delete the subject. Please try again.');
                }

            } catch (\Exception $exception) {
                session()->flash('error', $exception->getMessage());
            }
        }
        return back();
    }


}
