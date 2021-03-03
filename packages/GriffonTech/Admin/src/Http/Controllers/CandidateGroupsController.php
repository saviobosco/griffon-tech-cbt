<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Candidate\Models\Group;
use GriffonTech\Candidate\Repositories\GroupRepository;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class CandidateGroupsController extends Controller
{
    protected $_config;

    protected $groupRepository;

    public function __construct(
        GroupRepository $groupRepository
    )
    {
        $this->_config = request('_config');

        $this->groupRepository = $groupRepository;
    }

    public function index()
    {
        $groups = $this->groupRepository->get();

        return view($this->_config['view'])
            ->with(compact('groups'));
    }

    public function create()
    {
        return view($this->_config['view']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        try {
            $group = $this->groupRepository->create($request->input());

            if ($group) {
                session()->flash('success', 'Candidate group was successfully created');
            } else {
                session()->flash('error', 'Candidate group could not be created.');
            }
        } catch (ValidatorException $e) {
            session()->flash('error', $e->getMessage());
        }

        return redirect()
            ->route($this->_config['redirect']);
    }


    public function edit(Group $group)
    {
        return view($this->_config['view'])
            ->with(compact('group'));
    }


    public function update(Request $request, Group $group)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        try {
            $updated = $this->groupRepository
                ->update($request->input(), $group->id);

            if ($updated) {
                session()->flash('success', 'Candidate group was successfully updated');
            } else {
                session()->flash('error', 'Candidate group could not be updated.');
            }
        } catch (ValidatorException $e) {
            session()->flash('error', $e->getMessage());
        }
        return redirect()
            ->route($this->_config['redirect']);
    }


    // Todo: complete the business logic here.
    public function destroy(Group $group)
    {
        // if the group does not belong to any group ?
        // delete the group
        // else return back with a reason not to delete the record.
        try {
            if ($group->delete()) {
                session()->flash('success', 'Candidate group was successfully deleted.');
            } else {
                session()->flash('error', 'Candidate group could not be deleted.');
            }
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        return redirect()
            ->route($this->_config['redirect']);
    }
}
