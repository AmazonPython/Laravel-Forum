<?php

namespace App;

use Illuminate\Support\Facades\Redis;

class Trending
{
    /**
     * 获取所有热门线程
     *
     * @return array
     */
    public function get()
    {
        return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 9));
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
        Redis::zincrby($this->cacheKey(), 1, json_encode([
            'title' => $thread->title,
            'path' => $thread->path()
        ]));
    }

    /**
     * 重置所有热门线程
     */
    public function reset()
    {
        Redis::del($this->cacheKey());
    }
}
