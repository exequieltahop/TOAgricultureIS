<?php

namespace Database\Seeders;

use App\Models\Admin\StaffInfo;
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
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminpassword'),
            'role' => 1,
        ]);

        $staff = User::create([
            'name' => 'staff a1',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('staffpassword'),
            'role' => 2,
        ]);

        StaffInfo::create([
            'user_id' => $staff->id,
            'f_name' => 'staff',
            'm_name' => null,
            'l_name' => 'a1',
            'b_date' => now(),
            'b_place' => 'sample address',
            'sex' => 1,
            'civil_status' => 1
        ]);
    }
}
