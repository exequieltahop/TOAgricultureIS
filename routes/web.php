<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersListController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'signin'])->name('sign-in');
Route::post('/sign-in-process', [AuthController::class, 'signInProcess'])->name('signin.process');
Route::get('/sign-out', [AuthController::class, 'signOut'])->name('signout');

// admin
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('admin.dashboard');
Route::get('/admin/users/list', [UsersListController::class, 'index'])->middleware('auth')->name('admin.users.list');
