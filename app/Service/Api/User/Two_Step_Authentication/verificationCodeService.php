<?php

namespace App\Service\Api\User\Two_Step_Authentication;

use Exception;
use App\Models\Api\User\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Models\Api\Api\User\UserOtpSetting;
use Illuminate\Support\Facades\Crypt;

class VerificationCodeService
{
    /**
     * Enable or didable the Two_Step Authentication Feature
     * @param mixed $user
     * @throws \Exception
     * @return bool
     */
    public function changeUserOtpSetting($user)
    {
      try {
    
        if(($user->role != 'Admin') && ($user->id != auth('api')->user()->id))
        {
            return false;
        }

          $user->otpSetting->update([
              'is_enabled' => !$user->otpSetting->is_enabled,
          ]);
          
        return true;
     
      } catch (Exception $e) {
          Log::error('Error while change otp setting: ' . $e->getMessage());
          throw new Exception('Failed in the server: ' . $e->getMessage());
      }
    }

    //...............................................................
    //...............................................................

     /**
       * check if user have number and enable the otp option
       * if that, create token (one use token to make sure
       *  the user how login is same how choose way to send code)
       * @param mixed $user
       * @param mixed $token
       * @throws \Exception
       */
      public static function checkDualAuth($user,$token)
      {
        try {
            // Check if OTP is enabled
            if ($user->otpSetting && $user->otpSetting->is_enabled) 
            {                  

                // Generate a temporary verification token 
                $otpToken =  Str::uuid();
                              
                // Store both OTP and token in a single cache entry
                Cache::put("otp_choose_{$otpToken}", [
                    'token'  =>Crypt::encryptString($token) , //the realy token
                    'user_id' => $user->id
                ], now()->addMinutes(5));
   
                return Crypt::encrypt($otpToken);
            }
           return null ;
        } catch (Exception $e) {
            Log::error('Error while check the dual option of a user: ' . $e->getMessage());
            throw new Exception('Failed in the server: ' . $e->getMessage());
        }
      }

      //...........................................
      //...........................................
      
    /**
     * Summary of sendOtpCode
     * @param mixed $data
     * @throws \Exception
     * @return array
     */
    public function sendOtpCode($data)
    {
        try {
            //Decrypt otp token
            $otp_token = Crypt::decrypt($data['otp_token']);
            
            $allData = Cache::get("otp_choose_{$otp_token}");
           
            if(!$allData) 
            {
                throw new Exception('otp token not found');
            } 
       
            //delete cache info so the opt token used one time only
            Cache::forget("otp_choose_{$otp_token}");
            
            $user = User::find($allData['user_id']);

            if (!$user) 
            {
                throw new Exception('User not found');
            }

            // Ensure otpSetting exists before updating
            $user->otpSetting()->updateOrCreate(
                ['user_id' => $user->id],
                ['provider' => $data['provider']
            ]);
        
         
            // Get the correct OTP provider
            $provider = OtpProviderFactory::create($data['provider']);
            
             // Send OTP and return response
             return $provider->sendOtp($user->id,$allData['token']); 

        } catch (Exception $e) {
            Log::error('Error while send otp code to a user: ' . $e->getMessage());
            throw new Exception('An error occurred while processing your request. ' . $e->getMessage());
        }
    }

    
   //................................................................................
   //................................................................................

      /**
     *      *     * OTP is One-Time Password
     *  If user is set is_enabled in user_otp_settings table (true) 
     * then he want to apply two-step authentication (dual Authentecation)
     * so after check the credentials that he give we send telegram code
     * we check here if the code thad he give is same that we send
     * @param array $data
     * @throws \Exception
     * @return array{authorisation: array{access_token: mixed, token_type: string, role: mixed, user: string}|array{message: string, status: bool}}
     */
    public function verifyOtp( $data)
    {
    try {
        
        $otpToken = Crypt::decrypt($data['verify_send_token']);
       
        $otpData = Cache::get("otp_verification_{$otpToken}");
       
        // // Clear the cached data after successful verification
        Cache::forget("otp_verification_{$otpToken}");
       
        // //check if the otp (code) is valid
        if (!$otpData || $otpData['code'] != $data['code'] ) {
            return [
                'status' => false,
                'message' => 'Invalid  OTP'];
        }

        $user = User::find($otpData['user_id']);

        if (!$user ) {
            return [
                'status' => false,
                'message' => 'User not found'
            ];
        }
        
        // Check if the OTP has expired (consider checking cache expiration too)
        if (now()->greaterThan($user->otpSetting->expire_at)) {
            return [
                'status' => false,
                'message' => 'Expired OTP'
            ];
        }
        

        return [
            'status' => true,
            'user' => $user->first_name.' '.$user->last_name,
            'role' => $user->role,
            'authorisation' => [
                'token_type' => 'Bearer',
                'access_token' =>Crypt::decryptString($otpData['token']) ,//dencrypt token
            ]
            ];

    } catch (Exception $e) {
        Log::error('Error during OTP verification for user: ' . $data['email'] . ' - ' . $e->getMessage());
        throw new Exception('Failed to verify OTP: ' . $e->getMessage());
    }
}
}