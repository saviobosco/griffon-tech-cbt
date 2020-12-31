<?php


namespace GriffonTech\Candidate\Models;


use Illuminate\Database\Eloquent\Model;
use GriffonTech\Candidate\Contracts\Group as GroupContract;
class Group extends Model implements GroupContract
{
    protected $table = 'candidate_groups';

    protected $fillable = [
        'name'
    ];
}
