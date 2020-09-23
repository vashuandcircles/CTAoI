<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'level',
        'email',
        'description',
        'phone',
        'imgpath',
        'gender',
        'altphone',
        'specialization',
        'state',
        'city',
        'is_featured',
        'active',
        'verified'
    ];
}
