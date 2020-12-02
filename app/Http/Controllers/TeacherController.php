<?php


namespace App\Http\Controllers;


use App\Entities\Teacher;
use App\Http\Requests\TeacherRequest;
use App\Level;
use App\place;
use App\Repositories\TeacherRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class TeacherController extends Controller
{

    /**
     * @var TeacherRepository
     */
    private $repo;

    public function __construct(Teacher $teacher)
    {
        $this->middleware(['auth', 'verified']);
        $this->repo = new TeacherRepository($teacher);
    }


    public function index(Request $request)
    {
        $user = User::where('type', 0)->orderBy('id', 'desc')->paginate(10);
        $teachers = Teacher::orderBy('userid', 'asc')->paginate(10);
        return view('teachers.index', compact('teachers', 'user'));
    }

    public function create()
    {
        $places = place::all();
        $levels = Level::orderBy('name', 'asc')->get();
        return view('teachers.create', compact('places', 'levels'));

    }

    public function store(TeacherRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => ucwords(strtolower($request->name)),
                'email' => mb_strtolower($request->email),
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'type' => 0,
            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->getPathName();
                $img = cloudinary()->upload($filePath)->getSecurePath();
            } else $img = null;
            Teacher::create([
                'userid' => $user->id,
                'level' => ucwords(strtolower($request->level)),
                'gender' => ucwords(strtolower($request->gender)),
                'altphone' => $request->altphone,
                'specialization' => ucwords(strtolower($request->specialization)),
                'description' => ucwords(strtolower($request->description)),
                'imgpath' => $img,
                'state' => ucwords(strtolower($request->state)),
                'city' => ucwords(strtolower($request->city)),
                'verified' => 1,
            ]);
            DB::commit();
            return redirect()->route('teachers.index')->with('status', 'Teacher created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route('teachers.index')->with('status', 'Failed to create teacher.');

        }

    }


    public function update(TeacherRequest $request, $id)
    {
        try {
            $teachers = $this->repo->getById($id);
            $user = $teachers->user;
            $attributes = $request->only([
                'altphone', 'level', 'description', 'specialization', 'city', 'state', 'userid', 'gender'
            ]);
            if ($request->hasFile('image')) {
                $img = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
                $attributes['imgpath'] = $img;
            }
            DB::beginTransaction();
            $user->name = ucwords(strtolower($request->input('name')));
            $user->email = mb_strtolower($request->input('email'));
            $user->phone = ($request->input('phone'));
            $this->repo->update($id, $attributes);
            $user->save();
            DB::commit();
            return redirect()->route('teachers.index')->with('status', 'Teacher Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route('teachers.index')->with('status', 'Failed to update Teacher');

        }
    }

    public function edit($id)
    {
        $teachers = $this->repo->getById($id);
        $user = $teachers->user;
        $levels = Level::orderBy('name', 'asc')->get();
        return view('teachers.edit', compact('teachers', 'levels', 'user'));

    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $teachers = $this->repo->getById($id);
            $user = $teachers->user;
            $this->repo->delete($id);
            $user->delete();
            DB::commit();
            return redirect()->back()
                ->with('status', 'Teacher deleted Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('status', 'Failed to delete Teacher .');

        }
    }


    public function show()
    {

    }

    public function feature(Request $request, $id)
    {
        $teachers = $this->repo->getById($id);
        $teachers->is_featured = 1;
        $teachers->update();
        return redirect()->route('teachers.index')->with('status', 'Teacher is featured now');
    }
}
