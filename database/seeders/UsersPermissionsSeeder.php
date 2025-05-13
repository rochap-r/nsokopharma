<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Log;

class UsersPermissionsSeeder extends Seeder
{
    /**
     * Execute le seeder pour ajouter les permissions de gestion des utilisateurs.
     */
    public function run(): void
    {
        try {
            // Définir les permissions pour la gestion des utilisateurs
            $permissions = [
                'manage-users' => 'Gérer les utilisateurs',
                'users.create' => 'Créer des utilisateurs',
                'users.read' => 'Voir les utilisateurs',
                'users.update' => 'Modifier des utilisateurs',
                'users.delete' => 'Supprimer des utilisateurs',
            ];

            foreach ($permissions as $name => $description) {
                Permission::firstOrCreate(['name' => $name], [
                    'name' => $name,
                    'description' => $description,
                    'guard_name' => 'web',
                ]);
            }

            $this->command->info('✅ Permissions de gestion des utilisateurs créées avec succès');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création des permissions de gestion des utilisateurs: ' . $e->getMessage());
            $this->command->error('❌ Erreur lors de la création des permissions: ' . $e->getMessage());
        }
    }
}
