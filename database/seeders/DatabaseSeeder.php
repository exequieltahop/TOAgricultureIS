<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('adminpassword'),
                'role' => 1
            ],
            [
                'name' => 'staff a1',
                'email' => 'staff@gmail.com',
                'password' => Hash::make('staffpassword'),
                'role' => 2
            ],
        ]);
    }
}
