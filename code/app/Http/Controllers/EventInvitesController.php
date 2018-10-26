<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventInvite;
use Illuminate\Http\Request;

class EventInvitesController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event)
    {
        $this->validate(request(), [
            'user' => 'required|exists:users,id'
        ]);

        $invitedUserId = request('user');
        $eventInvite = EventInvite::firstOrNew([
            'event_id' => $event->id,
            'user_id' => $invitedUserId
        ]);

        // Only one invite per user and event
        if ($eventInvite->exists) {
            return redirect($event->path())
                ->withErrors(['user' => 'User already invited for this event']);
        } else {
            // TODO: Put this on model boot or define false as default
            $eventInvite->confirmed = false;
            $eventInvite->save();
        }

        return redirect($event->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EventInvite  $eventInvite
     * @return \Illuminate\Http\Response
     */
    public function show(EventInvite $eventInvite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventInvite  $eventInvite
     * @return \Illuminate\Http\Response
     */
    public function edit(EventInvite $eventInvite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventInvite  $eventInvite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventInvite $eventInvite)
    {
        //
    }

    public function confirm(EventInvite $eventInvite)
    {
        //TODO: add user verification
        $eventInvite->confirm();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventInvite $eventInvite
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(EventInvite $eventInvite)
    {
        //TODO: validate user and event
        $eventInvite->delete();
    }
}
