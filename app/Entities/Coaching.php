<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Coaching extends Model
{
    protected $fillable = [
        'level',
        'userid',
        'directorname',
        'description',
        'eligibility',
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
    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'userid');
    }

}
