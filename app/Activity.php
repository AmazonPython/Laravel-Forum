<?php

namespace App;

use function GuzzleHttp\Promise\all;
use Illuminate\Database\Eloquent\Model;

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
            ->latest('id')
            ->with('subject')
            ->get()
            ->groupBy(function ($activity) {
                return $activity->created_at->format('Y-m-d');
            });
    }
}
