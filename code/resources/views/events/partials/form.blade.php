{{ csrf_field() }}

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="col-md-4 control-label">Title</label>

    <div class="col-md-6">
        <input id="title" type="text" class="form-control" name="title" value="{{ $event->title }}" required>

        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-4 control-label">Description</label>

    <div class="col-md-6">
        <input id="description" type="text" class="form-control" name="description" value="{{ $event->description }}">

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('start_at') ? ' has-error' : '' }}">
    <label for="start_at" class="col-md-4 control-label">Start at</label>

    <div class="col-md-6">
        <input id="start_at" type="text" class="form-control" name="start_at" value="{{ $event->start_at }}" required>

        @if ($errors->has('start_at'))
            <span class="help-block">
                <strong>{{ $errors->first('start_at') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('ends_at') ? ' has-error' : '' }}">
    <label for="ends_at" class="col-md-4 control-label">Ends at</label>

    <div class="col-md-6">
        <input id="ends_at" type="text" class="form-control" name="ends_at" value="{{ $event->ends_at }}" required>

        @if ($errors->has('ends_at'))
            <span class="help-block">
                <strong>{{ $errors->first('ends_at') }}</strong>
            </span>
        @endif
    </div>
</div>
