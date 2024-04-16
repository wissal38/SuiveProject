<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compteur;
use App\Models\Facture;
use Faker\Factory as Faker;

class FactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Générer 100 factures génériques
        for ($i = 0; $i < 200; $i++) {
            $datePayment = $faker->optional()->dateTimeBetween('2022-01-01', '2024-12-31');
            $dateLimite = $faker->dateTimeBetween('2022-01-01', '2024-12-31');

            // Obtenez un compteur aléatoire et à partir de cela, obtenez le local associé
            $compteur = Compteur::inRandomOrder()->first();
            $localId = $compteur->local_id;

            Facture::create([
                'reference' => $faker->unique()->randomNumber(9),
                'index_precedant' => $faker->numberBetween(100, 5000),
                'index_suivant' => $faker->numberBetween(100, 5000),
                'date_payment' => $datePayment,
                'date_limite_p' => $dateLimite,
                'type_facture' => $faker->randomElement(['eau', 'gaz', 'electricité']),
                'montant' => $faker->randomFloat(2, 0, 10000),
                'compteur_id' => $compteur->id,
            ]);
        }
    }
}
