<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $fillable = [
        'course',
        'teacher',
        'userid',
    ];


    public function course()
    {
        return $this->belongsTo(User::class, 'userid');
    }
}
