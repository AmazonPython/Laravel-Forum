<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function GuzzleHttp\Promise\all;

class Activity extends Model
{
    protected $guarded = [];

    public function subject()
    {
        return $this->morphTo();
    }

    public static function feed($user)
    {
        return static::where('user_id', $user->id)
            ->latest()
            ->with('subject')
            ->get()
            ->groupBy(function ($activity) {
                return $activity->created_at->format('Y-m-d');
            });
    }
}
