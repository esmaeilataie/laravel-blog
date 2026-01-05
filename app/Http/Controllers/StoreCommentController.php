<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class StoreCommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => ['required'],
            'post_id' => ['required' , 'exists:posts,id'],
            'comment_id' => ['nullable', 'exists:comments,id']
        ]);

        $data['user_id'] = auth()->user()->id;

        Comment::create($data);

        return back();
    }
}
