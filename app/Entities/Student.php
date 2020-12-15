<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'level',
        'userid',
        'description',
        'imgpath',
        'gender',
        'city',
        'active',
        'address',
        'verified',
        'state',
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

}
