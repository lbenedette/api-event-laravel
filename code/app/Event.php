<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    protected $dates = ['start_time', 'end_time'];

    /**
     * A event belongs to a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function path()
    {
        return '/events/' . $this->id;
    }

    /**
     * Return true if the interval between $startTime and $endTime
     * Overwrite the event duration interval
     *
     * @param $startTime
     * @param $endTime
     * @return bool
     */
    public function checkOverwriteInterval($startTime, $endTime)
    {
        if ($startTime < $this->start_time) {
            if ($endTime <= $this->start_time) {
                return false;
            }
            return true;
        }

        if ($startTime > $this->start_time) {
            if ($startTime >= $this->end_time) {
                return false;
            }
        }

        return true;
    }
}
