<?php


namespace GriffonTech\Test\Http\Controllers;


use GriffonTech\Test\Models\TestCategory;
use GriffonTech\Test\Repositories\TestCategoryRepository;
use Illuminate\Http\Request;

class TestCategoriesController extends Controller
{
    protected $_config;
    protected $testCategoryRepository;



    public function __construct(
        TestCategoryRepository $testCategoryRepository
    )
    {
        $this->_config = \request('_config');
        $this->testCategoryRepository = $testCategoryRepository;
    }

    public function index()
    {
        $testCategories = $this->testCategoryRepository->all();
        return view($this->_config['view'])
            ->with(compact('testCategories'));
    }

    public function create()
    {
        return view($this->_config['view']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);
        $testCategory = $this->testCategoryRepository
            ->create($request->input());

        if ($testCategory) {
            session()->flash('success', 'Test category was successfully added.');
        } else {
            session()->flash('error', 'Test category could not be added!.');
        }
        return back();
    }

    public function edit(TestCategory $testCategory)
    {
        return view($this->_config['view'])
            ->with(compact('testCategory'));
    }


    public function update(Request $request, TestCategory $testCategory)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $updated = $testCategory->update($request->input());
        if ($updated) {
            session()->flash('success', 'Test category was successfully updated.');
        } else {
            session()->flash('error', 'Test category could not be updated.');
        }
        return back();
    }


    public function destroy(TestCategory $testCategory)
    {

    }
}
