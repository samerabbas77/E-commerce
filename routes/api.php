<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;
use Laravel\Passport\Http\Controllers\AccessTokenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Authentection
Route::controller(AuthController::class)->group(function () {
    Route::post('/register','register');
    Route::post('/login', 'login');
    
    // Protected routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/info', 'info');
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');  
    });  
    
    Route::prefix('auth')->group(function () {
        Route::get('/{provider}/redirect', 'redirectToProvider');
        Route::get('/{provider}/callback', 'handleProviderCallback');
});
 
});



