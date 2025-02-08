<?php

namespace App\Service\Auth;

use Exception;
use App\Models\Cart\Cart;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AuthServices
{
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
       *  login a user
       * @param array $data
       * @return array{authorisation: array{token: string, type: string, role: TFirstDefault|TValue, user: mixed}|mixed|\Illuminate\Http\JsonResponse}
       */
      public function login(array $data)
      {
          // Validate user credentials
          $user = User::where('email', $data['email'])->first();
      
          if (!$user || !Hash::check($data['password'], $user->password)) {
              return response()->json(['message' => 'Invalid credentials'], 401);
          }
      
          // Generate Passport token
          $token = $user->createToken('API Token')->accessToken;
      
          return [
              'user' => $user->name,
              'role' => $user->getRoleNames()->first(),
              'authorisation' => [
                  'token' => $token,
                  'type' => 'Bearer',
              ],
          ];
      }

      //......................................................
      //......................................................

      
  
}