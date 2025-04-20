<?php

namespace App\Service\Api\User\Auth;

use Exception;
use App\Models\Api\Cart\Cart;
use App\Models\Api\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Service\Api\Photo\PhotoService;
use App\Service\Api\User\Two_Step_Authentication\TelegramProvider;
use Laravel\Socialite\Facades\Socialite;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Service\Api\User\Two_Step_Authentication\TelegramService;
use App\Service\Api\User\Two_Step_Authentication\VerificationCodeService;

class AuthServices
{
    
    protected  $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }
    
      /**
       * create an user
       * @param array $data
       * @return User|\Illuminate\Database\Eloquent\Model
       */
      public function createUser(array $data): User
      {
          return User::create([
              'first_name' => $data['first_name'],
              'last_name' => $data['last_name'],
              'email' => $data['email'],
              'password' => Hash::make($data['password']),
              'phone' => $data['phone'],
              'address' => $data['address'],
              'is_male' => $data['is_male'],
              'birthdate' => $data['birthdate'],
              'telegram_user_id' => $data['telegram_user_id'],
          ]);
      }
      //.................................
      //.................................

      /**
       * register a user
       * we create an cart for user when he register
       * we give him  'customer' deffualt role (in migration the role deffult is customer)
       * @param array $data
       * @return User|\Illuminate\Database\Eloquent\Model
       */
      public function register(array $data): User
      {
          DB::beginTransaction();
          try {
              $user = $this->createUser($data);
              DB::commit();
              Cart::create(['user_id' => $user->id]);
              if (isset($data['avatar'])) {
                // $result = $this->photoService->storePhoto($data['avatar'], $user, 'avatars');
                // dispatch(new ProcessUserAvatar($user, $data['avatar']));

            } else {
                // $this->photoService->addDefaultAvatar($user);
            }
              
              return $user;
          } catch (Exception $e) {
              DB::rollBack();
              Log::error('Error while registering a user: ' . $e->getMessage());
              throw new Exception('Failed in the server: ' . $e->getMessage());
          }
      }

      //................................................................................
      //................................................................................

      /**
       *       * login a user
       * we create a access token and refresh token
       * access token expire in short time
       * refresh usee to expand the acess token 
       * and it expire in long time
       * checkDualAuth is for:
       * *##  If user is set is_enabled in user_otp_settings table (true) 
        * then he want to apply two-step authentication (dual Authentecation)
        * so after check the credentials that he give we send telegram  or sms code
        *OTP is one time password
       * @param array $data
       * @throws \Exception
       * @return array{authorisation: array{access_token: bool, token_type: string, role: mixed, user: string}|bool}
       */
      public function login(array $data)
      {
        try{
            
            // Validate user credentials
            $user = User::where('email', $data['email'])->first();
        
            $credentials = request(['email', 'password']);
           
            if(!$token = auth('api')->attempt($credentials))
            {
                return [];
            }

            //check if user apply dual authentication   
            if($otpToken = VerificationCodeService::checkDualAuth($user,$token))
            {
                
                return [
                    'Two-Step' => true,
                    'message' => 'you need to choose your provider',
                    'otp_token' => $otpToken,                   
                ];
            }             
            
            return [
                'Two-Step' => false,
                'authorisation' => [
                    'token_type' => 'Bearer',
                    'access_token' =>$token 
                ],
            ];
        
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error while Login a user: ' . $e->getMessage());
            throw new Exception('Failed in the server: ' . $e->getMessage());
        }
      }
     

    //.........................
      //.........................
      public function info()
      {
        try {
            $gender = auth('api')->user()->is_male ? 'male' : 'female';
            return [
                'first_name' => auth('api')->user()->first_name,
                'last_name' => auth('api')->user()->last_name,
                'email' => auth('api')->user()->email,
                'Gender' => $gender
            ];
        } catch (Exception $e) {
            Log::error('Error while Get  a user: info ' . $e->getMessage());
            throw new Exception('Failed in the server: ' . $e->getMessage());
        }

      }
  
  
}