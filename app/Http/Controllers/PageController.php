<?php

namespace App\Http\Controllers;

use App\place;
use App\Query;
use App\Subscription;
use Illuminate\Http\Request;
use App\Teacher;
use App\Coaching;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $coachings = Coaching::all();
        $teachers = Teacher::all();
        return view('index', compact('teachers', 'coachings'));
    }
    public function coachings()
    {
        $coachings = Coaching::orderBy('id', 'desc')->paginate(20);
        return view('coachings', compact('coachings'));
    }
    public function teachers()
    {
        $teachers = Teacher::orderBy('id', 'desc')->paginate(20);
        return view('teachers', compact('teachers'));
    }
    public function contact()
    {
        return view('contact');
    }
    public function about()
    {
        return view('about');
    }
    public function coachingRegister()
    {
        $places = place::all();
        return view('coachingregister', compact('places'));
    }
    public function teacherRegister()
    {
        $places = place::all();
        return view('teacherregister', compact('places'));
    }
    public function subscribe(Request $request)
    {
        $request->validate([
            'subemail' => 'required|unique:subscriptions|max:255|email',
        ]);
        Subscription::create([
            'email' => mb_strtolower($request->subemail),
        ]);
        return redirect('/')->with('status', 'Subscribed Successfully');
    }
    public function sendQuery(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'message' => 'required|max:255|min:5',
            'subject' => 'required|max:50|min:3',
            'email' => 'required|max:255|email',
            'phone' => 'required|max:10|min:10',
        ]);
        Query::create([
            'name' => ucwords(strtolower($request->name)),
            'subject' => ucwords(strtolower($request->subject)),
            'email' => mb_strtolower($request->email),
            'message' => ucwords(strtolower($request->message)),
            'phone' => $request->phone,
        ]);
        return redirect('/contact')->with('status', 'Query has been sent successfully');
    }
    public function addCoachingUser(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'directorname' => 'required|max:255|min:2',
            'email' => 'required|unique:coachings|max:255|email',
            'phone' => 'required|regex:/[0-9]{10}/',
            'specialization' => 'required|max:255|min:3',
            'state' => 'required|max:255|min:4',
            'landmark' => 'required|max:255|min:4',
            'level' => 'required|max:255|min:4',
            'image' => 'required|mimes:jpeg,jpg,png',
            'address1' => 'required|max:255|min:4',
            'address2' => 'required|max:255|min:4',
            'city' => 'required|min:4',
        ]);
        $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        Coaching::create([
            'name' => ucwords(strtolower($request->name)),
            'directorname' => ucwords(strtolower($request->directorname)),
            'email' => mb_strtolower($request->email),
            'phone' => $request->phone,
            'altphone' => $request->altphone,
            'specialization' => ucwords(strtolower($request->specialization)),
            'level' => ucwords(strtolower($request->level)),
            'landmark' => ucwords(strtolower($request->landmark)),
            'state' => ucwords(strtolower($request->state)),
            'description' => ucwords(strtolower($request->description)),
            'imgpath' => $img,
            'address1' => ucwords(strtolower($request->address1)),
            'address2' => ucwords(strtolower($request->address2)),
            'city' => ucwords(strtolower($request->city)),
        ]);
        return redirect('/')->with('status', 'Coaching created successfully');
    }
    public function addTeacherUser(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:255|min:3',
            'lastname' => 'required|max:255|min:2',
            'email' => 'required|unique:teachers|max:255|email',
            'gender' => 'required|max:6|min:3',
            'phone' => 'required|regex:/[0-9]{10}/',
            'specialization' => 'required|max:255|min:3',
            'image' => 'required|mimes:jpeg,jpg,png',
            'level' => 'required|max:255|min:4',
            'state' => 'required|max:255|min:4',
            'city' => 'required|min:4',
        ]);
        $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        Teacher::create([
            'firstname' => ucwords(strtolower($request->firstname)),
            'lastname' => ucwords(strtolower($request->lastname)),
            'email' => mb_strtolower($request->email),
            'level' => ucwords(strtolower($request->level)),
            'gender' => ucwords(strtolower($request->gender)),
            'phone' => $request->phone,
            'altphone' => $request->altphone,
            'specialization' => ucwords(strtolower($request->specialization)),
            'description' => ucwords(strtolower($request->description)),
            'imgpath' => $img,
            'state' => ucwords(strtolower($request->state)),
            'city' => ucwords(strtolower($request->city)),
        ]);
        return redirect('/')->with('status', 'Teacher submitted successfully');
    }
}
