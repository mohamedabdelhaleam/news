<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-articles', ['only' => ['index', 'show']]);
        $this->middleware('permission:edit-article', ['only' => ['edit', 'update']]);
        $this->middleware('permission:add-article', ['only' => ['create', 'store']]);
        $this->middleware('permission:delete-article', ['only' => ['destroy']]);
    }
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view("dashboard.articles.index", compact("articles"));
    }

    public function create()
    {
        return view("dashboard.articles.create");
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "category_id" => "required|exists:categories,id",
            "author" => "required|exists:users,id"
        ]);
        try {
            Article::create($validatedData);
            return redirect()->route("dashboard.articles.show.all")->with("success", "تم تسجيل المقالة بنجاح");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with("error", "خطأ في المقالة الفندق");
        }
    }

    public function edit($article_id)
    {
        $article = Article::find($article_id);
        if (!$article) {
            return redirect()->route('dashboard.articles.show.all');
        }
        return view("dashboard.hotels.edit", compact("hotel"));
    }

    public function update(Request $request, $article_id)
    {
        $data = $request->validate([
            "title" => "nullable|string|max:255",
            "description" => "nullable|string",
            "category_id" => "nullable|exists:categories,id",
            "author" => "nullable|exists:users,id"
        ]);
        $article = Article::find($article_id)->update($data);
        if (!$article) {
            return redirect()->route('dashboard.articles.show.all')->with("error", "المقالة غير موجود ");
        }
        return redirect()->route("dashboard.articles.show.all")->with("success", "تم تعديل بيانات المقالة بنجاح");
    }


    public function destroy($id)
    {
        Article::destroy($id);
        return response()->json(["message" => 'تم حذف المقالة بنجاح']);
    }
}
