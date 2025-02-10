<?php

namespace App\Service\Api\Auth;

use Exception;
use App\Models\Cart\Cart;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Service\Api\Photo\PhotoService;
use Illuminate\Support\Facades\Auth;

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
              Cart::create(['user_id' => $user->id]);
              if (isset($data['avatar'])) {
                // $result = $this->photoService->storePhoto($data['avatar'], $user, 'avatars');
            } else {
                // $this->photoService->addDefaultAvatar($user);
            }
              DB::commit();
              return $user;
          } catch (Exception $e) {
              DB::rollBack();
              Log::error('Error while registering a user: ' . $e->getMessage());
              throw new Exception('Failed to register user: ' . $e->getMessage());
          }
      }

      //................................................................................
      //................................................................................

      /**
       * login a user
       * we create a access token and refresh token
       * access token expire in short time
       * refresh usee to expand the acess token 
       * and it expire in long time
       * @param array $data
       * @return array{authorisation: array{access_token: mixed, expires_in: mixed, refresh_token: mixed, token_type: string, role: TFirstDefault|TValue, user: mixed}|mixed|\Illuminate\Http\JsonResponse}
       */
      public function login(array $data)
      {
        try{
          // Validate user credentials
          $user = User::where('email', $data['email'])->first();
       
          $credentials = request(['email', 'password']);

          if (! $token = auth('api')->attempt($credentials)) {
              return response()->json(['error' => 'Unauthorized'], 401);
          }
        
          return [
              'user' => $user->first_name.' '.$user->last_name,
              'role' => $user->role,
              'authorisation' => [
                  'token_type' => 'Bearer',
                  'access_token' =>$token // Expiry time
              ],
          ];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error while registering a user: ' . $e->getMessage());
            throw new Exception('Failed to register user: ' . $e->getMessage());
        }
      }

      //.........................
      //.........................

  
  
}