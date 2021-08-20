<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

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
        return $this->hasMany(Reply::class);
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
