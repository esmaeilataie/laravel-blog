<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $postsCount = Post::count();
        $commentsCount = Comment::count();
        $categoriesCount = Category::count();

        if (auth()->user()->role === 'author') {
            $postsCount = Post::where('user_id', auth()->user()->id)->count();
            $commentsCount = Comment::whereHas('post', function ($query) {
                return $query->where('user_id', auth()->user()->id);
            })->count();
        }
        return view('panel.dashboard', [
            'usersCount' => $usersCount,
            'postsCount' => $postsCount,
            'commentsCount' => $commentsCount,
            'categoriesCount' => $categoriesCount
        ]);
    }
}
