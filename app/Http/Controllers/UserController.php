<?php

namespace App\Http\Controllers;

use App\Coaching;
use App\Courses;
use App\Level;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $levels = Level::all();
        return view('coaching.editcoaching', compact('user', 'data', 'levels'));
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
        $levels = Level::all();
        return view('student.editstudent', compact('user', 'data', 'levels'));
    }

    public function updateCoaching(Request $request)
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $coachings = Coaching::where('userid', $id)->first();
//        dd($coachings,$request->all());
        $request->validate([
            'name' => 'required|max:255|min:3',
            'directorname' => 'required|max:255|min:2',
            'phone' => 'required|regex:/[0-9]{10}/',
            'altphone' => 'nullable|regex:/[0-9]{10}/',
            'specialization' => 'required|max:255|min:3',
            'state' => 'max:255|min:4',
            'landmark' => 'max:255|min:4',
            'description' => 'nullable|max:255',
            'level' => 'max:255',
            'image' => 'required|mimes:jpeg,jpg,png',
            'address1' => 'required|max:255|min:4',
            'address2' => 'nullable|max:255',
            'city' => 'required|min:4',
        ]);
        try {
            if ($request->hasFile('image')) {
                $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
                $coachings->imgpath = $img;
            }
            DB::beginTransaction();
            $user->name = ucwords(strtolower($request->input('name')));
            $user->email = mb_strtolower($request->input('email'));
            $user->phone = ($request->input('phone'));
            $user->save();
            $attributes = $request->only([
                'directorname', 'description', 'altphone', 'specialization', 'address2', 'address1'
                , 'state', 'landmark', 'city', 'level'
            ]);
            $coachings->update($attributes);
            DB::commit();
            return redirect()->route('coachingdashboard')->with('status', 'Coaching Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route('coachingdashboard')->with('status', 'Failed to update Data');

        }

    }

    public function updateTeacher(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255|min:3',
            'gender' => 'required|max:6|min:3',
            'phone' => 'required|regex:/[0-9]{10}/',
            'image' => 'required|mimes:jpeg,jpg,png',
            'specialization' => 'required|max:255|min:3',
            'level' => 'required',
            'state' => 'required|max:255|min:3',
            'city' => 'required|min:4',
        ]);
        try {
            $id = Auth::id();
            $user = User::findOrFail($id);
            $data = Teacher::where('userid', $id)->first();
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
                $data->imgpath = $img;
            }
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->update();
            $data->altphone = $request->input('altphone');
            $data->gender = $request->input('gender');
            $data->level = $request->input('level');
            $data->specialization = $request->input('specialization');
            $data->description = $request->input('description');
            $data->city = $request->input('city');
            $data->state = $request->input('state');
            $data->update();
            DB::commit();
            return redirect('/teacherdashboard')->with('status', 'Coaching data updated successfully');

        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            return redirect('/teacherdashboard')->with('status', 'Failed to update teacher');

        }

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

        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:10|min:10',
            'level' => 'required',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
        ]);
        try {
            DB::beginTransaction();
            $id = Auth::id();
            $user = User::findOrFail($id);
            $data = Student::where('userid', $id)->first();
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->update();
            $data->gender = $request->input('gender');
            $data->level = $request->input('level');
            $data->description = $request->input('description');
            $data->city = $request->input('city');
            $data->state = $request->input('state');
            $data->update();
            DB::commit();
            return redirect('/studentdashboard')->with('status', 'Student data updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect('/studentdashboard')->with('status', 'failed to update student');

        }

    }
}
