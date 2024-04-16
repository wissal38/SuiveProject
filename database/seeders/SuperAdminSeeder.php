<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash; // Import the Hash facade

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Amen Allah', 
            'email' => 'mezliniamen33@gmail.com',
            'password' => Hash::make('dddd1234')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating responsable general User
        $responsablegeneral = User::create([
            'name' => 'Wissal', 
            'email' => 'aiwissal38@gmail.com',
            'password' => Hash::make('dddd1234')
        ]);
        $responsablegeneral->assignRole('responsable general');

        // Creating responsable local User
        $responsablelocal = User::create([
            'name' => 'Amen', 
            'email' => 'mezliniamen31@gmail.com',
            'password' => Hash::make('dddd1234'),
            
            
        ]);
        $responsablelocal->assignRole('responsable local');

        // Creating agent User
        $agent = User::create([
            'name' => 'ait brahim wissal', 
            'email' => 'wwwww20@gmail.com',
            'password' => Hash::make('dddd1234')
        ]);
        $agent->assignRole('agent');
    }
}
