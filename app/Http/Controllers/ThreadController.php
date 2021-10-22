<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use App\Filters\ThreadFilters;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('index', 'show');
    }

    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);

        if (\request()->wantsJson()) {
            return $threads;
        }

        return view('threads.index', compact('threads'));
    }

    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::filter($filters);

        if ($channel->exists){
            $threads->where('channel_id', $channel->id);
        }

        return $threads->latest('id')->paginate(10);
    }

    public function show($channel, Thread $thread)
    {
        if (auth()->check()) {
            auth()->user()->read($thread);
        }

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

    public function store(Request $request, Recaptcha $recaptcha)
    {
        $request->validate([
            'title' => 'required|max:100|min:2',
            'body' => 'required|min:9',
            'channel_id' => 'required|exists:channels,id',
            'g-recaptcha-response' => $recaptcha,
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => $request->channel_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        if (request()->wantsJson()) {
            return response($thread, 201);
        }

        return redirect($thread->path())->with('flash', trans('messages.threads_create_success'));
    }

    public function update($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->update(request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]));

        return $thread;
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
