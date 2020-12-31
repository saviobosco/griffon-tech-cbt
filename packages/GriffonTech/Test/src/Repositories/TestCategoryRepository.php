<?php


namespace GriffonTech\Test\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Test\Contracts\TestCategory;

class TestCategoryRepository extends Repository
{
    public function model()
    {
        return TestCategory::class;
    }

}
