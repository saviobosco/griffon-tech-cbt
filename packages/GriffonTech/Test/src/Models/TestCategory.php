<?php


namespace GriffonTech\Test\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Test\Contracts\TestCategory as TestCategoryContract;

class TestCategory extends Model implements TestCategoryContract
{
    protected $table = 'test_categories';

    protected $fillable = [
        'name',
        'description'
    ];

    public function test()
    {

    }

}
