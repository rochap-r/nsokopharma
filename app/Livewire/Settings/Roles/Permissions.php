<?php

namespace App\Livewire\Settings\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Http\Livewire\Traits\WithToast;
use Illuminate\Support\Facades\Log;

class Permissions extends Component
{
    use WithToast;

    public $roleId;
    public $role;

    // Définition du layout à utiliser
    protected $layout = 'components.layouts.app';

    public function mount($id)
    {
        try {
            $this->roleId = $id;
            $this->role = Role::with('permissions')->findOrFail($id);
        } catch (\Exception $e) {
            Log::error('Erreur dans Permissions::mount: ' . $e->getMessage());
            $this->error('Erreur lors du chargement du rôle: ' . $e->getMessage());
            return $this->redirectRoute('settings.roles.index',navigate:true);
        }
    }

    public function backToList()
    {
        return $this->redirectRoute('settings.roles.index',navigate:true);
    }

    public function editPermissions()
    {
        return $this->redirectRoute('settings.roles.edit', $this->role,navigate: true);
    }

    public function render()
    {
        try {
            $groupedPermissions = $this->role->permissions->groupBy(function ($permission) {
                $parts = explode('.', $permission->name);
                return $parts[0];
            });

            return view('livewire.settings.roles.permissions', [
                'groupedPermissions' => $groupedPermissions,
                'title' => __('Permissions du rôle') . ' : ' . $this->role->name
            ])->layout($this->layout);
        } catch (\Exception $e) {
            Log::error('Erreur dans Permissions::render: ' . $e->getMessage());
            $this->error('Erreur lors du chargement des permissions: ' . $e->getMessage());
            return view('livewire.settings.roles.permissions', [
                'groupedPermissions' => collect(),
                'title' => __('Permissions du rôle')
            ])->layout($this->layout);
        }
    }
}
