<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Reply;
use App\Rules\Recaptcha;
use App\Thread;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Channel $channel, Thread $thread, Recaptcha $recaptcha)
    {
        $this->validate(request(), [
            'body'                 => 'required|min:3',
            'g-recaptcha-response' => $recaptcha,
        ]);

        if ($thread->locked == false) {
            $reply = $thread->addReply([
                'body'    => request('body'),
                'user_id' => auth()->id(),
            ]);

            if (request()->expectsJson()) {
                return $reply->load('owner');
            }

            return back()->with('flash', trans('messages.threads_reply_success'));
        }
    }

    public function edit(Reply $reply)
    {
        return view('threads.reply_edit', compact('reply'));
    }

    public function update(Reply $reply, Thread $thread, Recaptcha $recaptcha)
    {
        $this->authorize('update', $reply);

        $this->validate(request(), [
            'body'                 => 'required|min:3',
            'g-recaptcha-response' => $recaptcha,
        ]);

        if ($thread->locked == false) {
            $reply->update(request(['body']));

            return redirect(url('threads'))->with('flash', trans('messages.threads_edit_success'));
        }
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        return back()->with('flash', trans('messages.threads_delete_reply_success'));
    }

    public function bestReply(Reply $reply)
    {
        $this->authorize('update', $reply->thread);

        $reply->thread->markBestReply($reply);

        return back();
    }
}
