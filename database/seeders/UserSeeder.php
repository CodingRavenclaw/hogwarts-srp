<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Vanessa Harbor',
                'email' => 'vanessa.harbor@hogwarts.net',
                'email_verified_at' => now(),
                'password' => bcrypt('Test123!'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minverva McGonagall',
                'email' => 'minerva.mcgonagall@hogwarts.net',
                'email_verified_at' => now(),
                'password' => bcrypt('Test123!'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Albus Dumbledore',
                'email' => 'albus.dumbledore@hogwarts.net',
                'email_verified_at' => now(),
                'password' => bcrypt('Test123!'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
