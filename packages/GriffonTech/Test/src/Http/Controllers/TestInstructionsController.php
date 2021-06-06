<?php


namespace GriffonTech\Test\Http\Controllers;


use GriffonTech\Test\Models\TestInstruction;
use GriffonTech\Test\Repositories\TestInstructionRepository;
use Illuminate\Http\Request;

class TestInstructionsController extends Controller
{

    protected $_config;

    protected $testInstructionRepository;

    public function __construct(
        TestInstructionRepository $testInstructionRepository
    )
    {
        $this->testInstructionRepository = $testInstructionRepository;

        $this->_config = \request('_config');
    }

    public function index()
    {
        $testInstructions = $this->testInstructionRepository
            ->all();

        return view($this->_config['view'])
            ->with(compact('testInstructions'));
    }


    public function create()
    {
        return view($this->_config['view']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $testInstruction = $this->testInstructionRepository->create($request->input());
        if ($testInstruction) {
            session()->flash('success', 'Test instruction was successfully added!');
        } else {
            session()->flash('error', 'Test instruction could not be added. Please try again.');
        }

        return redirect()
            ->route($this->_config['redirect']);
    }


    public function edit(TestInstruction $testInstruction)
    {
        return view($this->_config['view'])
            ->with(compact('testInstruction'));
    }


    public function update(Request $request, TestInstruction $testInstruction)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        try {
            $testInstruction = $this->testInstructionRepository->update($request->input(), $testInstruction->id);
            if ($testInstruction) {
                session()->flash('success', 'Test instruction was successfully updated.');
            } else {
                session()->flash('error', 'Test instruction could not be updated. please try again.');
            }
        } catch (\Exception $exception) {
            session()->flash('error', 'An error occurred. please try again.');
        }

        return redirect()
            ->route($this->_config['redirect']);
    }



    public function destroy(TestInstruction $testInstruction)
    {
        // check if the test instruction is attached to a test.
        // if true ignore delete command with a warning.

        try {
            $testInstruction->delete();
            session()->flash('success', 'instruction was successfully deleted!.');

        } catch (\Exception $exception) {
            session()->flash('error', 'Could not delete instruction. Please try again.');
        }

        return redirect()
            ->route($this->_config['redirect']);
    }
}
