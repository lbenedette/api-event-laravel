{{ csrf_field() }}

<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="description" class="col-md-4 control-label">Description</label>

    <div class="col-md-6">
        <textarea id="description" class="form-control" name="description" rows="10"
                  required autofocus>
            {{ $event->description }}
        </textarea>

        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
    <label for="start_time" class="col-md-4 control-label">Start time</label>

    <div class="col-md-6">
        <input id="start_time" type="text" class="form-control" name="start_time" value="{{ $event->start_time }}" required>

        @if ($errors->has('start_time'))
            <span class="help-block">
                <strong>{{ $errors->first('start_time') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('end_time') ? ' has-error' : '' }}">
    <label for="end_time" class="col-md-4 control-label">End time</label>

    <div class="col-md-6">
        <input id="end_time" type="text" class="form-control" name="end_time" value="{{ $event->end_time }}" required>

        @if ($errors->has('end_time'))
            <span class="help-block">
                <strong>{{ $errors->first('end_time') }}</strong>
            </span>
        @endif
    </div>
</div>
