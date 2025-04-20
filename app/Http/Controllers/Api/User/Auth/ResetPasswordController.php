<?php

namespace App\Http\Controllers\Api\User\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;


use App\Service\Api\User\Auth\ResetPasswordService;
use App\Http\Requests\Api\User\ResetPassword\ResetPasswordRequest;
use App\Http\Requests\Api\User\ResetPassword\ForgotPasswordRequest;

class ResetPasswordController extends Controller
{
    protected $resetPasswordService;

    public function __construct(ResetPasswordService $resetPasswordService)
    {
        $this->resetPasswordService = $resetPasswordService;
    }

    /**
     * Send a password reset link to the user's email.
     *
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function sendResetLink(ForgotPasswordRequest $request): JsonResponse
    {
        try {
            $this->resetPasswordService->sendResetLink($request->validated());

            return response()->json([
                'message' => 'Password reset link has been sent to your email.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }

    /**
     * Reset the user's password using the provided token.
     *
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        try {
            $this->resetPasswordService->resetPassword($request->validated());

            return response()->json([
                'message' => 'Password has been reset successfully. Please log in with your new password.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode() ?: 400);
        }
    }
}
