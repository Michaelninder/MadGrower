<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

    public function legal(string $section)
    {
        $sections = config('madgrower.legal_sections');

        if (!array_key_exists($section, $sections)) {
            abort(404, __('errors.customs.404.legal.message'));
        }
    }

    public function recent_users()
    {
        $users = User::latest()->get();
        return view('pages.recent_users', compact('users'));
    }
}
