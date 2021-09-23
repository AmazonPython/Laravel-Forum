<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    public function show(User $user)
    {
        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => Activity::feed($user)
        ]);
    }

    public function all()
    {
        return auth()->user()->unreadNotifications;
    }

    public function read($user, $notificationId)
    {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();

        return redirect()->back();
    }
}
