<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\ThreadFilters;

class Thread extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest();
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
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
}
