<?php


namespace GriffonTech\User\Repositories;


use GriffonTech\Core\Eloquent\Repository;
use GriffonTech\User\Contracts\User;

class UserRepository extends Repository
{
    public function model()
    {
        return User::class;
    }

}
