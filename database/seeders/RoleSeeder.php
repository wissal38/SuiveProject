<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // Import the Role model
use Spatie\Permission\Models\Permission; // Import the Permission model

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $responsableGeneralRole = Role::create(['name' => 'responsable general']);
        $responsableLocalRole = Role::create(['name' => 'responsable local']);
        $agentRole = Role::create(['name' => 'agent']);

        // Retrieve permissions
        $permissions = Permission::pluck('name');

        // Assign permissions to roles
        $responsableGeneralRole->syncPermissions($permissions->whereIn('name', [
            'create-region',
            'edit-region',
            'delete-region',
            'create-local',
            'edit-local',
            'delete-local'
        ]));

        $responsableLocalRole->syncPermissions($permissions->whereIn('name', [
            'create-compteur',
            'edit-compteur',
            'delete-compteur',
            'create-facture',
            'edit-facture',
            'delete-facture'
        ]));

        $agentRole->syncPermissions($permissions->whereIn('name', [
            'create-facture',
            'edit-facture'    
        ]));
    }
}
