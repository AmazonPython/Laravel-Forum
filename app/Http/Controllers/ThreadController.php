<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $threads = Thread::all();

        return view('threads.index', compact('threads'));
    }

    public function show(Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    public function create()
    {
        return view('threads.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(),[
            'title' => 'required|max:100|min:2',
            'body' => 'required|min:3'
        ]);

        $thread = $request->user()->threads()->create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'channel_id' => 1
        ]);

        if ($thread == true){
            $thread->save();
            return redirect($thread->path());
        }
    }
}
