<?php

namespace App\Http\Controllers;
use Auth;
use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store($id, Request $request)
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
            return redirect()->back();
        }
    }
}
