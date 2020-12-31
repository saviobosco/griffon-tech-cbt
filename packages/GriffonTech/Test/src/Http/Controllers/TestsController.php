<?php


namespace GriffonTech\Test\Http\Controllers;


use GriffonTech\Test\Models\Test;
use GriffonTech\Test\Repositories\TestCategoryRepository;
use GriffonTech\Test\Repositories\TestRepository;
use Illuminate\Http\Request;

class TestsController extends Controller
{

    protected $_config;
    protected $testRepository;
    protected $testCategoryRepository;

    public function __construct(
        TestRepository $testRepository,
        TestCategoryRepository $testCategoryRepository
    )
    {
        $this->_config = request('_config');
        $this->testRepository = $testRepository;
        $this->testCategoryRepository = $testCategoryRepository;
    }

    public function index()
    {
        $tests = $this->testRepository->all();

        return view($this->_config['view'])
            ->with(compact('tests'));
    }

    public function create()
    {
        $testCategories = $this->testCategoryRepository
            ->pluck('name', 'id')
            ->toArray();

        $testCategories = ['' => 'Select Category'] + $testCategories;

        return view($this->_config['view'])
            ->with(compact('testCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'test_category_id' => 'required',
            'duration' => 'required|numeric',
            'difficulty_level' => 'required',
            'total_question' => 'required|numeric',
            'total_mark' => 'required|numeric'
        ]);


        $test = $this->testRepository->create($request->input());
        if ($test) {
            session()->flash('success', 'Test was successfully created.');
            return redirect()->route($this->_config['redirect'], $test->id);
        } else {
            session()->flash('error', 'Test could not be created.');
        }
        return back();
    }

    public function edit(Test $test)
    {

        $testCategories = $this->testCategoryRepository
            ->pluck('name', 'id')
            ->toArray();

        $testCategories = ['' => 'Select Category'] + $testCategories;

        return view($this->_config['view'])
            ->with(compact('test', 'testCategories'));
    }


    public function update(Request $request, Test $test)
    {
        $updated = $test->update($request->input());
        if ($updated) {
            if ($request->ajax()) {
                return response()->json([
                    'data' => [
                        'message' => 'Test details was successfully updated'
                    ]
                ]);
            }
            session()->flash('success', 'Test was successfully updated');
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'error' => [
                        'message' => 'Test could not be updated.'
                    ]
                ]);
            }
            session()->flash('error', 'Test could not be updated.');
        }
        return back();
    }

    public function destroy(Test $test)
    {
        // if test is attached to any test sessions
        // do not delete the test.
        try {
            $test->delete();
            // delete the test questions
            // delete the test candidate group records
            // delete the test product records
            session()->flash('success', 'Test was successfully deleted.');
        } catch (\Exception $exception) {
            session()->flash('error', 'An error occurred trying to delete test. Please try again later.');
        }
        return back();
    }

    public function getStepTemplate(Request $request, Test $test)
    {
        $testCategories = $this->testCategoryRepository
            ->pluck('name', 'id')
            ->toArray();

        $testCategories = ['' => 'Select Category'] + $testCategories;

        $test_type = $request->query('test_step');
        $test_type = str_replace('-', '_', $test_type);

        if (!$test_type) {
            return '<p class="text-center"> Invalid Template Selected. </p>';
        }
        if (view()->exists("admin::admin.tests.templates.{$test_type}")) {
            return view("admin::admin.tests.templates.{$test_type}")
                ->with(compact('test', 'testCategories'));
        }
        return '<p class="text-center"> Invalid Template Selected. </p>';
    }

}
