<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $keyword = $request->input('q');

        $users = User::select(['id', 'name', 'avatar', 'created_at'])
            ->where('name', 'LIKE', "$keyword%")
            ->orderBy('id')
            ->simplePaginate(10);

        $counts = User::where('name', 'LIKE', "$keyword%")->count();

        return view('partials.search', compact('users', 'counts'));
    }
}
