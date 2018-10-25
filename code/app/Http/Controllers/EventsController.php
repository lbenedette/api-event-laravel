<?php

namespace App\Http\Controllers;

use App\Event;

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
            'start_time' => 'required|date_format:"Y-m-d H:i:s"|before:end_time',
            'end_time' => 'required|date_format:"Y-m-d H:i:s"',
            'description' => 'required'
        ]);

        $event = Event::create([
            'user_id' => auth()->id(),
            'start_time' => request('start_time'),
            'end_time' => request('end_time'),
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
            'start_time' => 'required|date_format:"Y-m-d H:i:s"|before:end_time',
            'end_time' => 'required|date_format:"Y-m-d H:i:s"',
            'description' => 'required'
        ]);

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
