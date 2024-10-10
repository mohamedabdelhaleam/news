<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
            "description" => "nullable|string",
            "image" => "required|image|mimes:jpeg,png,jpg,gif",
        ]);

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

    public function update(Request $request, Category $category)
    {
        // Validate the request first
        $validatedData = $request->validate([
            "name" => "nullable|string|max:255",
            "description" => "nullable|string",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048", // Optional: specify max size
        ]);

        try {
            // Initialize image variable
            $imageName = $category->image; // Default to current image

            // Check if a new image file is uploaded
            if ($request->hasFile('image')) {
                // Store the new image and get the filename
                $fullPath = $request->file('image')->store('categories/images', 'public');
                $imageName = basename($fullPath);
            }

            // Generate the slug, replacing spaces with underscores
            $slug = str_replace(' ', '_', $validatedData['name'] ?? $category->name);

            // Update the category with validated data
            $successUpdated = $category->update([
                'name' => $validatedData['name'] ?? $category->name,
                'description' => $validatedData['description'] ?? $category->description,
                'image' => $imageName, // Use the existing image or the new one
                'slug' => $slug,
            ]);

            // Handle the update response
            if (!$successUpdated) {
                return redirect()->back()->withInput()->with("error", "خطأ في تعديل الفئة");
            }

            return redirect()->route("dashboard.categories.index")->with("success", "تم تعديل بيانات الفئة بنجاح");
        } catch (\Exception $e) {
            // Log the error message if needed
            // Log::error($e->getMessage());
            return redirect()->back()->withInput()->with("error", "خطأ في تعديل الفئة");
        }
    }



    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success', 'تم حذف الفئة بنجاح');
    }
}
