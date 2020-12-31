<?php


namespace GriffonTech\Admin\Models;
use Illuminate\Notifications\Notifiable;
use GriffonTech\Admin\Contracts\Admin as AdminContract;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements AdminContract
{
    use Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
    ];

}
