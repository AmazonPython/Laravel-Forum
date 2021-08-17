<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
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

    public function store(Request $request)
    {
        $thread = Thread::create()->all([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'body' => $request->body
        ]);

        if ($thread == true){
            return redirect($thread->path());
        }
    }
}
