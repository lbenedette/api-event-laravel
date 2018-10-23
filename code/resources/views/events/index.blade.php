@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Events
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-2 text-center" style="margin-bottom: 22px;">
                <a class="btn btn-primary" href="/events/create">
                    New
                </a>
            </div>

            @if($events->isEmpty())
                <div class="col-md-8 col-md-offset-2 text-center">
                    Don't exist events yet!
                </div>
            @else
                @foreach($events as $event)
                    @include('events.partials.event')
                @endforeach
            @endif
        </div>
    </div>
@endsection
