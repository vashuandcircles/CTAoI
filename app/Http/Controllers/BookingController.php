<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Spatie\GoogleCalendar\Event;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|Response|View
     */
    public function index()
    {

        $events = Event::get();
        return \view('calenders.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|Response|View
     */
    public function create()
    {
        return view('calenders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $event = new Event;

        $event->name = 'A new full day event';
        $event->startDate = Carbon::now();
        $event->endDate = Carbon::now()->addDay();

        $event->save();
        $start_date = Carbon::parse($request->start_date);
        Event::create([
            'name' => $request->topic,
            'startDateTime' => $start_date,
            'endDateTime' => Carbon::now()->addHour()
        ]);
        return redirect()->route('calenders.index')->with('success', 'booked');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
