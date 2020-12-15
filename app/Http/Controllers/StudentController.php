<?php


namespace App\Http\Controllers;


use App\Entities\Student;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\StudentRequest;
use App\Level;
use App\place;
use App\Repositories\StudentRepository;
use App\Repositories\CustomRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class StudentController extends Controller
{

    /**
     * @var StudentRepository
     */
    private $repo;
    /**
     * @var Student
     */
    private $student;

    public function __construct(Student $student)
    {
        $this->middleware(['auth', 'verified']);
        $this->repo = new StudentRepository($student);
        $this->student = $student;
    }


    public function index()
    {
        $students = Student::with('user')->orderBy('userid', 'desc')->paginate(12);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $places = place::all();
        $levels = Level::orderBy('name', 'asc')->get();
        return view('students.create', compact('places', 'levels'));


    }

    public function store(StudentRequest $request)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => ucwords(strtolower($request->name)),
                'email' => mb_strtolower($request->email),
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'type' => 2,
            ]);
            $secondaryid = $user->id;
            $img = (new CustomRepository())->upload($request);
            Student::create([
                'level' => ucwords(strtolower($request->level)),
                'state' => ucwords(strtolower($request->state)),
                'description' => ucwords(strtolower($request->description)),
                'imgpath' => $img,
                'address' => ucwords(strtolower($request->address)),
                'city' => ucwords(strtolower($request->city)),
                'gender' => ucwords(strtolower($request->gender)),
                'userid' => $secondaryid,
//                'verified' => 1,
                'active' => 1
            ]);
            DB::commit();
            return redirect()->route('students.index')->with('status', 'Student created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route('students.index')->with('status', 'Failed to create student.');

        }

    }


    public function update(StudentRequest $request, $id)
    {
        try {
            $students = $this->repo->getById($id);
            $user = $students->user;
            $attributes = $request->only([
                 'description', 'address','gender'
                , 'state',  'city', 'level'
            ]);
            if ($request->hasFile('image')) {
                $img = (new CustomRepository())->upload($request);
                $attributes['imgpath'] = $img;
            }
            DB::beginTransaction();
            $user->name = ucwords(strtolower($request->input('name')));
            $user->email = mb_strtolower($request->input('email'));
            $user->phone = ($request->input('phone'));
            $this->repo->update($id, $attributes);
            $user->save();
            DB::commit();
            return redirect()->route('students.index')->with('status', 'Student Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route('students.index')->with('status', 'Failed to update Data');

        }
    }

    public function edit($id)
    {
        $student = $this->repo->getById($id);
        $user = $student->user;
        $levels = Level::orderBy('name', 'asc')->get();
        return view('students.edit', compact('student', 'levels', 'user'));

    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $students = $this->repo->getById($id);
            $user = $students->user;
            $this->repo->delete($id);
            $user->delete();
            DB::commit();
            return redirect()->back()
                ->with('status', 'Student deleted Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('status', 'Failed to delete Student .');

        }
    }


    public function show()
    {

    }

    public function feature(Request $request, $id)
    {
        $students = $this->repo->getById($id);
        $students->is_featured = 1;
        $students->update();
        return redirect()->route('students.index')->with('status', 'Student is featured now');
    }
}
