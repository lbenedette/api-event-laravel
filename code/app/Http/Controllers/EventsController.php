<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;

class EventsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $events = $user->events;

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event();

        return view('events.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'start_at' => 'required|date_format:"Y-m-d H:i:s"|before:ends_at',
            'ends_at' => 'required|date_format:"Y-m-d H:i:s"',
            'title' => 'required|min:5'
        ]);

        $userEvents = auth()->user()->events;
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', request('start_at'));
        $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', request('ends_at'));
        foreach ($userEvents as $userEvent) {
            if ($userEvent->checkOverwriteInterval($startDateTime, $endDateTime)) {
                return redirect('/events/create')
                    ->with('error', 'Already exist a event in this period!');
            }
        }

        $event = Event::create([
            'user_id' => auth()->id(),
            'start_at' => request('start_at'),
            'ends_at' => request('ends_at'),
            'title' => request('title'),
            'description' => request('description')
        ]);

        return redirect($event->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Event $event)
    {
        $this->validate(request(), [
            'start_at' => 'required|date_format:"Y-m-d H:i:s"|before:ends_at',
            'ends_at' => 'required|date_format:"Y-m-d H:i:s"',
            'title' => 'required|min:5'
        ]);

        $userEvents = auth()->user()->events;
        $startTime = Carbon::createFromFormat('Y-m-d H:i:s', request('start_at'));
        $endTime = Carbon::createFromFormat('Y-m-d H:i:s', request('ends_at'));
        foreach ($userEvents as $userEvent) {
            if ($event->id == $userEvent->id) {
                continue;
            }

            if ($userEvent->checkOverwriteInterval($startTime, $endTime)) {
                return redirect('/events/create')
                    ->with('error', 'Already exist a event in this period!');
            }
        }

        $event->update(request()->all());

        return redirect($event->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect('/events');
    }
}
