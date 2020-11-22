<?php

namespace App\Http\Controllers;

use App\Coaching;
use App\Courses;
use App\Event;
use App\Level;
use App\place;
use App\Query;
use App\Student;
use App\Subscription;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $user = User::where('type', 1)->get();
        $teacheruser = User::where('type', 0)->get();
        $coachings = Coaching::all();
        $eventcount = Event::count();
        $event = Event::all();
        $teachers = Teacher::all();
        return view('index', compact('user', 'teachers', 'coachings', 'teacheruser', 'eventcount', 'event'));
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function coachings(Request $request)
    {
        $user = User::where('type', 1)->orderBy('id', 'desc')->paginate(3);
        $coachings = Coaching::orderBy('userid', 'desc')->paginate(3);
        if ($request->ajax()) {
            $view = view('data')->with(compact('user', 'coachings'))->render();
            return response()->json(['html' => $view]);
        }
        return view('coachings', compact('coachings', 'user'));
    }

    public function teachers()
    {
        $teacheruser = User::where('type', 0)->orderBy('id', 'desc')->paginate(20);
        $teachers = Teacher::orderBy('userid', 'desc')->paginate(20);
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

    public function coachingRegister()
    {
        $level = Level::all();
        $places = place::all();
        return view('coachingregister', compact('places', 'level'));
    }

    public function featureCoachings()
    {
        $places = place::all();
        return view('coachingregister', compact('places'));
    }

    public function teacherRegister()
    {
        $level = Level::all();
        $places = place::all();
        return view('teacherregister', compact('places', 'level'));
    }

    public function featureTeachers()
    {
        $places = place::all();
        return view('teacherregister', compact('places'));
    }

    public function studentRegister()
    {
        $level = Level::all();
        $places = place::all();
        return view('studentregister', compact('places', 'level'));
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
            'password' => 'required|confirmed',
            'directorname' => 'required|max:255|min:2',
            'email' => 'required|unique:users|max:255|email',
            'phone' => 'required|regex:/[0-9]{10}/',
            'specialization' => 'required|max:255|min:3',
            'state' => 'required|max:255|min:4',
            'landmark' => 'required|max:255|min:4',
            'level' => 'required|max:255',
            'image' => 'required|mimes:jpeg,jpg,png',
            'address1' => 'required|max:255|min:4',
            'address2' => 'required|max:255|min:4',
            'city' => 'required|min:4',
        ]);
        $user = User::create([
            'name' => ucwords(strtolower($request->name)),
            'email' => mb_strtolower($request->email),
            'password' => bcrypt($request->password),
            'type' => 1,
        ]);
        $secondaryid = $user->id;
        $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        Coaching::create([
            'name' => ucwords(strtolower($request->name)),
            'directorname' => ucwords(strtolower($request->directorname)),
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
            'userid' => $secondaryid,
        ]);
        return redirect('/welcome')->with('status', 'Coaching created successfully');
    }

    public function addTeacherUser(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'password' => 'required|confirmed',
            'email' => 'required|unique:users|max:255|email',
            'gender' => 'required|max:6|min:3',
            'phone' => 'required|regex:/[0-9]{10}/',
            'specialization' => 'required|max:255|min:3',
            'image' => 'required|mimes:jpeg,jpg,png',
            'level' => 'required|max:255',
            'state' => 'required|max:255|min:4',
            'city' => 'required|min:4',
        ]);
        $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        $user = User::create([
            'name' => ucwords(strtolower($request->name)),
            'email' => mb_strtolower($request->email),
            'password' => bcrypt($request->password),
            'type' => 0,
        ]);
        Teacher::create([
            'userid' => $user->id,
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
        return redirect('/welcome')->with('status', 'Teacher submitted successfully');
    }

    public function addStudentUser(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'password' => 'required|confirmed',
            'email' => 'required|unique:users|max:255|email',
            'gender' => 'required|max:6|min:3',
            'phone' => 'required|regex:/[0-9]{10}/',
            'image' => 'required|mimes:jpeg,jpg,png',
            'level' => 'required|max:255',
            'state' => 'required|max:255|min:4',
            'city' => 'required|min:4',
        ]);
        $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        $user = User::create([
            'name' => ucwords(strtolower($request->name)),
            'email' => mb_strtolower($request->email),
            'password' => bcrypt($request->password),
            'type' => 2,
        ]);
        Student::create([
            'userid' => $user->id,
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
        return redirect('/welcome')->with('status', 'Student data submitted successfully');
    }
}
