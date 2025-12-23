<?php

use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/dashboard', function () {
    return view('panel.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','can:edit'])->prefix('/panel')->group(function(){
    Route::resource('/users',UserController::class)->except('show');
    Route::resource('/categories',CategoryController::class)->except(['show','create']);
    Route::resource('/posts',PostController::class);
});

Route::middleware('auth')->get('/_profile',fn() => 'profile')->name('_profile');

require __DIR__.'/auth.php';
