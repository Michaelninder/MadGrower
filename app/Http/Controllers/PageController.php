<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            return redirect(route('pages.dashboard'));
        }

        return redirect(route('pages.lander'));
    }

    public function lander()
    {
        return view('pages.lander');
    }

    public function dashboard()
    {
        return view('pages.dashboard');
    }
}
