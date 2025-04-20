<?php
namespace App\Service\Api\User\Two_Step_Authentication;

use App\Models\Api\User\User;
/**
 *Using a factory with an interface, we can:

*Decouple the OTP sending logic from authentication.
*Easily add more OTP providers (e.g., SMS, Email, etc.).
*Improve maintainability by following SOLID principles.
**/
interface OtpProviderInterface
{
    public function sendOtp(int $user,string $token):array;
}