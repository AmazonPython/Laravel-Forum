<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use App\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index(Channel $channel)
    {
        if ($channel->exists){
            $threads = $channel->threads()->latest();
        }else{
            $threads = Thread::latest();
        }

        if ($username = request('by')){
            $user = User::where('name', $username)->firstOrFail();
            $threads->where('user_id', $user->id);
        }

        $threads = $threads->get();

        return view('threads.index', compact('threads'));
    }

    public function show(Channel $channel, Thread $thread)
    {
        return view('threads.show', compact('thread', 'channel'));
    }

    public function create()
    {
        $channels = Channel::all();

        return view('threads.create', compact('channels'));
    }

    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|max:100|min:2',
            'body' => 'required|min:3',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $thread = $request->user()->threads()->create([
            'title' => request('title'),
            'body' => request('body'),
            'channel_id' => request('channel_id'),
        ]);

        if ($thread == true){
            $thread->save();
            return redirect($thread->path());
        }
    }
}
