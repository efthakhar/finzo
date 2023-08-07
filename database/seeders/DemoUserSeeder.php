<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        // create demo user
        User::create([
            'name' => 'efthakhar bin alam',
            'user_name' => 'efthakhar',
            'email' => 'admin@finzo.com',
            'password' => Hash::make('**finzo**'),
        ]);

    }
}

// email: admin@finzo.com
// password: **finzo**
