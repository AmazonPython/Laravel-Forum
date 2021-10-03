<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'search');
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

    public function search(Request $request)
    {
        $keyword = $request->input('query');

        $users = User::where('name', 'LIKE', "$keyword%")->paginate(10);

        return view('partials.search', compact('users'));
    }

    public function avatar(Request $request)
    {
        request()->validate([
            'avatar' => ['required', 'image']
        ]);

        auth()->user()->update([
            'avatar' => request()->file('avatar')->store('avatars', 'public')
        ]);

        return redirect()->back();
    }
}
