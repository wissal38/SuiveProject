<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compteur;
use App\Models\Local; 
use Faker\Factory as Faker;

class CompteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $faker = Faker::create();

        // Get the range of existing local IDs
        $localIds = Local::pluck('id')->toArray();
    
        for ($i = 1; $i <= 300; $i++) {
            $compteur = new Compteur(); // Corrected: Use Compteur model
            $compteur->numero = $faker->numberBetween(100000, 999999); // Generates a random 6-digit number
            $compteur->type_compteur = $faker->randomElement(['eau', 'gaz', 'électricité']); // Randomly choose among the three types
            $compteur->local_id = $faker->randomElement($localIds); // Corrected: Use randomElement
            $compteur->save();
        } 
    }
}
