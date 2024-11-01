<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:add category', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit category', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete category', ['only' => ['destroy']]);
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
            $category->update([
                'name' => $request->name ?? $category->name,
                'description' => $request->description ?? $category->description,
                'image' => $fileName,
                'slug' => $slug,
            ]);
            return redirect()->route("dashboard.categories.index")->with("success", "تم تعديل بيانات الفئة بنجاح");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with("error", "خطأ في تعديل الفئة");
        }
    }
    public function destroy(Category $category)
    {
        $user = Auth::guard('admin')->user();
        if ($user->roles[0]->name != 'super_admin') {
            $category->where('author', $user->id);
        }
        if (!$category) {
            return errorResponse('ليس لديك صلاحيات للحذف');
        }
        $category->delete();
        return successResponse('تم الحذف بنجاح');
    }
}
