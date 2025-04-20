<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\Auth\AuthController;
use App\Http\Controllers\Api\User\Auth\OauthController;

use App\Http\Controllers\Api\User\Auth\ResetPasswordController;
use App\Http\Controllers\Api\User\Two_Step_Authentication\TwoStepController;
use App\Http\Controllers\Api\User\Two_Step_Authentication\TelegramController;

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
// 1- Apply throttling (10 requests per minute) for authentication-related routes.
// ......................Authentection.................................................
Route::middleware('throttle:10,1')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('/register','register');
        Route::post('/login', 'login');
    
        // Protected routes
        Route::middleware('auth:api')->group(function () {
            Route::get('/info', 'info');
            Route::post('/logout', 'logout');
            Route::post('/refresh', 'refresh');  
        }); 

        //.............Login by Google..................
    Route::controller(OauthController::class)->group(function () {    
        Route::prefix('auth')->group(function () {
            Route::get('/{provider}/redirect', 'redirectToProvider');
            Route::get('/{provider}/callback', 'handleProviderCallback');
        });
    });
    
    });

    //..........Reset Password........
    Route::controller(ResetPasswordController::class)->group(function () {

        Route::post('password/forgot',  'sendResetLink');

        Route::post('password/reset','resetPassword');
    }
    );

    //.......... Two-step authenticaion via Telegram and SMS
    Route::controller(TwoStepController::class)->group(function () {
        //Aplly Two-step Authentecation
        Route::post('/changeUserOtpSetting/{user}','changeUserOtpSetting');
        
        //Send Otp code dependce on the provider that choosen by user
        Route::post('/sendOtpCode','sendOtpCode');

        //Telegram Verify
        Route::post('/verfiy','verifyOtp');

    });
    
});


