<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Http\Controllers\Controller;    
use App\Service\Api\User\Auth\OauthService;

class OauthController extends Controller
{
 
    protected $OauthService;

    public function __construct(OauthService $OauthService)
    {
      $this->OauthService = $OauthService;
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
        $data =  $this->OauthService->redirectToProvider($provider);
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
     * @param string $provider
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function handleProviderCallback(string $provider)
    {
        $data = $this->OauthService->handleProviderCallback($provider);
        if($data == null){
          return 
          $this->error('Invalid provider', 422);
        }
        return $this->success($data,'User login successfully', 200);
    }

}