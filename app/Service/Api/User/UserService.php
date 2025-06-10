<?php
namespace App\Service\Api\User;

use Exception;
use Illuminate\Support\Facades\Log;

class UserService
{
    /**
     * set privacy_setting array in user table , boolean value only alowed 
     * this determind how is allowed to see privacy data (phone,address,birthdate)
     * @param array $data
     * @throws \Exception
     * @return void
     */
    public function updatePrivacySetting(array $data)
    {
        try {

            $user = auth('api')->user();

            $user->privacySetting = $data['privacy_setting'];
            
        } catch (Exception $e) {
            Log::error('Error while update privacy array for a user: ' . $e->getMessage());
            throw new Exception('Failed in the server: ' . $e->getMessage());
        }
    }
}