<?php
namespace App\Service\Api\User\Two_Step_Authentication;

use Exception;
use RuntimeException;
use Hamcrest\Type\IsObject;
use Illuminate\Support\Str;
use App\Models\Api\User\User;
use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\RestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Twilio\Rest\Api\V2010\Account\MessageInstance;
use App\Service\Api\User\Two_Step_Authentication\OtpProviderInterface;

class SmsProvider implements OtpProviderInterface
{
    public function sendOtp(int $user_id,string $token):array
    {
        try {
            $code = rand(100000, 999999); // Generate OTP

            $user = User::find($user_id);
    
            if (!$user ) 
            {
                throw new Exception("User not found");
            }
    
            if(!$user->phone)
            {
                throw new Exception("User phone not found");
            }
    
            // Use Twilio to send SMS
            $twilio = new \Twilio\Rest\Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

      
            $result = $twilio->messages->create(
                $user->phone, // User's phone number
                    [
                        "from" => env('TWILIO_PHONE_NUMBER'),
                        "body" => "Your verification code is: $code"
                    ]
                );

            // Log successful message
            if (!isset($result->sid) || $result->status !== 'queued') {
                throw new RuntimeException("OTP could not be sent.");
            }

            Log::info("OTP sent successfully to {$user->phone}. Twilio SID: {$result->sid}");

  
            // Generate a temporary verification token
            $otpToken = Str::uuid();
    
            // Store both OTP and token in a single cache entry
            Cache::put("otp_verification_{$otpToken}", [
            'token'  => $token, //the realy token(now its crypted)
            'user_id' => $user->id,
            'code' => $code,
        ], now()->addMinutes(5));

            // Log OTP generation in the database
        $user->otpSetting()->update([
            'last_verified_at' => now(),
            'expired_at' => now()->addMinutes(5)
            ]);

        return [
            'status' => false,
            'otp_token' => Crypt::encrypt($otpToken)];
        
        } catch (Exception $e) {
            Log::error('Error during OTP verification for user: '  . $e->getMessage());
            throw new Exception('Failed to verify OTP: ' . $e->getMessage());
        } 
    }
        
}