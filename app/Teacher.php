<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'level',
        'userid',
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
    public function user()
    {
        return $this->belongsTo(User::class,'userid');
    }
}
