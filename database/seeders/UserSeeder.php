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
        // User::create([
        //     'name' => "Admin",
        //     'email' => "admin@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "sales",
        //     'email' => "sales@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::create([
        //     'name' => "sales2",
        //     'email' => "sales2@gmail.com",
        //     'password' => Hash::make('password'),
        //     'email_verified_at' => now(),
        // ]);
        // User::factory()->count(10)->create();
        // Create admin user (without sales)
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
                'nama' => $user->name,
                'user_id' => $user->id,
                // Optionally add default values for other fields
            ]);
        }
    }
}
