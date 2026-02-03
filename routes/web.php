<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('pages.home');
Route::redirect('/home', '/')->name('home');
Route::get('/lander', [PageController::class, 'lander'])->name('pages.lander');
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('pages.dashboard');
Route::get('/legal/{section}', [PageController::class, 'legal'])->name('pages.legal');
Route::get('/recent-users', [PageController::class, 'recent_users'])->name('pages.recent_users');







Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/auth/{provider}/redirect', [AuthController::class, 'redirectToProvider'])->name('auth.redirect');
Route::get('/auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);