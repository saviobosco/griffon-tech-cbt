<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'status'
    ];


    public function questions()
    {
        return $this->hasMany(Question::class, 'subject_id', 'id');
    }
}
