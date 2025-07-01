<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'signin'])->name('sign-in');
Route::post('/sign-in-process', [AuthController::class, 'signInProcess'])->name('signin.process');

Route::get('/admin/home', function() {
    return view('pages.admin.home');
})->name('admin.home')->middleware('auth');