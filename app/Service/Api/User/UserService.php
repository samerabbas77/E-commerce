<?php
namespace App\Service\Api\User;

use Exception;
use App\Models\Api\User\User;
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

            $user = User::findOrFail($user->id);

            $user->privacy_setting = $data['privacy_setting'];
           
            $user->save();
     

        } catch (Exception $e) {
            Log::error('Error while update privacy array for a user: ' . $e->getMessage());
            throw new Exception('Failed in the server: ' . $e->getMessage());
        }
    }
}