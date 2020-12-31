<?php


namespace GriffonTech\Admin\Repositories;


use GriffonTech\Admin\Contracts\Admin;
use GriffonTech\Core\Eloquent\Repository;

class AdminRepository extends Repository
{
    public function model()
    {
        return Admin::class;
    }
}
