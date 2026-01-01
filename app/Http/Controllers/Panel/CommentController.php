<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::with(['user','post'])->withCount('replies')->paginate();
        return view('panel.comments.index',[
            'comments' => $comments
        ]);
    }


    public function destroy(Comment $comment)
    {
        //
    }
}
