<?php

namespace App\Http\Controllers;

use App\Coaching;
use App\Query;
use App\Subscription;
use App\Event;
use App\Mail\ApprovedMail;
use App\place;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $registeredcoaching = Coaching::where('verified', 'LIKE', '1')->count();
        $pendingcoaching = Coaching::where('verified', 'LIKE', '0')->count();
        $featuredcoaching = Coaching::where('is_featured', 'LIKE', '1')->count();
        $registeredteacher = Teacher::where('verified', 'LIKE', '1')->count();
        $featuredteacher = Teacher::where('is_featured', 'LIKE', '1')->count();
        $pendingteacher = Teacher::where('verified', 'LIKE', '0')->count();
        $subscriptions = Subscription::all()->count();
        $enquiry = Query::all()->count();
        return view('admin.dashboard', compact('registeredcoaching','featuredcoaching', 'pendingcoaching', 'registeredteacher', 'featuredteacher', 'pendingteacher', 'subscriptions', 'enquiry'));
    }
    public function event()
    {
        $queries = Event::all();
        return view('admin/event/events', compact('queries'));
    }
    public function addEventPage()
    {
        return view('admin/event/addeventpage');
    }
    public function teacherPage()
    {
        $teachers = Teacher::orderBy('id', 'desc')->paginate(25);
        return view('admin/teacher/teacherpage', compact('teachers'));
    }
    public function addEvent(Request $request)
    {
        $request->validate([
            'date' => 'required|max:255|min:3',
            'starttime' => 'required|max:255|min:2',
            'endtime' => 'required|max:255|email',
            'smalldesc' => 'required|max:6|min:3',
            'priority' => 'required|regex:/[0-9]{10}/',
            'image' => 'required|mimes:jpeg,jpg,png', 
        ]);
        $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        Teacher::create([
            'firstname' => ucwords(strtolower($request->firstname)),
            'lastname' => ucwords(strtolower($request->lastname)),
            'email' => mb_strtolower($request->email),
            'gender' => ucwords(strtolower($request->gender)),
            'phone' => $request->phone,
            'level' => ucwords(strtolower($request->level)),
            'altphone' => $request->altphone,
            'specialization' => $request->specialization,
            'description' => ucwords(strtolower($request->description)),
            'imgpath' => $img,
            'state' => ucwords(strtolower($request->state)),
            'city' => ucwords(strtolower($request->city)),
            'verified' => 1,
        ]);
        return redirect('/teacher-page')->with('status', 'Teacher created successfully');
    }
    public function coachingPage()
    {
        $coachings = Coaching::orderBy('id', 'desc')->paginate(25);
        return view('admin/coaching/coachingpage', compact('coachings'));
    }
    public function featuredTeacherPage()
    {
        $teachers = Teacher::all();
        return view('admin/teacher/featuredteachers', compact('teachers'));
    }
    public function featuredCoachingPage()
    {
        $coachings = Coaching::all();
        return view('admin/coaching/featuredcoachings', compact('coachings'));
    }
    public function teacherRequestPage()
    {
        $teachers = Teacher::all();
        return view('admin/teacher/teacherrequest', compact('teachers'));
    }
    public function coachingRequestPage()
    {
        $coachings = Coaching::all();
        return view('admin/coaching/coachingrequest', compact('coachings'));
    }
    public function addTeacherPage()
    {
        $places = place::all();
        return view('admin/teacher/addteacherpage', compact('places'));
    }
    public function addCoachingPage()
    {
        $places = place::all();
        return view('admin/coaching/addcoachingpage', compact('places'));
    }
    public function addTeacher(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:255|min:3',
            'lastname' => 'required|max:255|min:2',
            'email' => 'required|max:255|email',
            'gender' => 'required|max:6|min:3',
            'phone' => 'required|regex:/[0-9]{10}/',
            'specialization' => 'required|max:255|min:3',
            'image' => 'required|mimes:jpeg,jpg,png',
            'state' => 'required|max:255|min:4',
            'city' => 'required|min:4',
        ]);
        $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        Teacher::create([
            'firstname' => ucwords(strtolower($request->firstname)),
            'lastname' => ucwords(strtolower($request->lastname)),
            'email' => mb_strtolower($request->email),
            'gender' => ucwords(strtolower($request->gender)),
            'phone' => $request->phone,
            'level' => ucwords(strtolower($request->level)),
            'altphone' => $request->altphone,
            'specialization' => $request->specialization,
            'description' => ucwords(strtolower($request->description)),
            'imgpath' => $img,
            'state' => ucwords(strtolower($request->state)),
            'city' => ucwords(strtolower($request->city)),
            'verified' => 1,
        ]);
        return redirect('/teacher-page')->with('status', 'Teacher created successfully');
    }
    public function addCoaching(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'directorname' => 'required|max:255|min:2',
            'email' => 'required|max:255|email',
            'phone' => 'required|regex:/[0-9]{10}/',
            'specialization' => 'required|max:255|min:3',
            'state' => 'required|max:255|min:4',
            'image' => 'required|mimes:jpeg,jpg,png', 
            'address1' => 'required|max:255|min:4',
            'city' => 'required|min:4',
        ]);
        $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        Coaching::create([
            'name' => ucwords(strtolower($request->name)),
            'directorname' => ucwords(strtolower($request->directorname)),
            'email' => mb_strtolower($request->email),
            'phone' => $request->phone,
            'level' => ucwords(strtolower($request->level)),
            'altphone' => $request->altphone,
            'specialization' => $request->specialization,
            'landmark' => ucwords(strtolower($request->landmark)),
            'state' => ucwords(strtolower($request->state)),
            'description' => ucwords(strtolower($request->description)),
            'imgpath' => $img,
            'address1' => ucwords(strtolower($request->address1)),
            'address2' => ucwords(strtolower($request->address2)),
            'city' => ucwords(strtolower($request->city)),
            'verified' => 1,
        ]);
        return redirect('/coaching-page')->with('status', 'Coaching created successfully');
    }
    public function editTeacherPage(Request $request, $id)
    {
        $teachers = Teacher::findOrFail($id);
        return view('admin.teacher.editteacherpage', compact('teachers'));
    }
    public function editCoachingPage(Request $request, $id)
    {
        $coachings = Coaching::findOrFail($id);
        return view('admin.coaching.editcoachingpage', compact('coachings'));
    }
    public function updateTeacher(Request $request, $id)
    {
        $teachers = Teacher::find($id);
        $request->validate([
            'firstname' => 'required|max:255|min:3',
            'lastname' => 'required|max:255|min:2',
            'email' => 'required|max:255|email',
            'gender' => 'required|max:6|min:3',
            'phone' => 'required|regex:/[0-9]{10}/',
            'specialization' => 'required|max:255|min:3',
            'state' => 'required|max:255|min:3',
            'address' => 'required|max:255|min:4',
            'city' => 'required|min:4',
        ]);
        $teachers->firstname = ucwords(strtolower($request->input('firstname')));
        $teachers->lastname = ucwords(strtolower($request->input('lastname')));
        $teachers->email = mb_strtolower($request->input('email'));
        $teachers->gender = ucwords(strtolower($request->input('gender')));
        $teachers->description = ucwords(strtolower($request->input('description')));
        $teachers->phone = $request->input('phone');
        $teachers->altphone = $request->input('altphone');
        $teachers->specialization = $request->input('specialization');
        $teachers->address = ucwords(strtolower($request->input('address')));
        $teachers->state = ucwords(strtolower($request->input('state')));
        $teachers->city = ucwords(strtolower($request->input('city')));
        $teachers->update();
        return redirect('/teacher-page')->with('status', 'Your data is updated');
    }
    public function updateCoaching(Request $request, $id)
    {
        $coachings = Coaching::find($id);
        $request->validate([
            'name' => 'required|max:255|min:3',
            'directorname' => 'required|max:255|min:2',
            'email' => 'required|max:255|email',
            'phone' => 'required|regex:/[0-9]{10}/',
            'specialization' => 'required|max:255|min:3',
            'address1' => 'required|max:255|min:4',
            'state' => 'required|max:255|min:4',
            'city' => 'required|min:4',
        ]);
        $coachings->name = ucwords(strtolower($request->input('name')));
        $coachings->directorname = ucwords(strtolower($request->input('directorname')));
        $coachings->email = mb_strtolower($request->input('email'));
        $coachings->description = ucwords(strtolower($request->input('description')));
        $coachings->phone = $request->input('phone');
        $coachings->altphone = $request->input('altphone');
        $coachings->specialization = $request->input('specialization');
        $coachings->address2 = ucwords(strtolower($request->input('address2')));
        $coachings->address1 = ucwords(strtolower($request->input('address1')));
        $coachings->state = ucwords(strtolower($request->input('state')));
        $coachings->landmark = ucwords(strtolower($request->input('landmark')));
        $coachings->city = ucwords(strtolower($request->input('city')));
        $coachings->update();
        return redirect('/coaching-page')->with('status', 'Your data is updated');
    }
    public function deleteTeacher(Request $request, $id)
    {
        $teachers = Teacher::findOrFail($id);
        $teachers->delete();
        return redirect('/teacher-page')->with('status', 'Your data is deleted successfully');
    }
    public function deleteCoaching(Request $request, $id)
    {
        $coachings = Coaching::findOrFail($id);
        $coachings->delete();
        return redirect('/coaching-page')->with('status', 'Your data is deleted successfully');
    }
    public function featureTeacher(Request $request, $id)
    {
        $teachers = Teacher::findOrFail($id);
        $teachers->is_featured = 1;
        $teachers->update();
        return redirect('/teacher-page')->with('status', 'Teacher is featured now');
    }
    public function featureCoaching(Request $request, $id)
    {
        $coachings = Coaching::findOrFail($id);
        $coachings->is_featured = 1;
        $coachings->update();
        return redirect('/coaching-page')->with('status', 'Coaching is featured now');
    }
    public function unfeatureTeacher(Request $request, $id)
    {
        $teachers = Teacher::findOrFail($id);
        $teachers->is_featured = 0;
        $teachers->update();
        return redirect('/featured-teacher-page')->with('status', 'Teacher is unfeatured now');
    }
    public function unfeatureCoaching(Request $request, $id)
    {
        $coachings = Coaching::findOrFail($id);
        $coachings->is_featured = 0;
        $coachings->update();
        return redirect('/featured-coaching-page')->with('status', 'Teacher is unfeatured now');
    }
    public function subscription()
    {
        $subscriptions = Subscription::all();
        return view('admin/subscription', compact('subscriptions'));
    }
    public function enquiry()
    {
        $queries = Query::all();
        return view('admin/query', compact('queries'));
    }
    public function acceptTeacher(Request $request, $id)
    {
        $teachers = Teacher::findOrFail($id);
        $data = ['name' => $teachers->firstname];
        $tomail = $teachers->email;
        Mail::to($tomail)->send(new ApprovedMail($data));
        $teachers->verified = 1;
        $teachers->update();
        return redirect('/teacher-request')->with('status', 'Teacher is verified now');
    }
    public function acceptCoaching(Request $request, $id)
    {
        $coachings = Coaching::findOrFail($id);
        $tomail = $coachings->email;
        $data = ['name' => $coachings->name];
        Mail::to($tomail)->send(new ApprovedMail($data));
        $coachings->verified = 1;
        $coachings->update();
        $data = $coachings->directorname;
        return redirect('/coaching-request')->with('status', 'Coaching is verified now');
    }
}
