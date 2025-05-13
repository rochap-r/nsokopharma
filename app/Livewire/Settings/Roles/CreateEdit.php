<?php

namespace App\Livewire\Settings\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Livewire\Traits\WithToast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CreateEdit extends Component
{
    use WithToast;

    public $roleId = null;
    public $roleName = '';
    public $selectedPermissions = [];
    public $editMode = false;
    public $showConfirmDeselectModal = false;

    // Définition du layout à utiliser
    protected $layout = 'components.layouts.app';

    protected function rules()
    {
        return [
            'roleName' => [
                'required',
                'min:3',
                'max:50',
                Rule::unique('roles', 'name')->ignore($this->roleId)
            ],
            'selectedPermissions' => 'array'
        ];
    }

    protected $messages = [
        'roleName.required' => 'Le nom du rôle est obligatoire.',
        'roleName.min' => 'Le nom du rôle doit contenir au moins 3 caractères.',
        'roleName.max' => 'Le nom du rôle ne peut pas dépasser 50 caractères.',
        'roleName.unique' => 'Ce nom de rôle existe déjà.'
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
                Log::error('Erreur dans CreateEdit::mount pour le rôle ID ' . $id . ': ' . $e->getMessage());
                $this->error('Erreur lors du chargement du rôle: ' . $e->getMessage());
                return $this->redirectRoute('settings.roles.index', navigate: true);
            }
        }
    }

    public function resetRoleForm()
    {
        $this->roleName = '';
        $this->selectedPermissions = [];
        $this->resetValidation();
    }

    public function saveRole()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            if ($this->editMode) {
                // Mise à jour d'un rôle existant
                $role = Role::findOrFail($this->roleId);
                $role->name = $this->roleName;
                $role->save();

                // Récupérer les objets Permission à partir des IDs
                $permissions = Permission::whereIn('id', $this->selectedPermissions)->get();

                // Synchroniser les permissions en utilisant la collection d'objets
                $role->syncPermissions($permissions);

                $this->success('Rôle mis à jour avec succès!');
            } else {
                // Vérifier si le rôle existe déjà pour éviter l'erreur de duplicat
                if (Role::where('name', $this->roleName)->exists()) {
                    $this->error('Ce nom de rôle existe déjà.');
                    DB::rollBack();
                    return;
                }

                // Création d'un nouveau rôle
                $role = Role::create(['name' => $this->roleName]);

                // Récupérer les objets Permission à partir des IDs
                if (!empty($this->selectedPermissions)) {
                    $permissions = Permission::whereIn('id', $this->selectedPermissions)->get();

                    // Attribuer les permissions en utilisant la collection d'objets
                    $role->syncPermissions($permissions);
                }

                $this->success('Rôle créé avec succès!');
            }

            DB::commit();

            // Rediriger vers la liste des rôles
            $this->redirectRoute('settings.roles.index', navigate: true);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur dans CreateEdit::saveRole pour "' . $this->roleName . '": ' . $e->getMessage());
            $this->error('Erreur lors de la sauvegarde du rôle: ' . $e->getMessage());
        }
    }

    public function cancelEdit()
    {
        $this->resetValidation();
        $this->redirectRoute('settings.roles.index', navigate: true);
    }

    public function selectAllPermissions()
    {
        $this->selectedPermissions = Permission::pluck('id')->toArray();
        $this->success('Toutes les permissions ont été sélectionnées.');
    }

    public function confirmDeselectAllPermissions()
    {
        // Ouvrir la modale de confirmation
        $this->showConfirmDeselectModal = true;
        $this->dispatch('open-modal', ['name' => 'confirm-deselect']);
    }

    public function cancelDeselectAllPermissions()
    {
        $this->showConfirmDeselectModal = false;
        $this->dispatch('close-modal', ['name' => 'confirm-deselect']);
    }

    public function deselectAllPermissions()
    {
        $this->selectedPermissions = [];
        $this->showConfirmDeselectModal = false;
        $this->success('Toutes les permissions ont été désélectionnées.');
        $this->dispatch('close-modal', ['name' => 'confirm-deselect']);
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
