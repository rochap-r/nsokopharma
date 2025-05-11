<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissions pour la gestion des utilisateurs
        $userPermissions = [
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
        ];

        // Permissions pour la gestion des rôles
        $rolePermissions = [
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',
            'manage-roles', // Permission spéciale pour accéder à la page de gestion des rôles
        ];

        // Permissions pour la gestion des produits
        $productPermissions = [
            'products.view',
            'products.create',
            'products.edit',
            'products.delete',
        ];

        // Permissions pour la gestion des stocks
        $stockPermissions = [
            'stocks.view',
            'stocks.create',
            'stocks.edit',
            'stocks.delete',
        ];

        // Permissions pour la gestion des ventes
        $salePermissions = [
            'sales.view',
            'sales.create',
            'sales.edit',
            'sales.delete',
        ];

        // Permissions pour la gestion des rapports
        $reportPermissions = [
            'reports.view',
            'reports.create',
            'reports.export',
        ];

        // Permissions pour les paramètres
        $settingPermissions = [
            'settings.view',
            'settings.edit',
        ];

        // Toutes les permissions
        $allPermissions = array_merge(
            $userPermissions,
            $rolePermissions,
            $productPermissions,
            $stockPermissions,
            $salePermissions,
            $reportPermissions,
            $settingPermissions
        );

        // Créer toutes les permissions
        foreach ($allPermissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        // S'assurer que le rôle Admin existe et a toutes les permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions(Permission::all());

        // S'assurer que le premier utilisateur a le rôle Admin
        $firstUser = User::first();
        if ($firstUser) {
            $firstUser->assignRole($adminRole);
        }

        $this->command->info('Permissions et rôles créés avec succès.');
    }
}
