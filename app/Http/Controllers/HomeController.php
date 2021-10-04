<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('lang');
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
