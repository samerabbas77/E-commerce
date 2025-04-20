<?php

namespace App\Service\Api\User\Auth;

use Carbon\Carbon;
use App\Models\Api\User\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Api\User\PasswordResetToken;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Notifications\ResetPasswordNotification;

class ResetPasswordService
{
    /**
     * Send a reset password link to the user's email.
     *
     * @param array $data
     * @return void
     * @throws \Exception
     */
    public function sendResetLink(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            throw new \Exception('User with this email does not exist.', 404);
        }

        DB::transaction(function () use ($data, $user) {
            // Delete any existing token
            PasswordResetToken::where('email', $data['email'])->delete();

            // Generate a secure token
            $token = Str::random(32); 

            // Store hashed token in the database
            PasswordResetToken::create([
                'email' => $data['email'],
                'token' => Hash::make($token), // Store hashed token
                'created_at' => now() // Ensure timestamp for expiry check
            ]);

            // Send reset link via email
            $user->notify(new ResetPasswordNotification($token));
        });
    }

    /**
     * Reset the user's password using the provided token and new password.
     *
     * @param array $data
     * @return void
     * @throws \Exception If the token is invalid or has expired.
     */
    public function resetPassword(array $data)
    {
        
        $reset = PasswordResetToken::where('email', $data['email'])->first();

        // Check if token exists and is valid
        if (!$reset || !Hash::check($data['token'], $reset->token)) {
            throw new \Exception('Token is invalid.', 400);
        }

        // Ensure the token has not expired (valid for 10 minutes)
        if (Carbon::parse($reset->created_at)->addMinutes(10)->isPast()) {
            throw new \Exception('Token has expired.', 400);
        }
        ;
        DB::transaction(function () use ($data) {
            $user = User::where('email', $data['email'])->first();

            // Update the password securely
            $user->password = Hash::make($data['password']);
            $user->save();
           
            // Delete the used reset token
            PasswordResetToken::where('email', $data['email'])->delete();
        });
    }
}
