<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventInvite extends Model
{
    protected $guarded = [];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function confirm()
    {
        $this->confirm = true;
        $this->save();
    }
}
