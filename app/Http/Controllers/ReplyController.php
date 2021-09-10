<?php

namespace App\Http\Controllers;

use App\Channel;
use Auth;
use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Channel $channel, $id, Request $request)
    {
        $this->validate(request(),[
            'body' => 'required|min:3',
        ]);

        $thread = Thread::find($id);

        $reply = new Reply();
        $reply->body = $request->body;
        $reply->thread_id = $thread->id;
        $reply->user_id = Auth::id();

        if ($reply == true){
            $reply->save();

            return redirect()->back()->with('flash', trans('messages.threads_reply_success'));
        }
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        return back()->with('flash', trans('messages.threads_delete_reply_success'));
    }
}
