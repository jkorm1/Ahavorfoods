<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Seed Anonymous Users with Avatars
        $anonymousUsers = [
            ['name' => 'Food Lover', 'email' => 'josephkorm1@gmail.com', 'avatar' => 'images/avatars/anon1.jpg'],
            ['name' => 'Healthy Eater', 'email' => 'josephkorm11.com', 'avatar' => 'images/avatars/anon2.jpg'],
            ['name' => 'Snack Enthusiast', 'email' => 'christianfrimpong.com', 'avatar' => 'images/avatars/anon3.jpg']
        ];

        foreach ($anonymousUsers as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                array_merge($data, ['password' => bcrypt('default123')]) // Add default password
            );
        }
        
    }
}
