<?php


namespace App\Http\Controllers;


use App\Entities\Teacher;
use App\Http\Requests\MeetingRequest;
use App\Http\Requests\TeacherRequest;
use App\Level;
use App\place;
use App\Repositories\CustomRepository;
use App\Repositories\TeacherRepository;
use App\Traits\ZoomJWT;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


class TeacherController extends Controller
{

    use ZoomJWT;
    /**
     * @var TeacherRepository
     */
    private $repo;

    public function __construct(Teacher $teacher)
    {
        $this->middleware(['auth', 'verified']);
        $this->repo = new TeacherRepository($teacher);
    }


    public function index()
    {
        $teachers = Teacher::with('user')->get();
        return view('teachers.index', compact('teachers'));
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
            $img = (new CustomRepository())->upload($request);
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
                ->with('status', 'Failed to delete Teacher.');

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


    public function meetingConfiguration(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->validate([
                'zoom_api_key' => 'required',
                'zoom_api_secret' => 'required'
            ]);
            $attributes = $request->except('_token');
            $attributes['user_id'] = \auth()->id();
            DB::table('zoom_config')
                ->insert($attributes);
            return redirect()->route('teachers.meetings.index');
        } else {
            $data = Auth::user();
            return view('teacher.zoom-meeting.configuration', compact('data'));
        }
    }

    public function meetingSchedule()
    {
        $data = Teacher::where('userid', \auth()->id())->first();
        return view('teacher.zoom-meeting.schedule', compact('data'));
    }

    public function meetingIndex()
    {
        try {
            $id = Auth::id();
            $data = \App\Teacher::where('userid', $id)->first();
            $path = 'users/me/meetings';
            $response = $this->zoomGet($path);
            $zoom = json_decode($response->body(), true);
            $zoom['meetings'] = array_map(function (&$m) {
                $m['start_at'] = $this->toUnixTimeStamp($m['start_time'], $m['timezone']);
                return $m;
            }, $zoom['meetings']);
            return view('teacher.zoom-meeting.index', compact('data', 'zoom'));
        } catch (\Exception $exception) {
            request()->session()->flash('error', 'Your Credential May be incorrect. Please Edit Your Zoom configuration');
            return $this->meetingConfigurationEdit();
        }
    }

    protected function getZoomMeetingConfiguration()
    {
        return DB::table('zoom_config')
            ->where('user_id', '=', \auth()->id())
            ->first();
    }

    public function meetingConfigurationEdit()
    {
        $data = \App\Teacher::where('userid', \auth()->id())->first();
        $zoomConfig = $this->getZoomMeetingConfiguration();
        return view('teacher.zoom-meeting.edit', compact('zoomConfig', 'data'));

    }

    public function meetingConfigurationUpdate(Request $request, $id): \Illuminate\Http\RedirectResponse
    {

        $request->validate([
            'zoom_api_key' => 'required',
            'zoom_api_secret' => 'required'
        ]);
        try {
            DB::table('zoom_config')
                ->where('id', $id)
                ->update([
                    'user_id' => \auth()->id(),
                    'zoom_api_key' => $request->get('zoom_api_key'),
                    'zoom_api_secret' => $request->get('zoom_api_secret'),
                ]);
            return redirect()->route('teachers.meetings.index')->with('success', 'Zoom Configuration updated successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('failed', 'Failed to update Zoom Configuration')
                ->withInput();
        }
    }

    public function meetingStore(MeetingRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->only(['topic', 'start_time', 'agenda']);
        $path = 'users/me/meetings';
        try {
            $this->zoomPost($path, [
                'topic' => $data['topic'],
                'type' => 2,
                'start_time' => $this->toZoomTimeFormat($data['start_time']),
                'duration' => 40,
                'agenda' => $data['agenda'],
                'settings' => [
                    'host_video' => false,
                    'participant_video' => false,
                    'waiting_room' => true,
                ]
            ]);
            return redirect()->route('teachers.meetings.index')->with('success', 'Meeting created successfully.');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . $exception->getTraceAsString());
            return redirect()->route('teachers.meetings.index')->with('failed', 'Meeting can not be created.');

        }
    }
}
