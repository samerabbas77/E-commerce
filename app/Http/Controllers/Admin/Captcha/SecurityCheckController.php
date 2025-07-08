<?php

namespace App\Http\Controllers\Admin\Captcha;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Admin\CaptchaService;
use App\Http\Requests\Admin\Captcha\VerfyCaptcaRequest;

class SecurityCheckController extends Controller
{
    protected $captchaService;

     public function __construct(CaptchaService $captchaService)
     {
        $this->captchaService = $captchaService;
     }
    /**
     *  show Captcha page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showCaptcha()
    {
        return view('admin.Captcha.security-check');  
    }

    //................
    //................

    public function verifyCaptcha(VerfyCaptcaRequest $request)
    {
        $result = $this->captchaService->verifyCaptcha($request->validated());

        if($result) return redirect()->route('page-login');

           return redirect()->back()
        ->withErrors(['g-recaptcha-response' => 'فشل التحقق من الكابتشا'])
        ->withInput();;

    }


}
