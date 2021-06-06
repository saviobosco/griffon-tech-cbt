<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Candidate\Models\Candidate;
use GriffonTech\Candidate\Repositories\CandidateRepository;
use GriffonTech\Candidate\Repositories\GroupRepository;
use Illuminate\Http\Request;

class CandidatesController extends Controller
{
    protected $_config;
    protected $candidateRepository;
    protected $groupRepository;

    public function __construct(
        CandidateRepository $candidateRepository,
        GroupRepository $groupRepository
    )
    {
        $this->_config = \request('_config');
        $this->candidateRepository = $candidateRepository;
        $this->groupRepository = $groupRepository;
    }

    public function index()
    {
        $candidates = $this->candidateRepository->all();

        return view($this->_config['view'])
            ->with(compact('candidates'));
    }

    public function create()
    {
        return view($this->_config['view']);
    }


    public function store(Request $request)
    {
        return redirect()
            ->route($this->_config['redirect']);
    }

    public function edit(Candidate $candidate)
    {
        $groups = $this->groupRepository
            ->pluck('name', 'id')
            ->prepend('Select Group', '');
        return view($this->_config['view'])
            ->with(compact('candidate', 'groups'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required'/* add the check for male, female */,
        ]);

        $updated = $candidate->update($request->input());

        if ($updated) {
            session()->flash('success', 'Candidate record was successfully updated.');
        } else {
            session()->flash('error', 'Candidate record could not be updated. Please try again.');
        }
        return redirect()
            ->route($this->_config['redirect']);
    }

    public function destroy(Candidate $candidate)
    {
        // delete the candidate infomation
    }


    public function forceDestroy()
    {

    }





}
