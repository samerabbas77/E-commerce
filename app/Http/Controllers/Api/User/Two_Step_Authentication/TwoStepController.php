<?php

namespace App\Http\Controllers\Api\User\Two_Step_Authentication;

use App\Models\Api\User\User;

use App\Http\Controllers\Controller;
use App\Service\Api\User\Two_Step_Authentication\VerificationCodeService;
use App\Http\Requests\Api\User\Two_Step_Authentication\SendOtpCodeRequest;
use App\Http\Requests\Api\User\Two_Step_Authentication\VerifyTelegramCodeRequest;


class TwoStepController extends Controller
{
    protected $verificationCodeService;
   
    public function __construct(VerificationCodeService $verificationCodeService) {
        $this->verificationCodeService = $verificationCodeService;
    }


//....................................................
//....................................................

/**
 * Enable or didable the Two_Step Authentication Feature
 * @param \App\Models\Api\User\User $user
 * @return mixed|\Illuminate\Http\JsonResponse
 */
public function changeUserOtpSetting(User $user)
{
    $result = $this->verificationCodeService->changeUserOtpSetting($user);
    
    if($result)
    {
        return $this->success(null, 'User otp  is Changed To : '. ($user->otpSetting->is_enabled ? 'Enabled' : 'Disabled') , 200);
    }

    return $this->error('User Not Allowed to do this', 400);
}

//...........................................................
//...........................................................
public function sendOtpCode(SendOtpCodeRequest $request)
{
    $result =$this->verificationCodeService->sendOtpCode($request->validated());
    
    if($result['status'] )return $this->success( ['otp_token' => $result['otp_token']], 'Code send via Telegram', 200);

    return $this->success(['otp_token' => $result['otp_token']], 'Code send via SMS', 200);
}




//...........................................................
//...........................................................
    /**
     * check toe code user send it by request
     * @param VerifyTelegramCodeRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function verifyOtp(VerifyTelegramCodeRequest $request)
{
    $response = $this->verificationCodeService->verifyOtp( $request->validated());

    if($response['status'] == false) 
    {
       return $this->error((string)$response['message'], 400); 
    }
    return $this->success($response, 'User login successfully', 200);
}
}
