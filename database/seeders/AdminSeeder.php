<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@mostafiz.com', // condition (unique field)
            ],
            [
                'name' => 'Mostafiz',
                'password' => Hash::make('2443424434'),
                'is_admin' => true,
                'is_customer' => false,
                'email_verified_at' => now(),
            ]
        );
    }
}