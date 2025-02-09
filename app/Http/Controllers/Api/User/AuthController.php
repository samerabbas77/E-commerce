<?php

namespace App\Http\Controllers\Api\User;


use Illuminate\Http\Request;
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

  //................................
  //................................
    /**
     * Get the authenticated User.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function info()
    {
         return response()->json(auth()->user());
    }

    //.......................................
    //........................................
    /**
     * Log the user out (Invalidate the token).
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function logout(Request $request)
    {
        $user = auth('api')->user();
    
        if ($user) {
            // Revoke the current access token
            $request->user()->token()->revoke();
    
            return response()->json(['message' => 'Successfully logged out']);
        }
    
        return response()->json(['message' => 'User not found'], 404);
    }

    //...............................
   


}
