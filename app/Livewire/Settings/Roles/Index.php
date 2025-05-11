<?php

namespace App\Livewire\Settings\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use App\Http\Livewire\Traits\WithToast;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class Index extends Component
{
    use WithPagination, WithToast;

    protected $paginationTheme = 'tailwind';
    
    public $search = '';
    
    // Définition du layout à utiliser
    protected $layout = 'components.layouts.app';
    
    public function resetSearch()
    {
        $this->reset('search');
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function navigateToCreateRole()
    {
        return redirect()->route('settings.roles.create');
    }
    
    public function navigateToEditRole($roleId)
    {
        return redirect()->route('settings.roles.edit', ['id' => $roleId]);
    }
    
    public function navigateToViewPermissions($roleId)
    {
        return redirect()->route('settings.roles.permissions', ['id' => $roleId]);
    }
    
    public function render()
    {
        try {
            $roles = Role::with('permissions')
                ->when($this->search, function ($query) {
                    return $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->paginate(10);
            
            return view('livewire.settings.roles.index', [
                'roles' => $roles,
                'title' => __('Rôles et Permissions')
            ])->layout($this->layout);
        } catch (\Exception $e) {
            Log::error('Erreur dans Roles\Index::render: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            $this->error('Erreur lors du chargement des rôles: ' . $e->getMessage());
            return view('livewire.settings.roles.index', [
                'roles' => collect(),
                'title' => __('Rôles et Permissions')
            ])->layout($this->layout);
        }
    }
}
