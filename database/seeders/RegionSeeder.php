<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region; 
use Faker\Factory as Faker;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 24; $i++) {
            $region = new Region();
            $region->name = $faker->state; 
            $region->save();
        }
    }
}
