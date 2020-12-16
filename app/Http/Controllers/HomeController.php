<?php

namespace App\Http\Controllers;

use App\Entities\Coaching;
use App\Entities\Teacher;
use App\Event;
use App\Level;
use App\place;
use App\Query;
use App\Repositories\CustomRepository;
use App\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
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
        return view('admin.dashboard', compact('registeredcoaching', 'featuredcoaching', 'pendingcoaching', 'registeredteacher', 'featuredteacher', 'pendingteacher', 'subscriptions', 'enquiry'));
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
        Event::create([
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

    public function level()
    {
        $levels = Level::orderBy('name', 'asc')->get();
        return view('admin/level/levels', compact('levels'));
    }

    public function addLevelPage()
    {
        return view('admin/level/addlevelpage');
    }

    public function addLevel(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        Level::create([
            'name' => $request->name,
        ]);
        return redirect('/level')->with('status', 'Level created successfully');
    }

    public function deleteLevel(Request $request, $id)
    {
        $level = Level::findOrFail($id);
        $level->delete();
        return redirect('/level')->with('status', 'Your data is deleted successfully');
    }

    public function teacherPage()
    {
        $user = User::where('type', 0)->orderBy('id', 'desc')->paginate(10);
        $teachers = Teacher::orderBy('userid', 'asc')->paginate(10);
        return view('admin/teacher/teacherpage', compact('teachers', 'user'));
    }

    public function coachingPage()
    {
        $user = User::where('type', 1)->orderBy('id', 'desc')->paginate(10);
        $coachings = Coaching::orderBy('userid', 'desc')->paginate(10);
        return view('admin/coaching/coachingpage', compact('coachings', 'user'));
    }

    public function featuredTeacherPage()
    {
        $teachers = Teacher::with('user')->get();
        return view('admin/teacher/featuredteachers', compact('teachers'));
    }

    public function featuredCoachingPage()
    {
        $coachings = Coaching::with('user')->get();
        return view('admin/coaching/featuredcoachings', compact('coachings'));
    }

    public function teacherRequestPage()
    {
        $user = User::where('type', 0)->get();
        $teachers = Teacher::all();
        return view('admin/teacher/teacherrequest', compact('teachers', 'user'));
    }

    public function coachingRequestPage()
    {
        $user = User::where('type', 1)->get();
        $coachings = Coaching::all();
        return view('admin/coaching/coachingrequest', compact('coachings', 'user'));
    }

    public function addTeacherPage()
    {
        $places = place::all();
        $levels = Level::orderBy('name', 'asc')->get();
        return view('admin/teacher/addteacherpage', compact('places', 'levels'));
    }

    public function addCoachingPage()
    {
        $places = place::all();
        $levels = Level::orderBy('name', 'asc')->get();
        return view('admin/coaching/addcoachingpage', compact('places', 'levels'));
    }

    public function addTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|min:3',
            'password' => 'required|confirmed',
            'email' => 'required|unique:users|max:255|email',
            'gender' => 'required|max:6|min:3',
            'phone' => 'required|regex:/[0-9]{10}/|unique:users',
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
            'verified' => 1,
        ]);
        return redirect('/teacher-page')->with('status', 'Teacher created successfully');
    }

    public function addCoaching(Request $request)
    {
        $request->validate([
            'name' => 'max:255|min:3',
            'directorname' => 'max:255|min:2',
            'email' => 'unique:users|max:255|email',
            'phone' => 'regex:/[0-9]{10}/|unique:users',
            'specialization' => 'max:255|min:3',
            'state' => 'max:255|min:4',
            'landmark' => 'max:255|min:4',
            'level' => 'max:255',
            'image' => 'required|mimes:jpeg,jpg,png',
            'address1' => 'max:255|min:4',
            'address2' => 'max:255|min:4',
            'city' => 'min:4',
        ]);
        $user = User::create([
            'name' => ucwords(strtolower($request->name)),
            'email' => mb_strtolower($request->email),
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'type' => 1,
        ]);
        $secondaryid = $user->id;
        $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        Coaching::create([
            'name' => ucwords(strtolower($request->name)),
            'directorname' => ucwords(strtolower($request->directorname)),
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
            'verified' => 1,
        ]);
        return redirect('/coaching-page')->with('status', 'Coaching created successfully');
    }

    public function editTeacherPage(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $teachers = Teacher::where('userid', $id)->first();
        $levels = Level::orderBy('name', 'asc')->get();
        return view('admin.teacher.editteacherpage', compact('teachers', 'levels', 'user'));
    }

    public function editCoachingPage(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $coachings = Coaching::where('userid', $id)->first();
        $levels = Level::orderBy('name', 'asc')->get();
        return view('admin.coaching.editcoachingpage', compact('coachings', 'levels', 'user'));
    }

    public function updateTeacher(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = Teacher::where('userid', $id)->first();
        $request->validate([
            'name' => 'required|max:255|min:3',
            'email' => 'required|max:255|email|unique:users',
            'gender' => 'required|max:6|min:3',
            'phone' => 'required|regex:/[0-9]{10}/|unique:users',
            'image' => 'required|mimes:jpeg,jpg',
            'state' => 'required|max:255|min:3',
            'city' => 'required|min:4',
        ]);

        if (($request->input('image')) != null) {
//            $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
//            $data->imgpath = $img;
            $img = (new CustomRepository())->upload($request);
            $data->imgpath = $img;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->update();
        $data->altphone = $request->input('altphone');
        $data->level = $request->input('level');
        $data->specialization = $request->input('specialization');
        $data->description = $request->input('description');
        $data->city = $request->input('city');
        $data->state = $request->input('state');
        $data->update();
        return redirect('/teacher-page')->with('status', 'Your data is updated');
    }

    public function updateCoaching(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $coachings = Coaching::where('userid', $id)->first();
        $request->validate([
            'name' => 'required|max:255|min:3',
            'directorname' => 'required|max:255|min:2',
            'email' => 'required|max:255|email|unique:users',
            'phone' => 'required|regex:/[0-9]{10}/',
            'image' => 'mimes:jpeg,jpg',
            'specialization' => 'required|max:255|min:3|unique:users',
            'address1' => 'required|max:255|min:4',
            'state' => 'required|max:255|min:4',
            'city' => 'required|min:4',
        ]);
        if (($request->input('image')) != null) {
            $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            $coachings->imgpath = $img;
        }
        $data->name = ucwords(strtolower($request->input('name')));
        $data->email = mb_strtolower($request->input('email'));
        $coachings->directorname = ucwords(strtolower($request->input('directorname')));
        $coachings->description = ucwords(strtolower($request->input('description')));
        $data->phone = $request->input('phone');
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
        $user = User::findOrFail($id);
        $teachers = Teacher::where('userid', $id)->first();
        $user->delete();
        $teachers->delete();
        return back()->with('status', 'Your data is deleted successfully');
    }

    public function deleteCoaching(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $coachings = Coaching::where('userid', $id)->first();
        $coachings->delete();
        $user->delete();
        return back()->with('status', 'Your data is deleted successfully');
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
//        $teachers = Teacher::findOrFail($id);
//        $teachers->verified = 1;
//        $teachers->update();
//        return redirect('/teacher-request')->with('status', 'Teacher is verified now');

        try {
            $teachers = Teacher::where('userid', $id)->first();
            $teachers->verified = 1;
            $teachers->update();
            return redirect('/teacher-request')->with('status', 'Teacher is verified now');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect('/teacher-request')->with('status', ' Failed to varify Teacher');
        }
    }

    public function acceptCoaching(Request $request, $id)
    {
        try {
            $coachings = Coaching::where('userid', $id)->first();
            $coachings->verified = 1;
            $coachings->update();
//            $data = $coachings->directorname;
            return redirect('/coaching-request')->with('status', 'Coaching is verified now');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect('/coaching-request')->with('status', 'Failed to varify Coaching');

        }

    }
}
