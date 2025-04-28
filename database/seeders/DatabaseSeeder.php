<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TenantSeeder::class,
        ]);
        User::factory(30)->create();

        // Liste des permissions
        $permissions = [
            'create-user',
            'edit-user',
            'delete-user',
            'show-user',
            'view-tenants',
            'create-tenant',
            'edit-tenant',
            'delete-tenant',
            'view-roles',
            'create-role',
            'edit-role',
            'delete-role',
            'view-permissions',
            'create-permission',
            'edit-permission',
            'delete-permission',
        ];

        // Créer les permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

    }
}
