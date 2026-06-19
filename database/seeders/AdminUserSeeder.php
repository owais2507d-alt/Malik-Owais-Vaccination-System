<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; // Strictly pointing to the new Admin Model instead of User
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Enforcing direct insertion into the new independent 'admins' database table
        Admin::create([
            'name' => 'Super Admin Owais',
            'email' => 'owais2507d@aptechgdn.net',
            'password' => Hash::make('root1234'), // Aapka secure password
        ]);
    }
}