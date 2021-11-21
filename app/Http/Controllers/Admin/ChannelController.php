<?php

namespace App\Http\Controllers\Admin;

use App\Channel;
use App\Http\Controllers\Controller;

class ChannelController extends Controller
{
    public function index()
    {
        $channels = Channel::withCount('threads')->get();

        return view('admin.channels.index', compact('channels'));
    }

    public function create()
    {
        return view('admin.channels.create');
    }

    public function store()
    {
        $channel = Channel::create(
            request()->validate([
                'name'        => 'required|unique:channels',
                'description' => 'required',
            ])
        );

        cache()->forget('channels');

        if (request()->wantsJson()) {
            return response($channel, 201);
        }

        return redirect(route('admin.channel.index'))->with('flash', trans('messages.admin_add_channel_success'));
    }
}
