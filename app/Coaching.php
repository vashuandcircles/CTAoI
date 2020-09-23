<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coaching extends Model
{
    protected $fillable = [
        'name',
        'level',
        'directorname',
        'email',
        'description',
        'phone',
        'imgpath',
        'altphone',
        'specialization',
        'address1',
        'address2',
        'state',
        'landmark',
        'city',
        'is_featured',
        'active',
        'verified'
    ];
}
