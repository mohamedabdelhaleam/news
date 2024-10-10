<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('dashboard.')->middleware(['auth:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');

    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::get("/", [RoleController::class, 'index'])->name('index');
        Route::get("/add", [RoleController::class, 'create'])->name('add');
        Route::post("/store", [RoleController::class, 'store'])->name('store');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::delete('/role/{role}', [RoleController::class, 'destroy'])->name('destroy');
        Route::patch('/{role}', [RoleController::class, 'update'])->name('update');
    });

    
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get("/", [CategoryController::class, 'index'])->name('index');
        Route::get("/add", [CategoryController::class, 'create'])->name('add');
        Route::post("/store", [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('update');
    });


    Route::group(['prefix' => 'articles', 'as' => 'articles.'], function () {
        Route::get("/", [ArticleController::class, 'index'])->name('index');
        Route::get("/add", [ArticleController::class, 'create'])->name('add');
        Route::post("/store", [ArticleController::class, 'store'])->name('store');
        Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
        Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('destroy');
        Route::patch('/{article}', [ArticleController::class, 'update'])->name('update');
    });

});
