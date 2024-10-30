<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        try {
            $articles = Article::with(['user', 'category'])->get();
            if (!$articles) {
                return errorResponse('لا يوجد بيانات');
            }
            return successResponse($articles);
        } catch (\Throwable $th) {
            return errorResponse('خطاء في تنفيذ العملية');
        }
    }

    public function show(Article $article)
    {
        try {
            $article->load(['user', 'category']);
            if (!$article) {
                return errorResponse('لا يوجد بيانات');
            }
            return successResponse($article);
        } catch (\Throwable $th) {
            return errorResponse('خطاء في تنفيذ العملية');
        }
    }
}
