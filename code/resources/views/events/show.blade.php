@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('events.partials.event')

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Invited Users</div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <ul>
                                @forelse($event->invitedUsers() as $invitedUser)
                                    <li>{{ $invitedUser->name }}</li>
                                @empty
                                    This event don't have invited users.
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection