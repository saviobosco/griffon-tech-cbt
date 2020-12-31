<?php


namespace GriffonTech\Test\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\Test\Contracts\Test;

class TestRepository extends Repository
{

    public function model()
    {
        return Test::class;
    }

    public function create(array $attributes)
    {
        $attributes['unique_code'] = $this->generateTestUniqueCode();
        return parent::create($attributes);
    }


    private function generateTestUniqueCode()
    {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shufle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),
            0, 7);
    }
}
