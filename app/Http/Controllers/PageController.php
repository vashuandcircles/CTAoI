<?php

namespace App\Http\Controllers;

use App\Query;
use App\Subscription;
use Illuminate\Http\Request;
use App\Teacher;
use App\Coaching;
use App\Courses;
use App\Event;
use App\User;

class PageController extends Controller
{
    public function index()
    {
        $user = User::where('type', 1)->get();
        $teacheruser = User::where('type', 0)->get();
        $coachings = Coaching::all();
        $coachingscount = Coaching::where('verified', 1)->where('is_featured', 1)->count();
        $teacherscount = Teacher::where('verified', 1)->where('is_featured', 1)->count();
        $eventcount = Event::count();
        $event = Event::all();
        $teachers = Teacher::all();
        return view('index', compact('user', 'teachers', 'coachings', 'teacheruser', 'eventcount', 'event', 'coachingscount', 'teacherscount'));
    }
    public function coachings()
    {
        $user = User::where('type', 1)->orderBy('id', 'desc')->paginate(23);
        $coachings = Coaching::orderBy('userid', 'desc')->paginate(23);
        return view('coachings', compact('coachings', 'user'));
    }
    public function teachers()
    {
        $teacheruser = User::where('type', 0)->orderBy('id', 'desc')->paginate(23);
        $teachers = Teacher::orderBy('userid', 'desc')->paginate(23);
        return view('teachers', compact('teachers', 'teacheruser'));
    }
    public function contact()
    {
        return view('contact');
    }
    public function about()
    {
        return view('about');
    }
    public function coachingDetail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = Coaching::where('userid', $id)->first();
        $course = Courses::where('userid', $id)->get();
        return view('coachingdetail', compact('user', 'data', 'course'));
    }
    public function teacherDetail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = Teacher::where('userid', $id)->first();
        $course = Courses::where('userid', $id)->get();
        return view('teacherdetail', compact('user', 'data', 'course'));
    }
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:subscriptions|max:255|email',
        ]);
        Subscription::create([
            'email' => mb_strtolower($request->email),
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
}
