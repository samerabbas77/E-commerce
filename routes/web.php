<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Captcha\SecurityCheckController;
use App\Http\Controllers\Admin\Category\MainCategoryController;

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
    return redirect()->route('security.check');
});

// صفحة تسجيل الدخول (إذا تجاوز التحقق)
Route::controller(LoginController::class)->middleware('throttle:5,1')->group(function () {
  Route::get('/login', 'showLoginForm')->name('page-login');
  Route::post('/login', 'login')->name('login');
  
});

Auth::routes([
    'register' => false,
    'login' => false
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware(['auth:web', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('main_categories', MainCategoryController::class);
});

// Recaptcha by goog reCAPTCHA
Route::controller(SecurityCheckController::class)->group(function () {
   Route::get('/security-check', 'showCaptcha')->name('security.check');
   Route::post('/security-check', 'verifyCaptcha')->name('security.check.verify'); 
});




