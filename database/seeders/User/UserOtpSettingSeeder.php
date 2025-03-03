<?php

namespace Database\Seeders\User;
use Mockery\Matcher\Not;
use phpseclib3\Crypt\Random;
use App\Models\Api\User\User;
use Illuminate\Database\Seeder;
use App\Models\Api\User\UserOtpSetting;

class UserOtpSettingSeeder extends Seeder
{
    public function run()
    {


        $users = User::all();

        foreach ($users as $user) 
        {
            // Randomly choose between true and false for is_enabled
            $isEnabled = fake()->boolean();

            // Randomly choose between 'sms' and 'telegram' for provider
            $provider = fake()->randomElement(['sms', 'telegram']);

            // Create the UserOtpSetting
            UserOtpSetting::create([
                'user_id' => $user->id,
                'is_enabled' =>$user->id==1?true: $isEnabled,
                'provider' => $user->id==1?'telegram':$provider
            ]);
        }


    }
}
