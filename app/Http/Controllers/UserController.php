<?php

namespace App\Http\Controllers;

use App\Coaching;
use App\Courses;
use App\Level;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function coachingDashboard()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Coaching::where('userid', $id)->first();
        return view('coaching.dashboard', compact('user', 'data'));
    }
    public function teacherCourses()
    {
        $id = Auth::id();
        $courses = Courses::where('userid', $id);
        $user = User::findOrFail($id);
        $data = Teacher::where('userid', $id)->first();
        return view('teacher.courses', compact('user', 'data', 'courses'));
    }
    public function coachingCourses()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Coaching::where('userid', $id)->first();
        $courses = Courses::where('userid', $id)->get();
        return view('coaching.courses', compact('user', 'data', 'courses'));
    }
    public function addCourse(Request $request)
    {
        $id = Auth::id();
        $request->validate([
            'course' => 'required',
            'teacher' => 'required',
        ]);
        Courses::create([
            'course' => $request->course,
            'teacher' => ucwords(strtolower($request->teacher)),
            'userid' => $id,
        ]);
        return back()->with('status', 'Course Added successfully');
    }
    public function deleteCourse(Request $request, $id)
    {
        $course = Courses::findOrFail($id);
        $course->delete();
        return back()->with('status', 'Your data is deleted successfully');
    }
    public function teacherDashboard()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Teacher::where('userid', $id)->first();
        return view('teacher.dashboard', compact('user', 'data'));
    }
    public function studentDashboard()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Student::where('userid', $id)->first();
        return view('student.dashboard', compact('user', 'data'));
    }
    public function editCoaching()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Coaching::where('userid', $id)->first();
        return view('coaching.editcoaching', compact('user', 'data'));
    }
    public function editTeacher()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Teacher::where('userid', $id)->first();
        $levels = Level::all();
        return view('teacher.editteacher', compact('user', 'data', 'levels'));
    }
    public function editStudent()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Student::where('userid', $id)->first();
        return view('student.editstudent', compact('user', 'data'));
    }
    public function updateCoaching(Request $request)
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Coaching::where('userid', $id)->first();
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:10|min:10',
            'level' => 'required',
            'address1' => 'required|max:255',
            'address2' => 'required|max:255',
            'directorname' => 'required|max:255',
            'landmark' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
        ]);
        $user->name = $request->input('name');
        $user->update();
        $data->phone = $request->input('phone');
        $data->altphone = $request->input('altphone');
        $data->directorname = $request->input('directorname');
        $data->level = $request->input('level');
        $data->specialization = $request->input('specialization');
        $data->description = $request->input('description');
        $data->address1 = $request->input('address1');
        $data->address2 = $request->input('address2');
        $data->landmark = $request->input('landmark');
        $data->city = $request->input('city');
        $data->state = $request->input('state');
        $data->update();
        return redirect('/coachingdashboard')->with('status', 'Coaching data updated successfully');
    }
    public function updateTeacher(Request $request)
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Teacher::where('userid', $id)->first();
        $request->validate([
            'name' => 'required|max:255|min:3',
            'gender' => 'required|max:6|min:3',
            'phone' => 'required|regex:/[0-9]{10}/',
            'image' => 'mimes:jpeg,jpg',
            'specialization' => 'required|max:255|min:3',
            'level' => 'required',
            'state' => 'required|max:255|min:3',
            'city' => 'required|min:4',
        ]);
        if(($request->input('image')) != null){
            $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            $data->imgpath = $img;
        }
        $user->name = $request->input('name');
        $user->update();
        $data->phone = $request->input('phone');
        $data->altphone = $request->input('altphone');
        $data->level = $request->input('level');
        $data->specialization = $request->input('specialization');
        $data->description = $request->input('description');
        $data->city = $request->input('city');
        $data->state = $request->input('state');
        $data->update();
        return redirect('/teacherdashboard')->with('status', 'Coaching data updated successfully');
    }
    public function coachingRecommendation()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Student::where('userid', $id)->first();
        $state = $data->state;
        $coachings = Coaching::where('state', $state)->get();
        return view('student.coachingrecommendation', compact('coachings'));
    }
    public function teacherRecommendation()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Student::where('userid', $id)->first();
        $state = $data->state;
        $teachers = Teacher::where('state', $state)->get();
        return view('student.teacherrecommendation', compact('teachers'));
    }
    public function updateStudent(Request $request)
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $data = Student::where('userid', $id)->first();
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:10|min:10',
            'level' => 'required',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
        ]);
        $user->name = $request->input('name');
        $user->update();
        $data->phone = $request->input('phone');
        $data->level = $request->input('level');
        $data->description = $request->input('description');
        $data->city = $request->input('city');
        $data->state = $request->input('state');
        $data->update();
        return redirect('/studentdashboard')->with('status', 'Student data updated successfully');
    }
}
