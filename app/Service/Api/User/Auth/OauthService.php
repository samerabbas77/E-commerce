<?php

namespace App\Service\Api\User\Auth;

use Exception;
use App\Models\Api\Cart\Cart;
use App\Models\Api\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class OauthService
{
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
        if (!in_array($provider, ['google'])) {
            throw new \InvalidArgumentException("Unsupported provider: {$provider}");
        }
        return Socialite::driver($provider)->stateless()->redirect(); 
         }


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
             /** @var \Illuminate\Http\Request $request */
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