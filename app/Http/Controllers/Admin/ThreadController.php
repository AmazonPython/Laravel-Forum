<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Thread;
use App\Trending;

class ThreadController extends Controller
{
    public function index(Trending $trending)
    {
        return view('admin.threads.index', ['trending' => $trending->get()]);
    }

    public function reset(Thread $thread, Trending $trending)
    {
        $trending->reset($thread);

        return back()->with('flash', trans('messages.admin_reset_threads_trending_success'));
    }
}
