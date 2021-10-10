<?php

namespace App\Http\Controllers;

use App\Reply;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function store(Reply $reply)
    {
        $reply->favorite();
    }

    public function destroy(Reply $reply)
    {
        $reply->unfavorite();
    }
}
