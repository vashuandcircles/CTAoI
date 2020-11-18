<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'level',
        'userid',
        'description',
        'phone',
        'imgpath',
        'gender',
        'city',
        'active',
        'verified',
        'state',
    ];
}
