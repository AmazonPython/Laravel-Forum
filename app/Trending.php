<?php

namespace App;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class Trending
{
    /**
     * 获取所有热门线程
     *
     * @return array
     */
    public function get()
    {
        //return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 9));
        return Cache::get($this->cacheKey(), collect())
            ->sortByDesc('score')
            ->slice(0, 5)
            ->values();
    }

    /**
     * 获取缓存键名
     *
     * @return string
     */
    private function cacheKey()
    {
        return 'trending_threads';
    }

    /**
     * 将新线程推送到热门线程列表
     *
     * @param Thread $thread
     */
    public function push($thread, $increment = 1)
    {
        /*Redis::zincrby($this->cacheKey(), 1, json_encode([
                'title' => $thread->title,
                'path' => $thread->path()
            ])
        );*/
        $trending = Cache::get($this->cacheKey(), collect());

        $trending[$thread->id] = (object) [
            'score' => $this->score($thread) + $increment,
            'title' => $thread->title,
            'path' => $thread->path(),
        ];

        Cache::forever($this->cacheKey(), $trending);
    }

    public function score($thread)
    {
        $trending = Cache::get($this->cacheKey(), collect());

        if (! isset($trending[$thread->id])) {
            return 0;
        }

        return $trending[$thread->id]->score;
    }

    /**
     * 重置所有热门线程
     */
    public function reset()
    {
        //Redis::del($this->cacheKey());
        return Cache::forget($this->cacheKey());
    }
}
