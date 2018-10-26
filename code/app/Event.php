<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    protected $dates = ['start_at', 'ends_at'];

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
     * Return true if the interval between $startDateTime and $endDateTime
     * Overwrite the event duration interval
     *
     * @param $startDateTime
     * @param $endDateTime
     * @return bool
     */
    public function checkOverwriteInterval($startDateTime, $endDateTime)
    {
        if ($startDateTime->between($this->start_at, $this->ends_at)) {
            return true;
        }

        if ($endDateTime->between($this->start_at, $this->ends_at)) {
            return true;
        }

        return false;
    }
}
