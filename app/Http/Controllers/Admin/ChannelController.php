<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class ChannelController extends Controller
{
    public function index()
    {
        return view('admin.channels.index')->with('channels', Channel::with('threads')->get());
    }

    public function create()
    {
        return view('admin.channels.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|unique:channels',
            'description' => 'required',
        ]);

        $channel = Channel::create($data + [ 'slug' => Str::slug($data['name'])]);

        Cache::forget('channels');

        if (request()->wantsJson()) {
            return response($channel, 201);
        }

        return redirect(route('admin.channel.index'))->with('flash', 'Success!');
    }
}
