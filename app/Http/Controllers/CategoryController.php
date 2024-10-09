<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-categories', ['only' => ['index', 'show']]);
        $this->middleware('permission:edit-category', ['only' => ['edit', 'update']]);
        $this->middleware('permission:add-category', ['only' => ['create', 'store']]);
        $this->middleware('permission:delete-category', ['only' => ['destroy']]);
    }
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view("dashboard.categories.index", compact("categories"));
    }

    public function create()
    {
        return view("dashboard.categories.create");
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
        ]);
        try {
            Category::create($validatedData);
            return redirect()->route("dashboard.categories.show.all")->with("success", "تم تسجيل الفئة بنجاح");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with("error", "خطأ في تسجيل الفئة");
        }
    }

    public function edit($category_id)
    {
        $category = Category::find($category_id);
        if (!$category) {
            return redirect()->route('dashboard.categories.show.all');
        }
        return view("dashboard.categories.edit", compact("hotel"));
    }

    public function update(Request $request, $category_id)
    {
        $data = $request->validate([
            "name" => "nullable|string|max:255",
            "location" => "nullable|string"
        ]);
        $category = Category::find($category_id)->update($data);
        if (!$category) {
            return redirect()->route('dashboard.categories.show.all')->with("error", "الفئة غير موجود ");
        }
        return redirect()->route("dashboard.categories.show.all")->with("success", "تم تعديل بيانات الفئة بنجاح");
    }


    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(["message" => 'تم حذف الفئة بنجاح']);
    }
}
