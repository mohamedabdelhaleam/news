<?php

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\ProfileController;
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

// Route::post('/login', [CustomerController::class, 'login'])->name('login');
// Route::post('/verify', [CustomerController::class, 'verify'])->name('verify');
// Route::post('/complete-profile', [CustomerController::class, 'complete_profile'])->name('complete_profile');
// Route::post('/add-car', [CustomerController::class, 'add_car'])->name('add_car');
// Route::post('/generate-qr', [CustomerController::class, 'generate_qr'])->name('generate_qr');
// Route::post('/scan-qr', [CustomerController::class, 'scan_qr'])->name('scan_qr');



Route::get('/', function () {
    return view('website.index');
});
Route::get('/tst', function () {
    return ('tst');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
