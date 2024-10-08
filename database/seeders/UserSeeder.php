<?php

namespace Database\Seeders;

use App\Models\Sales;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create sales users with sales records
        $salesUsers = [
            ['name' => 'sales', 'email' => 'sales@gmail.com'],
            ['name' => 'sales2', 'email' => 'sales2@gmail.com'],
        ];

        foreach ($salesUsers as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);

            Sales::create([
                'name' => $user->name,
                'user_id' => $user->id,
            ]);
        }
    }
}
