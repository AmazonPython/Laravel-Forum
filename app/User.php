<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'user_id', 'id');
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function read($thread)
    {
        cache()->forever($this->visitedThreadCacheKey($thread), Carbon::now());
    }

    public function visitedThreadCacheKey($thread)
    {
        return sprintf('users.%s.visits.%s', $this->id, $thread->id);
    }

    public function lastReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

    public function defaultAvatar()
    {
        return 'https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/images/avatar.jpeg';
    }
}
