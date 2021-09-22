<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\ThreadFilters;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->withCount('favorites')->with('owner')->latest();
    }

    public function addReply($reply)
    {
        //return $this->replies()->create($reply);
        $reply = $this->replies()->create($reply);

        $this->subscriptions->where('user_id', '!=', $reply->user_id)->each->notify($reply);

        return $reply;
    }

    public function getReplyCountAttribute()
    {
        return $this->replies()->counts();
    }

    public function scopefilter($query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }

    //返回slug地址，利于SEO
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if (! $this->exists)
        {
            $this->attributes['slug'] = str_replace(' ', '-', $value);
        }
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function subscribe($user_id)
    {
        return $this->hasOne(ThreadSubscription::class)->where('user_id', $user_id);
    }

    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }
}
