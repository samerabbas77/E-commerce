<?php

namespace App\Service\Api\User\Two_Step_Authentication;

use Exception;
use App\Service\Api\User\Two_Step_Authentication\TelegramService;

class OtpProviderFactory
{
    public static function create(string $provider)
    {
        return match ($provider) {
            'telegram' => new TelegramProvider(),
            'sms' => new SmsProvider(),
            default => throw new Exception("OTP Provider '$provider' not supported."),
        };
    }
}