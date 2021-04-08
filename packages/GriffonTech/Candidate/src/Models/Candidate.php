<?php


namespace GriffonTech\Candidate\Models;


use GriffonTech\Candidate\Contracts\Candidate as CandidateContract;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Candidate extends Authenticatable implements CandidateContract
{
    protected $table = 'candidates';

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'enrolment_number',
        'mobile_no',
        'date_of_birth',
        'address',
        'country',
        'state',
        'city',
        'zip_code',
        'candidate_group_id'
    ];

}
