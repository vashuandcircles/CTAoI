<?php


namespace App\Http\Controllers;


use App\Coaching;
use App\Http\Requests\CreateCoachingRequest;
use App\Level;
use App\place;
use App\Repositories\CoachingRepository;
use App\Repositories\CustomRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CoachingController extends Controller
{

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
        $user = User::where('type', 1)->orderBy('id', 'desc')->paginate(12);
        $coachings = Coaching::orderBy('userid', 'desc')->paginate(12);
        if ($request->ajax()) {
            $view = view('data')->with(compact('user', 'coachings'))->render();
            return response()->json(['html' => $view]);
        }
        return view('coachings.index', compact('coachings', 'user'));

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
}
