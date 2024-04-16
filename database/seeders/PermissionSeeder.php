<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission; // Import the Permission model

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
            'create-region',
            'edit-region',
            'delete-region',
            'create-local',
            'edit-local',
            'delete-local',
            'create-compteur',
            'edit-compteur',
            'delete-compteur',
            'create-facture',
            'edit-facture',
            'delete-facture'
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
