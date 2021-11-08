<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\ThreadReceivedNewReply;
use App\Filters\ThreadFilters;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['creator', 'channel'];

    protected $casts = ['locked' => 'boolean'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($thread) {
            $thread->replies->each->delete();

            Reputation::reduce($thread->creator, Reputation::THREAD_WAS_PUBLISHED);
        });

        static::created(function ($thread) {
            $thread->update(['slug' => $thread->title]);

            Reputation::award($thread->creator, Reputation::THREAD_WAS_PUBLISHED);
        });
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}-{$this->slug}";
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
        $reply = $this->replies()->create($reply);

        event(new ThreadReceivedNewReply($reply));

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

    public function notifySubscribers($reply)
    {
        $this->subscriptions->where('user_id', '!=', $reply->user_id)->each->notify($reply);

        return $reply;
    }

    public function hasUpdatesFor($user)
    {
        $key = $user->visitedThreadCacheKey($this);

        return $this->updated_at > cache($key);
    }

    public function bestReply()
    {
        return $this->hasOne(Reply::class, 'thread_id');
    }

    public function markBestReply(Reply $reply)
    {
        if ($this->hasBestReply()) {
            Reputation::reduce($this->bestReply->owner, Reputation::BEST_REPLY_AWARDED);
        }

        $this->update(['best_reply_id' => $reply->id]);

        Reputation::award($reply->owner, Reputation::BEST_REPLY_AWARDED);
    }

    public function hasBestReply()
    {
        return ! is_null($this->best_reply_id);
    }
}
