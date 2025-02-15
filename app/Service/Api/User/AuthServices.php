<?php

namespace App\Service\Api\User;

use Exception;
use App\Models\Cart\Cart;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Service\Api\Photo\PhotoService;
use Laravel\Socialite\Facades\Socialite;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

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
              throw new Exception('Failed to register user: ' . $e->getMessage());
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
         
          if (! $token = auth('api')->attempt($credentials)) {
              return [];
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

      public function info()
      {
        $gender = auth('api')->user()->is_male ? 'male' : 'female';
        return [
            'first_name' => auth('api')->user()->first_name,
            'last_name' => auth('api')->user()->last_name,
            'email' => auth('api')->user()->email,
            'Gender' => $gender
        ];
      }
      //........................................Aoth Auentication................................
      //.........................................................................................
          /**
     * Redirect the user to the OAuth provider.
     *
     * @param string $provider
     * @return mixed
     * @throws \Exception
     */
    public function redirectToProvider(string $provider)
    {
        if (!in_array($provider, ['google', 'facebook', 'linkedin'])) {
            return null;
        }
        return Socialite::driver($provider)->stateless()->redirect();  }


      /**
       * Handle the OAuth provider callback and authenticate the user.
       * @param string $provider
       * @return mixed|\Illuminate\Http\JsonResponse
       * @method static \Laravel\Socialite\Contracts\Provider driver(string $driver)
       */
      public function handleProviderCallback(string $provider)
    {
        if (!in_array($provider, ['google', 'facebook', 'linkedin'])) {
            return null;
        }

        try {
          $socialUser = Socialite::driver($provider)->stateless()->user();
          
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid credentials provided'], 422);
        }
        
        $name = explode(' ', $socialUser->name);
       
        $user = DB::transaction(function () use ($socialUser, $provider,$name) {
            $user = User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'first_name' => $name[0] ?? null,
                    'last_name' => $name[1] ?? null,
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make('pasSword123#'),
                ]
            );
            
            Cart::firstOrCreate(['user_id' => $user->id]);

            $user->providers()->updateOrCreate(
                [
                    'provider' => $provider,
                    'provider_id' => $user->id,
                ]
             );

            return $user;
        });
        
        return response()->json([
            'user' => $user->first_name.' '.$user->last_name,
            'token' => JWTAuth::fromUser($user),
            'token_type' => 'bearer',
        ]);
      
    }
  
  
}