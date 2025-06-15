<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\Api\User\UserService;
use App\Http\Requests\Api\User\UpdatePrivecySettingRequest;

class UserController extends Controller
{

    protected $userservice; 

    public function __construct(UserService $userService)
    {
        $this->userservice = $userService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //.............................................................................
    //.............................................................................

    /**
     * update PrivacySetting for current user only
     * @param \App\Http\Requests\Api\User\UpdatePrivecySettingRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function updatePrivacySetting(UpdatePrivecySettingRequest $request)
    {
        $this->userservice->updatePrivacySetting($request->validated());

        return $this->success('Privacy setting updated successfully.');
    }
}
