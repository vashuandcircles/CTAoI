<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Coaching;
use App\Teacher;
use App\Student;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => ['required', 'numeric', 'unique:users', 'regex:/[0-9]{10}/'],
            'type' => 'required',
        ]);
    }
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'type' => $data['type'],
            'password' => Hash::make($data['password']),
        ]);
        if($data['type'] == 0){
            Teacher::create([
                'userid' => $user->id,
            ]);
        }
        elseif($data['type'] == 1){
            Coaching::create([
                'userid' => $user->id,
            ]);
        }
        elseif($data['type'] == 2){
            Student::create([
                'userid' => $user->id,
            ]);
        }
        return $user;
    }
}
