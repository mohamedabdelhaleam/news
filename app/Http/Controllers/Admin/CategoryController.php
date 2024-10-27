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
            $fullPath = $request->file('image')->store('categories/images', 'public');
            $fileName = basename($fullPath);
            $validatedData['image'] = $fileName;

            $slug = str_replace(' ', '_', $validatedData['name']);
            $validatedData['slug'] = $slug;

            Category::create($validatedData);
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
            $imageName = basename($category->image);
            if ($request->hasFile('image')) {
                $fullPath = $request->file('image')->store('categories/images', 'public');
                $imageName = basename($fullPath);
            }
            $slug = str_replace(' ', '_', $validatedData['name'] ?? $category->name);
            $successUpdated = $category->update([
                'name' => $validatedData['name'] ?? $category->name,
                'description' => $validatedData['description'] ?? $category->description,
                'image' => $imageName,
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
