<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Local; // Import the Local model if it's not already imported
use Faker\Factory as Faker;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $faker = Faker::create();

        // Get the range of existing region IDs
        $regionIds = Region::pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            $local = new Local();
            $local->name = $faker->company;
            $local->address = $faker->address;
            $local->region_id = $faker->randomElement($regionIds);
            $local->save();
        }
        
    }
}
