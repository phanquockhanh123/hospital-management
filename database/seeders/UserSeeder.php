<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
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
        $now = now();
        \App\Models\User::insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'status' => User::STATUS_ACTIVE,
                'role' => User::ROLE_ADMIN_ROOT,
                'email_verified_at' => $now,
                'password' => Hash::make('Aa@123456'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'doctor',
                'email' => 'doctor@gmail.com',
                'status' => User::STATUS_ACTIVE,
                'role' => User::ROLE_DOCTOR,
                'email_verified_at' => $now,
                'password' => Hash::make('Aa@123456'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'receptionist',
                'email' => 'receptionist@gmail.com',
                'status' => User::STATUS_ACTIVE,
                'role' => User::ROLE_RECEPTIONIST,
                'email_verified_at' => $now,
                'password' => Hash::make('Aa@123456'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
