<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-8">
                    Description:
                    <a href="{{ '/events/' . $event->id }}">
                        {{ $event->description }}
                    </a>
                    <br>
                    Start time: {{ $event->start_time }}
                    <br>
                    End Time: {{ $event->end_time }}
                </div>

                <div class="pull-right">
                    <div class="col-sm-4">
                        <a class="btn btn-default" href="{{ '/events/' . $event->id . '/edit' }}">Edit</a>
                    </div>

                    <div class="col-sm-4">
                        <form action="{{ '/events/' . $event->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>