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
            // Load user and category relationships
            $article->load(['user', 'category']);

            return successResponse($article);
        } catch (\Throwable $th) {
            return errorResponse('خطاء في تنفيذ العملية');
        }
    }
}
