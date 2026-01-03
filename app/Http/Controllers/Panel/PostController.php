<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Posts\CreatePostRequest;
use App\Http\Requests\Panel\Posts\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function index(Request $request)
    {

        if (auth()->user()->role !== 'admin') {
            $postsQuery = Post::where('user_id', auth()->user()->id)->with('user');

            if ($request->search){
                $postsQuery->where('title','LIKE',"%{$request->search}%");
            }

            $posts = $postsQuery->paginate();
        } else {
            $postsQuery = Post::with('user');

            if ($request->search){
                $postsQuery->where('title','LIKE',"%{$request->search}%");
            }

            $posts = $postsQuery->paginate();
        }
        return view('panel.posts.index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('panel.posts.create');
    }

    public function store(CreatePostRequest $request)
    {
        
        $categoryIds = Category::whereIn('name', $request->categories)
            ->get()->pluck('id')->toArray();
        if (count($categoryIds) < 1) {
            throw ValidationException::withMessages([
                'categories' => ['دسته بندی یافت نشد']
            ]);
        }

        $file = $request->file('banner');
        $file_name = $file->getClientOriginalName();
        $file->storeAs('images/banners', $file_name, 'public_files');

        $data = $request->validated();
        $data['banner'] = $file_name;
        $data['user_id'] = auth()->user()->id;

        $post = Post::create($data);
        $post->categories()->sync($categoryIds);

        session()->flash('status', 'مقاله ساخته شد!');
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        return view('panel.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $categoryIds = Category::whereIn('name', $request->categories)
            ->get()->pluck('id')->toArray();

        if (count($categoryIds) < 1) {
            throw ValidationException::withMessages([
                'categories' => ['دسته بندی یافت نشد']
            ]);
        }

        $data = $request->validated();

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $file_name = $file->getClientOriginalName();
            $file->storeAs('images/banners', $file_name, 'public_files');
            $data['banner'] = $file_name;
        }

        $post->update($data);
        $post->categories()->sync($categoryIds);

        session()->flash('status', 'مقاله ویرایش شد!');
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();
        session()->flash('status', 'مقاله خذف شد!');

        return back();
    }
}
