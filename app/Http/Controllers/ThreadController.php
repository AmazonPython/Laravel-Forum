<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use App\Trending;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;
use Illuminate\Support\Facades\Redis;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('index', 'show');
    }

    public function index(Channel $channel, ThreadFilters $filters, Trending $trending)
    {
        $threads = $this->getThreads($channel, $filters);

        if (\request()->wantsJson()) return $threads;

        return view('threads.index', [
            'threads' => $threads,
            'trending' => $trending->get()
        ]);
    }

    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::with('channel')->latest('id')->filter($filters);

        if ($channel->exists){
            $threads->where('channel_id', $channel->id);
        }

        return $threads->paginate(10);
    }

    public function show($channel, Thread $thread, Trending $trending)
    {
        if (auth()->check()) {
            auth()->user()->read($thread);
        }

        $trending->push($thread);
        $thread->increment('visits');

        return view('threads.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(20)
        ]);
    }

    public function create()
    {
        $channels = Channel::latest('id')->get();

        return view('threads.create', compact('channels'));
    }

    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|max:100|min:2',
            'body' => 'required|min:9',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $thread = $request->user()->threads()->create([
            'title' => request('title'),
            'body' => request('body'),
            'channel_id' => request('channel_id'),
        ]);

        if ($thread == true){
            $thread->save();

            return redirect($thread->path())->with('flash', trans('messages.threads_create_success'));
        }
    }

    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        if (request()->wantsJson()) {
            return response([], 204);
        }

        return redirect('/threads')->with('flash', trans('messages.threads_delete_thread_success'));
    }

    public function lock(Thread $thread)
    {
        $thread->update(['locked' => true]);

        return back()->with('flash', trans('messages.threads_locked_success'));
    }

    public function unlock(Thread $thread)
    {
        $thread->update(['locked' => false]);

        return back()->with('flash', trans('messages.threads_unlocked_success'));
    }
}
