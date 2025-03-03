<?php

namespace App\Http\Controllers\Api\User\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Service\Api\User\Auth\AuthServices;

use App\Http\Requests\Api\User\Auth\LoginRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Http\Requests\Api\User\Auth\RegisterRequest;

class AuthController extends Controller
{
  protected $authService;

public function __construct(AuthServices $authService)
{
  $this->authService = $authService;
}



/**
 *  register a user
 * @param RegisterRequest $request
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
    $response = $this->authService->login($request->validated());

    // Handle unauthorized response
    if (!$response) 
    {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Check if two-step authentication is required
    if ($response['Two-Step']) 
    {
      return $this->success(['Two-Step' => true,'otp_token'=>$response['otp_token']], $response['message'], 200);
    }

    // Normal login response
    return $this->success($response, 'User login successfully', 200);
  }

  //................................
  //................................
    /**
     * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function info()
    {
      $info = $this->authService->info();
      return $this->success($info, 'Get User Info Successfully', 200);
    }

    //.......................................
    //........................................
    /**
     * Log the user out (Invalidate the token).
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function logout()
    {  
      auth('api')->logout();
      return response()->json(['message' => 'Successfully logged out']);    
    }

    //...............................
    /**
     * refresh the token
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
      return response()->json([
        'access_token' => Auth::refresh(),
        'token_type' => 'bearer',
        'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }

   

}
