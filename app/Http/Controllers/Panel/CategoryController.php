<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate();
        $parentCategories = Category::where('category_id', null)->get();

        return view('panel.categories.index',[
            'parentCategories' => $parentCategories,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string','max:255'],
            'slug' => ['required' ,'string', 'max:255', 'unique:categories,slug'],
            'category_id' => ['nullable','exists:categories,id']
        ]);

        Category::create($validated);
        Session::flash('status','دسته بندی ساخته شد!');
        return back();
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::where('category_id' , null)->where('id','!=',$category->id)->get();
        return view('panel.categories.edit',[
            'category' => $category,
            'parentCategories' => $parentCategories
        ]);
    }
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string','max:255'],
            'category_id' => ['nullable','exists:categories,id']
        ]);

        $category->update($validated);
        Session::flash('status','دسته بندی آپدیت شد!');
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('status','دسته بندی حذف شد!');
        return back();
    }
}
