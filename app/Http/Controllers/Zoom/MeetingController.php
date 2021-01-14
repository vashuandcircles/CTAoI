<?php

namespace App\Http\Controllers\Zoom;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeetingRequest;
use App\Traits\ZoomJWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MeetingController extends Controller
{
    const MEETING_TYPE_INSTANT = 1;

    use ZoomJWT;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

//

    public function index(Request $request)
    {
        $response = $this->checkCredentials();
        if ($response == false) {
            return redirect()->route('meetings.setup')->with('status', 'You need to setup your zoom credentials first.');
        } elseif ($response === 'invalid access') {
            return redirect()->route('meetings.setup')->with('status', 'Invalid Credentials please create new one');
        }
        $path = 'users/me/meetings';
        $response = $this->zoomGet($path);
        $data = json_decode($response->body(), true);
        $data['meetings'] = array_map(function (&$m) {
            $m['start_at'] = $this->toUnixTimeStamp($m['start_time'], $m['timezone']);
            return $m;
        }, $data['meetings']);

        if ($request->wantsJson()) {
            return [
                'success' => $response->ok(),
                'data' => $data,
            ];
        }
        return view('zoom-meetings.index')
            ->with('meetings', $data);
    }


    protected function checkCredentials()
    {
        $count = DB::table('zoom_config')->where('user_id', auth()->id())->count();
        $path = 'users/me/meetings';
        $response = $this->zoomGet($path);
        $data = json_decode($response->body(), true);;
        $isValid = false;
        if (isset($data['message']))
            $isValid = $data['message'] == "Invalid access token.";
        if ($count > 0) {
            if ($isValid == true)
                return 'invalid access';
            return true;
        } else {
            return false;
        }
    }

    public function create()
    {
        return view('zoom-meetings.create');
    }

    public function store(MeetingRequest $request)
    {
        $data = $request->only(['topic', 'start_time', 'agenda']);
        $path = 'users/me/meetings';
        try {
            $this->zoomPost($path, [
                'topic' => $data['topic'],
                'type' => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $this->toZoomTimeFormat($data['start_time']),
                'duration' => 40,
                'agenda' => $data['agenda'],
                'settings' => [
                    'host_video' => false,
                    'participant_video' => false,
                    'waiting_room' => true,
                ]
            ]);
//            if ($request->wantsJson()) {
//                return [
//                    'success' => $response->status() === 201,
//                    'data' => json_decode($response->body(), true),
//                ];
//            }
            return redirect()->route('meetings.index')->with('status', 'Meeting created successfully.');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . $exception->getTraceAsString());
            return redirect()->route('meetings.index')->with('status', 'Meeting can not be created.');

        }
    }

    public function edit(Request $request, string $id)
    {
        $path = 'meetings/' . $id;
        $response = $this->zoomGet($path);
        $data = json_decode($response->body(), true);
        if ($response->ok()) {
            $data['start_at'] = $this->toUnixTimeStamp($data['start_time'], $data['timezone']);
        }
        return view('zoom-meetings.edit')->with('meeting', $data);
    }

    public function update(MeetingRequest $request, string $id)
    {
        $data = $request->all();
        $path = 'meetings/' . $id;
        try {
            $this->zoomPatch($path, [
                'topic' => $data['topic'],
                'type' => self::MEETING_TYPE_SCHEDULE,
                'start_time' => (new \DateTime($data['start_time']))->format('Y-m-d\TH:i:s'),
                'duration' => 40,
                'agenda' => $data['agenda'],
                'settings' => [
                    'host_video' => false,
                    'participant_video' => false,
                    'waiting_room' => true,
                ]
            ]);
            return redirect()->route('meetings.index')->with('status', 'Meeting updated successfully.');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . $exception->getTraceAsString());
            return redirect()->route('meetings.index')->with('status', 'Meeting can not be updated.');

        }
    }

    public function destroy(Request $request, string $id)
    {
        try {
            $path = 'meetings/' . $id;
            $this->zoomDelete($path);
            return redirect()->route('meetings.index')->with('status', 'Meeting deleted successfully.');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . $exception->getTraceAsString());
            return redirect()->route('meetings.index')->with('status', 'Meeting can not be deleted.');

        }
    }

    public function zoomSetupCreate()
    {
        return view('setup-zoom-meeting.create');
    }

    public function zoomSetup()
    {
        return view('setup-zoom-meeting.index');
    }
}

