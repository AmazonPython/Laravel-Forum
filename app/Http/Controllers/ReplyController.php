<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Reply;
use App\Thread;
use App\User;
use App\Notifications\YouWereMentioned;
use Illuminate\Support\Facades\Notification;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Channel $channel, Thread $thread)
    {
        $this->validate(request(),[
            'body' => 'required|min:3',
        ]);

        $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        if (request()->expectsJson()) {
            return $reply->load('owner');
        }

        preg_match_all('/\@([^\s\.]+)/', $reply->body, $matches);

        $names =  $matches[1];

        $users = User::whereIn('name', $names)->get();

        Notification::send($users, new YouWereMentioned($reply));

        return back()->with('flash', trans('messages.threads_reply_success'));
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        $this->validate(request(), ['body' => 'required|min:3']);

        $reply->update(request(['body']));
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        return back()->with('flash', trans('messages.threads_delete_reply_success'));
    }
}
