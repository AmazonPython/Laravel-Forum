<?php

namespace App\Http\Controllers;

use App\Thread;
use App\ThreadSubscription;

class ThreadSubscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function subscribe($channelId, Thread $thread)
    {
        $param = [
            'user_id' => auth()->id(),
            'thread_id' => $thread->id,
        ];

        ThreadSubscription::firstOrCreate($param);

        return back()->with('flash', trans('messages.threads_subscribe_success'));
    }

    public function unSubscribe($channelId, Thread $thread)
    {
        $thread->subscribe(auth()->id())->delete();

        return back()->with('flash', trans('messages.threads_unsubscribe_success'));
    }
}
