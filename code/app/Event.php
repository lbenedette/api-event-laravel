<?php

namespace App;

class Event extends Model
{
    protected $dates = ['start_time', 'end_time'];

    public function path($action = 'show')
    {
        if ($action == 'show') {

        } elseif ($action)
        return '/events/' . $this->id;
    }
}
