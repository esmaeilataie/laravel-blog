<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\LikePostController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\CommentController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\EditorUploadController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Panel\ProfileController as MyProfileController;
use App\Http\Controllers\ShowPostController;
use App\Http\Controllers\StoreCommentController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class,'index'])->name('home');

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/post/{post:slug}',[ShowPostController::class,'show'])->name('post.show');
Route::middleware(['auth'])->post('/comment',[StoreCommentController::class,'store'])->name('comment.store');
Route::middleware(['auth'])->post('/like/{post:slug}', [LikePostController::class,'store'])->name('like.post');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth',IsAdminMiddleware::class])->prefix('/panel')->group(function(){
    Route::resource('/users',UserController::class)->except('show');
    Route::resource('/categories',CategoryController::class)->except(['show','create']);
    Route::get('/comments',[CommentController::class,'index'])->name('comments.index');
    Route::delete('/comments/{comment}',[CommentController::class,'destroy'])->name('comments.destroy');
    Route::put('/comments/{comment}',[CommentController::class,'update'])->name('comments.update');
});

Route::middleware(['auth','can:edit'])->prefix('/panel')->group(function(){
    Route::resource('/posts',PostController::class);
});

Route::post('/editor/upload',[EditorUploadController::class,'upload'])->name('editor-upload');

Route::middleware('auth')->get('/_profile',[MyProfileController::class,'edit'])->name('_profile.edit');
Route::middleware('auth')->put('/_profile',[MyProfileController::class,'update'])->name('_profile.update');



require __DIR__.'/auth.php';
