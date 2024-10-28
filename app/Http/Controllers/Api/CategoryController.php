<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        try {
            $categories = Category::all();
            if (!$categories) {
                return errorResponse('لا يوجد بيانات');
            }
            return successResponse($categories);
        } catch (\Throwable $th) {
            return errorResponse('خطاء في تنفيذ العملية');
        }
    }

    public function show(Category $category){
        try {
            return successResponse($category);
        } catch (\Throwable $th) {
            return errorResponse('خطاء في تنفيذ العملية');
        }
    }
}
