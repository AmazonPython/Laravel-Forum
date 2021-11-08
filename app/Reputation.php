<?php

namespace App;

class Reputation
{
    const THREAD_WAS_PUBLISHED = 10;
    const REPLY_POSTED = 5;
    const BEST_REPLY_AWARDED = 50;
    const REPLY_FAVORITED = 1;

    // 将信誉点奖励给给定用户。
    public static function award($user, $points)
    {
        $user->increment('reputation', $points);
    }

    // 取消赞赏、最佳回复或删除回复、帖子时减少信誉点
    public static function reduce($user, $points)
    {
        $user->decrement('reputation', $points);
    }
}
