<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:add category,admin'])->only(['create', 'store']);
        $this->middleware(['permission:edit category,admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete category,admin'])->only(['destroy']);
    }
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view("admin.categories.index", compact("categories"));
    }
    public function create()
    {
        return view("admin.categories.create");
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $fileName = uploadImage($request, 'image', 'categories/images');
            $slug = generateSlug($request->name);
            Category::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $fileName,
                'slug' => $slug
            ]);
            return redirect()->route("dashboard.categories.index")->with("success", "تم تسجيل الفئة بنجاح");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with("error", "خطأ في تسجيل الفئة");
        }
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $fileName = uploadImage($request, 'image', 'categories/images') ?? basename($category->image);
            $slug = generateSlug($request->name) ?? $category->slug;
            $successUpdated = $category->update([
                'name' => $request->name ?? $category->name,
                'description' => $request->description ?? $category->description,
                'image' => $fileName,
                'slug' => $slug,
            ]);
            if (!$successUpdated) {
                return redirect()->back()->withInput()->with("error", "خطأ في تعديل الفئة");
            }
            return redirect()->route("dashboard.categories.index")->with("success", "تم تعديل بيانات الفئة بنجاح");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with("error", "خطأ في تعديل الفئة");
        }
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success', 'تم حذف الفئة بنجاح');
    }
}
