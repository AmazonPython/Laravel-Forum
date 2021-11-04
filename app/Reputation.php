<?php

namespace App;

class Reputation
{
    const THREAD_WAS_PUBLISHED = 10;
    const REPLY_POSTED = 5;
    const BEST_REPLY_AWARDED = 50;

    // 将信誉点奖励给给定用户。
    public static function award($user, $points)
    {
        $user->increment('reputation', $points);
    }
}
