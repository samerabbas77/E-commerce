<?php

namespace App\Http\Controllers\Api\User;


use Illuminate\Http\Request;
use App\Service\Api\User\AuthServices;
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
      $info = $this->authService->info();
      return $this->success($info, 'Get User Info Successfully', 200);
    }

    //.......................................
    //........................................
    /**
     *  Log the user out (Invalidate the token).
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function logout()
    {
     // Revoke the current access token
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

    //..........................................OAth Authentiction................................................
    //...................................................................................................
        /**
     * Redirect to the OAuth provider for login 
     * (if the procees is currect it will direct you to google or facebook or linkedin)
     * depende on what provider you sit in the request
     *
     * @param string $provider
     * @return mixed
     * @throws \Exception
     */
    public function redirectToProvider(string $provider): mixed
    {
        $data =  $this->authService->redirectToProvider($provider);
        if($data == null)
        {
          return $this->error('Invalid provider', 422);
        }
        return $data;
    }
    //...................................
    //..................................

    /**
     * Handle the callback from the OAuth provider
     *
     * @param string $provider
     * @return JsonResponse
     * @throws \Exception
     */
    public function handleProviderCallback(string $provider)
    {
        $data = $this->authService->handleProviderCallback($provider);
        if($data == null){
          return 
          $this->error('Invalid provider', 422);
        }
        return $this->success($data,'User login successfully', 200);
    }


}
