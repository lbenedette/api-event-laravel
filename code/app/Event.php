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

    /**
     * A event have invites
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invites()
    {
        return $this->hasMany(EventInvite::class);
    }

    /**
     * A event have invited users
     *
     * @return User|User[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function invitedUsers()
    {
        $invitedUserIds = $this->invites()
            ->where('confirmed', false)
            ->pluck('user_id');

        return User::find($invitedUserIds);
    }

    /**
     * A event have confirmed users
     *
     * @return User|User[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function confirmedUsers()
    {
        $confirmedUserIds = $this->invites()
            ->where('confirmed', true)
            ->pluck('user_id');

        return User::find($confirmedUserIds);
    }

    /**
     * Return the event resource url
     *
     * @return string
     */
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
