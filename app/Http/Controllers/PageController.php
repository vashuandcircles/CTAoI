<?php

namespace App\Http\Controllers;

use App\Coaching;
use App\Courses;
use App\Entities\Student;
use App\Event;
use App\Level;
use App\place;
use App\Query;
use App\Subscription;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $event = $event->sortBy('priority');
        $teachers = Teacher::with('user')->get();
        return view('index', compact('user', 'teachers', 'coachings', 'teacheruser', 'eventcount', 'event', 'coachingscount', 'teacherscount'));
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function coachings(Request $request)
    {
        $user = User::where('type', 1)->orderBy('id', 'desc')->paginate(15);
        $coachings = Coaching::orderBy('userid', 'desc')->paginate(15);
        if ($request->ajax()) {
            $view = view('data')->with(compact('user', 'coachings'))->render();
            return response()->json(['html' => $view]);
        }
        return view('coachings', compact('coachings', 'user'));
    }

    public function teachers()
    {
//        $teacheruser = User::where('type', 0)->orderBy('id', 'desc')->paginate(20);
        $teachers = Teacher::with('user')->paginate(12);
        return view('teachers', compact('teachers'));
    }

    public function students()
    {
//        $teacheruser = User::where('type', 0)->orderBy('id', 'desc')->paginate(20);
//        $teachers = Teacher::orderBy('userid', 'desc')->paginate(20);
        $students = Student::with('user')->paginate(12);
        return view('students', compact('students'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function coachingpayment()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Coaching::where('userid', $id)->first();
        return view('coaching.payment', compact('user', 'data'));
    }

    public function teacherpayment()
    {
        $id = Auth::id();
        $courses = Courses::where('userid', $id);
        $user = User::findOrFail($id);
        $data = Teacher::where('userid', $id)->first();
        return view('teacher.payment', compact('user', 'data', 'courses'));
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
        if ($data->is_featured)
            return view('coachingdetail', compact('user', 'data', 'course'));
        else
            abort(401);

    }

    public function teacherDetail(Request $request, $id)
    {
        $data = Teacher::with('user')->whereId($id)->first();
        $course = Courses::where('userid', $id)->get();
//        if ($data->is_featured)
            return view('teacherdetail', compact('data', 'course'));
//        else {
//            abort(401);
//        }
    }

    public function studentDetail(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $course = Courses::where('userid', $id)->get();
        return view('studentdetail', compact('student', 'course'));
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
