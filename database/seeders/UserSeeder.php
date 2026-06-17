<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // create default admin account :::
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@covid.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'approved',
        ]);

        /// create default approved hospital account ::
        $hospital =User::create([
            'name' => 'City General Hospital',
            'email' => 'hospital@covid.com',
            'password' => Hash::make('password123'),
            'role' => 'hospital',
            'status' => 'approved',

        ]);

        // provision profile for the approved hospital 

        $hospital->hospitalProfile()->create([
           'hospital_name' => 'City General Hospital',
            'address' => '786 Medical Road, Sector G',
            'location' => 'Islamabad',
            'contact_number' => '+923482000168',
        ]);

        //// create default patient account 

        $patient =User::create([
            'name' => 'JHunain',
            'email' => 'hunain12@gmail.com',
            'password' => Hash::make('hunain123'),
            'role' => 'patient',
            'status' => 'approved',
        ]);

        // Provision profile for the patient
        $patient->patientProfile()->create([
            'address' => 'House 123, Street 5',
            'location' => 'Karachi',
            'phone' => '+923482000168',
        ]);
    }
}
