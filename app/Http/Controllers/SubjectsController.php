<?php


namespace App\Http\Controllers;


use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SubjectsController extends Controller
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
        $subjects = Subject::all();

        return view($this->_config['view'])->with(compact('subjects'));
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
            session()->flash('success', 'Subject was successfully added.');
        } else {
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

        $subject = $subject->update($request->post());
        if ($subject) {
            session()->flash('success', 'Subject record was successfully updated');
        } else {
            session()->flash('error', 'Subject record could not be updated.Please try again.');
            return back()->withInput();
        }
        return redirect()->route($this->_config['redirect']);
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
