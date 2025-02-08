<?php

namespace App\Http\Controllers\User;


use App\Service\Auth\AuthServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
  protected $authService;

public function __construct(AuthServices $authService)
{
  $this->authService = $authService;
}



/**
 *  register a user
 * @param \App\Http\Requests\Auth\RegisterRequest $request
 * @return mixed|\Illuminate\Http\JsonResponse
 */
public function register(RegisterRequest $request)
{
  $user = $this->authService->register($request->validated());
  return $this->success($user, 'User registered successfully', 201);
}

//.................................
//.................................

/**
* Get a JWT via given credentials.
*
* @param LoginRequest $request
* @return JsonResponse
*/
  public function login(LoginRequest $request): JsonResponse
  {
    $token = $this->authService->login($request->validated());
    if (!$token) 
    {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    return $this->success($token, 'User login successfully', 200);
  }

//   /**
//   * Get the authenticated User.
//   *
//   * @return \Illuminate\Http\JsonResponse
//   */
//   public function info()
//   {
//  return response()->json(auth()->user());
//   }
//   /**
//   * Log the user out (Invalidate the token).
//   *
//   * @return \Illuminate\Http\JsonResponse
//   */
//   public function logout()
//   {
//  auth()->logout();
//  return response()->json(['message' => 'Successfully logged out']);
//   }
//   /**
//   * Refresh a token.
//   *
//   * @return \Illuminate\Http\JsonResponse
//   */
//   public function refresh()
//   {
// return $this->respondWithToken(Auth::refresh());
//   }
//   /**
//   * Get the token array structure.
//   *
//   * @param string $token
//   *
//   * @return \Illuminate\Http\JsonResponse
//   */
//   protected function respondWithToken($token)
//   {
//  return response()->json([
//  'access_token' => $token,
//  'token_type' => 'bearer',
//  'expires_in' => Auth::factory()->getTTL() * 60
//  ]);
//   }

// }
// Service................................................................................................
// <?php
// namespace App\Services\Auth;

// use App\Http\Resources\UserResource;
// use App\Models\User;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

// class AuthServices
// {
//   /**
//   * register a user
//   * @param array $data
//   * @return User
//   */
//   public function register(array $data)
//   {
//  $user = new User();
//  $user->name = $data['name'];
//  $user->email = $data['email'];
//  $user->password = Hash::make($data['password']);
 
//  $user->save();
//  return  $user;
//   }
//  /*
//     @param array $credentials
//     @return $token
//     */
//     public function login(array $credentials): ?string
//     {
//       if ($token = Auth::attempt($credentials)) {
//       return $token;
//       }
//       return null;
//     }

// }
// .....................................................................................................................................
// RegisterRequest
// <?php

// namespace App\Http\Requests\Auth;

// use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Http\Exceptions\HttpResponseException;

// class RegisterRequest extends FormRequest
// {
//   /**
//   * Determine if the user is authorized to make this request.
//   */
//   public function authorize(): bool
//   {
//     return true;
//   }

//   /**
//   * Get the validation rules that apply to the request.
//   *
//   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
//   */
//   public function rules(): array
//   {
//     return [
     
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|unique:users|max:255',
//         'password' => 'required|string|confirmed|min:8',
//     ];
//   }

//   public function passedValidation()
//   {  
//       $this->merge([
//         'role' => 'user'
//       ]);     
//   }

  
//   protected function  failedValidation(\Illuminate\contracts\Validation\Validator $validator) 
//   { 
//     throw new HttpResponseException(response()->json([ 
//     'status'=>'error', 
//     'message'=>'Please check the input', 
//     'errors'=>$validator->errors(), 
//     ])); 
//   } 
// }

// .............................................................................................................................
// LoginRequest


// <?php

// namespace App\Http\Requests\Auth;

// use Illuminate\Foundation\Http\FormRequest;

// class LoginRequest extends FormRequest
// {
//   /**
//   * Determine if the user is authorized to make this request.
//   */
//   public function authorize(): bool
//   {
//     return true;
//   }

//   /**
//   * Get the validation rules that apply to the request.
//   *
//   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
//   */
//   public function rules(): array
//   {
//     return [
//      'email' => 'required|email|max:255',
//      'password' => 'required|string|min:8',

//  ];
//  }
}
