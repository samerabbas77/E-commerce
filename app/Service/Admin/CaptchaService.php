<?php

namespace App\Service\Admin;

use Illuminate\Support\Facades\Http;
use App\Http\Requests\Admin\Captcha\VerfyCaptcaRequest;


 class CaptchaService
 {
    public function verifyCaptcha($data)
{
    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $data['g-recaptcha-response'],
                'remoteip' => request()->ip(), // نستخدم request() العالمي
        ]);

    if ($response->json('success')) {
        session(['passed_captcha' => true]); // نستخدمها لاحقًا لحماية /login
        return true ;
    }

        return false;
    }

 }