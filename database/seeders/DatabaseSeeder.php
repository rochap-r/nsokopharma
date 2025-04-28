<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Tenant;
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

        //User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Rodrigue CHOT',
            'email' => 'rodriguechot@gmail.com',
        ]);

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

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $role = Role::firstOrCreate(['name' => 'Root', 'tenant_id' => $user->tenant_id]);
        $role->syncPermissions(Permission::all());
        $user->assignRole($role);
    }
}
