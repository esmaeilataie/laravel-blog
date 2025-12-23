<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Categories\CreateCategoryRequest;
use App\Http\Requests\Panel\Categories\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->paginate();
        $parentCategories = Category::where('category_id', null)->get();

        return view('panel.categories.index',[
            'parentCategories' => $parentCategories,
            'categories' => $categories
        ]);
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create($request->validated());
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
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
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
