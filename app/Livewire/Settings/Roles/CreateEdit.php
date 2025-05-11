<?php

namespace App\Livewire\Settings\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Livewire\Traits\WithToast;
use Illuminate\Support\Facades\Log;

class CreateEdit extends Component
{
    use WithToast;

    public $roleId = null;
    public $roleName = '';
    public $selectedPermissions = [];
    public $editMode = false;

    // Définition du layout à utiliser
    protected $layout = 'components.layouts.app';

    protected $rules = [
        'roleName' => 'required|min:3|max:50',
        'selectedPermissions' => 'array'
    ];

    protected $messages = [
        'roleName.required' => 'Le nom du rôle est obligatoire.',
        'roleName.min' => 'Le nom du rôle doit contenir au moins 3 caractères.',
        'roleName.max' => 'Le nom du rôle ne peut pas dépasser 50 caractères.'
    ];

    public function mount($id = null)
    {
        if ($id) {
            try {
                $role = Role::findOrFail($id);
                $this->roleId = $id;
                $this->roleName = $role->name;
                $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
                $this->editMode = true;
            } catch (\Exception $e) {
                Log::error('Erreur dans CreateEdit::mount: ' . $e->getMessage());
                $this->error('Erreur lors du chargement du rôle: ' . $e->getMessage());
                return $this->redirectRoute('settings.roles.index');
            }
        }
    }

    public function resetRoleForm()
    {
        $this->roleName = '';
        $this->selectedPermissions = [];
    }

    public function saveRole()
    {
        $this->validate();

        try {
            if ($this->editMode) {
                // Mise à jour d'un rôle existant
                $role = Role::findOrFail($this->roleId);
                $role->name = $this->roleName;
                $role->save();

                // Synchroniser les permissions
                $role->syncPermissions($this->selectedPermissions);

                $this->success('Rôle mis à jour avec succès!');
            } else {
                // Création d'un nouveau rôle
                $role = Role::create(['name' => $this->roleName]);

                // Attribuer les permissions
                $role->syncPermissions($this->selectedPermissions);

                $this->success('Rôle créé avec succès!');
            }

            // Rediriger vers la liste des rôles
            return $this->redirectRoute('settings.roles.index',navigate:true);
        } catch (\Exception $e) {
            Log::error('Erreur dans CreateEdit::saveRole: ' . $e->getMessage());
            $this->error('Erreur lors de la sauvegarde du rôle: ' . $e->getMessage());
        }
    }

    public function cancelEdit()
    {
        return $this->redirectRoute('settings.roles.index',navigate:true);
    }

    public function selectAllPermissions()
    {
        $this->selectedPermissions = Permission::pluck('id')->toArray();
        $this->success('Toutes les permissions ont été sélectionnées.');
    }

    public function deselectAllPermissions()
    {
        $this->selectedPermissions = [];
        $this->success('Toutes les permissions ont été désélectionnées.');
    }

    public function render()
    {
        try {
            $permissions = Permission::all();
            $permissionsByGroup = $permissions->groupBy(function ($permission) {
                // Grouper les permissions par leur préfixe (avant le premier point)
                $parts = explode('.', $permission->name);
                return $parts[0];
            });

            $title = $this->editMode ? __('Modifier le rôle') : __('Créer un rôle');

            return view('livewire.settings.roles.create-edit', [
                'permissions' => $permissions,
                'permissionsByGroup' => $permissionsByGroup,
                'title' => $title
            ])->layout($this->layout);
        } catch (\Exception $e) {
            Log::error('Erreur dans CreateEdit::render: ' . $e->getMessage());
            $this->error('Erreur lors du chargement des permissions: ' . $e->getMessage());

            $title = $this->editMode ? __('Modifier le rôle') : __('Créer un rôle');

            return view('livewire.settings.roles.create-edit', [
                'permissions' => collect(),
                'permissionsByGroup' => collect(),
                'title' => $title
            ])->layout($this->layout);
        }
    }
}
