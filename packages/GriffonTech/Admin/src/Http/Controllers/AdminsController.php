<?php


namespace GriffonTech\Admin\Http\Controllers;


use GriffonTech\Admin\Models\Admin;
use GriffonTech\Admin\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    protected $_config;
    protected $adminRepository;

    public function __construct(
        AdminRepository $adminRepository
    )
    {
        $this->_config = request('_config');

        $this->adminRepository = $adminRepository;
    }

    public function index()
    {
        $admins = $this->adminRepository->all();

        return view($this->_config['view'])
            ->with(compact('admins'));
    }

    public function create()
    {
        return view($this->_config['view']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:6'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $newData = $request->input();
        $newData['password'] = Hash::make($newData['password']);

        $admin = $this->adminRepository->create($newData);
        if ($admin) {
            session()->flash('success', 'User was successfully added!');
        } else {
            session()->flash('error', 'User could not be added. Please try again!');
        }
        return redirect()
            ->route($this->_config['redirect']);
    }


    public function edit(Admin $admin)
    {
        return view($this->_config['view'])
            ->with(compact('admin'));
    }


    public function update(Request $request, Admin $admin)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required'
        ]);

        $updated = $admin->update($request->input());
        if ($updated) {
            session()->flash('success', 'User was successfully updated!');
        } else {
            session()->flash('error', 'User could not be updated. Please try again.');
            return back();
        }
        return redirect()
            ->route($this->_config['redirect']);
    }


    public function destroy(Admin $admin)
    {
        session()->flash('info', 'Function not active!');
        return redirect()
            ->route($this->_config['redirect']);

        try {
            $admin->delete();
        } catch (\Exception $exception) {
            session()->flash('error', 'could not delete user. An error occurred!');
        }
        return redirect()
            ->route($this->_config['redirect']);
    }
}
