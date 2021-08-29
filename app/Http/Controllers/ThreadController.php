<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);

        return view('threads.index', compact('threads'));
    }

    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists){
            $threads->where('channel_id', $channel->id);
        }

        return $threads->get();
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