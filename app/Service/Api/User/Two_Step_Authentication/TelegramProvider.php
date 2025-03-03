<?php

namespace App\Service\Api\User\Two_Step_Authentication;

use Exception;
use Illuminate\Support\Str;
use App\Models\Api\User\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use SomarKesen\TelegramGateway\Facades\TelegramGateway;
use App\Service\Api\User\Two_Step_Authentication\OtpProviderInterface;

class TelegramProvider implements OtpProviderInterface
{

    public function sendOtp( $user_id,string $token):array
    {
        try {
                // Generate a random OTP(code to send)
                $otp = rand(100000, 999999);
            
                $user = User::find($user_id);
                if (!$user ) 
                {
                    throw new Exception("User not found");
                }

                if(!$user->phone)
                {
                    throw new Exception("User phone not found");
                }

                // Send OTP via Telegram
                $response=TelegramGateway::sendVerificationMessage($user->phone, [
                    'code' => $otp,
                    'ttl' => 300,  //5 Min
                    'redirct' =>url('verify-otp')
                ]);
                
                if (!$response || !isset($response['result'])) {
                    throw new Exception('An error occurred while sending the verification code. Please try again.');
                }

                // Generate a temporary verification token 
                $otpToken =  Str::uuid();
                
                
                // Store both OTP and token in a single cache entry
                Cache::put("otp_verification_{$otpToken}", [
                    'token'  => $token , //the realy token(now its crypted)
                    'user_id' => $user->id,
                    'code' => $otp
                ], now()->addMinutes(5));


                // Log OTP generation in the database
                $user->otpSetting()->update([
                    'last_verified_at' => now(),
                    'expired_at' => now()->addMinutes(5)
                ]);

                return [
                    'status' => true,
                    'otp_token' => Crypt::encrypt($otpToken)];

        } catch (Exception $e) {
            Log::error('Error during OTP verification for user: '  . $e->getMessage());
            throw new Exception('Failed to verify OTP: ' . $e->getMessage());
        }
    }


}