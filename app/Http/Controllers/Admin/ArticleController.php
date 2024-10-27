<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\Article\StoreArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:show articles', ['only' => ['index', 'show']]);
        $this->middleware('permission:add article', ['only' => ['edit', 'update']]);
        $this->middleware('permission:edit article', ['only' => ['create', 'store']]);
        $this->middleware('permission:delete article', ['only' => ['destroy']]);
    }
    public function index()
    {
        $user = Auth::guard('admin')->user();
        $articles = Article::orderBy('created_at', 'desc')->get();
        if ($user->roles[0]->name != 'super_admin') {
            $articles->where('author', $user->id);
        }
        return view("admin.articles.index", compact("articles"));
    }


    public function create()
    {
        $categories = Category::all();
        return view("admin.articles.create", compact('categories'));
    }


    public function store(StoreArticleRequest $request)
    {
        $user = Auth::guard('admin')->user();
        try {
            $fileName = uploadImage($request, 'image', 'articles/images');
            $slug = generateSlug($request->title);
            $article = Article::create([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'slug' => $slug,
                'image' => $fileName ?? null,
                'author' => $user->id
            ]);
            if ($article) {
                return redirect()->route("dashboard.articles.index")->with("success", "تم تسجيل المقالة بنجاح");
            }
            return redirect()->back()->withInput()->with("error", "خطأ في أضافة المقالة");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with("error", "خطأ في أضافة المقالة");
        }
    }

    public function edit($article_id)
    {
        $categories = Category::all();
        $article = Article::find($article_id);
        if (!$article) {
            return redirect()->route('dashboard.articles.index');
        }
        return view("admin.articles.edit", compact("article", 'categories'));
    }

    public function update(UpdateArticleRequest $request, $article_id)
    {
        $user = Auth::guard('admin')->user();
        $article = Article::where('id', $article_id)->first();
        if ($user->roles[0]->name != 'super_admin') {
            $article->where('author', $user->id);
        }
        $imageName = uploadImage($request, 'image', 'articles/images') ?? basename($article->image);
        $slug = str_replace(' ', '_', $request->title ?? $article->title);
        $updatedArticle = $article->update([
            'title' => $request->title ?? $article->title,
            'description' => $request->description ?? $article->description,
            'category_id' => $request->category_id ?? $article->category_id,
            'image' => $imageName,
            'slug' => $slug
        ]);
        if (!$article) {
            return redirect()->route('dashboard.articles.index')->with("error", "المقالة غير موجود");
        }
        if (!$updatedArticle) {
            return redirect()->route('dashboard.articles.index')->with("error", "خطأ في تعديل المقالة");
        }
        return redirect()->route("dashboard.articles.index")->with("success", "تم تعديل بيانات المقالة بنجاح");
    }


    public function destroy($article_id)
    {
        $user = Auth::guard('admin')->user();
        $article = Article::where('id', $article_id)->first();
        if ($user->roles[0]->name != 'super_admin') {
            $article->where('author', $user->id);
        }
        if (!$article) {
            return response()->json(["message" => 'خطأ في حذف المقالة']);
        }
        $article->delete();
        return response()->json(["message" => 'تم حذف المقالة بنجاح']);
    }
}
