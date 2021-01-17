<?php


namespace App\Http\Controllers;


use App\Entities\Coaching;
use App\Entities\Teacher;
use App\Http\Requests\CreateCoachingRequest;
use App\Http\Requests\MeetingRequest;
use App\Level;
use App\place;
use App\Repositories\CoachingRepository;
use App\Repositories\CustomRepository;
use App\Traits\ZoomJWT;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CoachingController extends Controller
{

    use ZoomJWT;
    /**
     * @var CoachingRepository
     */
    private $repo;

    public function __construct(\App\Entities\Coaching $coaching)
    {
        $this->middleware(['auth', 'verified']);
        $this->repo = new CoachingRepository($coaching);
    }


    public function index(Request $request)
    {
        $coachings = Coaching::with('user')->get();
        if ($request->ajax()) {
            $user = User::where('type', 1)->orderBy('id', 'desc')->paginate(12);
            $coachings = Coaching::orderBy('userid', 'desc')->paginate(12);
            $view = view('data')->with(compact('user', 'coachings'))->render();
            return response()->json(['html' => $view]);
        }
        return view('coachings.index', compact('coachings'));

    }

    public function create()
    {
        $places = place::all();
        $levels = Level::orderBy('name', 'asc')->get();
        return view('coachings.create', compact('places', 'levels'));


    }

    public function store(CreateCoachingRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => ucwords(strtolower($request->name)),
                'email' => mb_strtolower($request->email),
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'type' => 1,
            ]);
            $secondaryid = $user->id;
            $img = (new CustomRepository())->upload($request);
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
            DB::commit();
            return redirect()->route('coachings.index')->with('status', 'Coaching created successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route('coachings.index')->with('status', 'Failed to create coaching.');

        }

    }


    public function update(CreateCoachingRequest $request, $id)
    {
        try {
            $coachings = $this->repo->getById($id);
            $user = $coachings->user;
            $attributes = $request->only([
                'directorname', 'description', 'altphone', 'specialization', 'address2', 'address1'
                , 'state', 'landmark', 'city', 'level'
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
            return redirect()->route('coachings.index')->with('status', 'Coaching Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route('coachings.index')->with('status', 'Failed to update Data');

        }
    }

    public function edit($id)
    {
        $coachings = $this->repo->getById($id);
        $user = $coachings->user;
        $levels = Level::orderBy('name', 'asc')->get();
        return view('coachings.edit', compact('coachings', 'levels', 'user'));

    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $coachings = $this->repo->getById($id);
            $user = $coachings->user;
            $this->repo->delete($id);
            $user->delete();
            DB::commit();
            return redirect()->back()
                ->with('status', 'Coaching deleted Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back()
                ->withInput()
                ->with('status', 'Failed to delete Coaching .');

        }
    }


    public function show()
    {

    }

    public function feature(Request $request, $id)
    {
        $coachings = $this->repo->getById($id);
        $coachings->is_featured = 1;
        $coachings->update();
        return redirect()->route('coachings.index')->with('status', 'Coaching is featured now');
    }

    public function meetingSchedule()
    {
        $data = Coaching::where('userid', \auth()->id())->first();
        return view('coaching.zoom-meeting.schedule', compact('data'));
    }

    public function meetingIndex(Request $request)
    {
        $hasConfig = DB::table('zoom_config')
            ->where('user_id', '=', \auth()->id())
            ->count();
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
            return view('coaching.zoom-meeting.index', compact('data', 'zoom'));
        } catch (\Exception $exception) {
//            dd($exception);
            if ($hasConfig) {
                request()->session()->flash('error', 'Your Credential May be incorrect. Please Edit Your Zoom configuration');
                return $this->meetingConfigurationEdit();
            } else {
                request()->session()->flash('error', 'You should set Zoom credentials');
                return $this->meetingConfiguration($request);

            }

        }
    }

    public function meetingConfigurationEdit()
    {
        $data = \App\Coaching::where('userid', \auth()->id())->first();
        $zoomConfig = $this->getZoomMeetingConfiguration();
        return view('coaching.zoom-meeting.edit', compact('zoomConfig', 'data'));

    }

    protected function getZoomMeetingConfiguration()
    {
        return DB::table('zoom_config')
            ->where('user_id', '=', \auth()->id())
            ->first();
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
            return redirect()->route('coaching.meetings.index');
        } else {
            $data = Auth::user();
            $key = null;
            $secret = null;
            return view('coaching.zoom-meeting.create', compact('data', 'key', 'secret'));
        }
    }

    public function meetingConfigurationUpdate(Request $request, $id)
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
            return redirect()->route('coaching.meetings.index')->with('success', 'Zoom Configuration updated successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('failed', 'Failed to update Zoom Configuration')
                ->withInput();
        }
    }

    public function meetingStore(MeetingRequest $request)
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
            return redirect()->route('coaching.meetings.index')->with('success', 'Meeting created successfully.');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . $exception->getTraceAsString());
            return redirect()->route('coaching.meetings.index')->with('failed', 'Meeting can not be created.');

        }
    }
}
