<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except('show', 'search');
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

        $users = User::select(['id', 'name', 'avatar', 'created_at'])
            ->where('name', 'LIKE', "$keyword%")
            ->orderBy('id')
            ->simplePaginate(10);

        return view('partials.search', compact('users'));
    }

    public function avatar(Request $request, User $user)
    {
        request()->validate([
            'avatar' => ['required', 'image']
        ]);

        if ($request->file('avatar')) {
            $path = $request->file('avatar')->storePublicly('avatars/' . $user->name, 'public');
            $user->avatar = "/storage/" . $path;

            $user->save();
        }

        return back()->with('flash', trans('messages.profiles_edit_avatar_success'));
    }
}
