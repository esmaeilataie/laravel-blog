<?php

namespace App\Http\Controllers;

use App\Models\Category;

class ShowPostCategory extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->paginate(1);
        return view('landing',[
            'posts' => $posts
        ]);
    }
}
