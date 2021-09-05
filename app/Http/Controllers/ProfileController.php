<?php

namespace App\Http\Controllers;

use App\User;
use App\Activity;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => $this->getActivity($user)
        ]);
    }

    public function getActivity(User $user)
    {
        $activities = $user->activity()->latest()->with('subject')
            ->take(500)->get()->groupBy(function ($activity)
            {
                return $activity->created_at->format('Y-m-d');
            });

        return $activities;
    }
}
