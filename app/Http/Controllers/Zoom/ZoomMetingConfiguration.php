<?php


namespace App\Http\Controllers\Zoom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ZoomMetingConfiguration extends Controller
{


    public function index()
    {

    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'zoom_api_key' => 'required',
            'zoom_api_secret' => 'required',
        ]);
        try {
            DB::table('zoom_config')
                ->insert([
                    'zoom_api_key' => $request->get('zoom_api_key'),
                    'zoom_api_secret' => $request->get('zoom_api_secret'),
                    'user_id' => auth()->id(),
                ]);
            return redirect()->route('meetings.index')
                ->with('success', 'Thank You for the credentials. You can now create a zoom meeting');
        } catch (\Exception $exception) {
            return redirect()->back()->with('failed', 'Something went wrong');
        }

    }

    public function hasZoomCredentials(): int
    {
        return DB::table('zoom_config')
            ->where('user_id', '=', auth()->id())
            ->count('id');
    }
}
