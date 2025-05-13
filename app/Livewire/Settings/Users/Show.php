<?php

namespace App\Livewire\Settings\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Http\Livewire\Traits\WithToast;

class Show extends Component
{
    use WithToast;
    
    public $userId;
    public $user;
    
    protected $layout = 'components.layouts.app';
    
    public function mount($id)
    {
        try {
            $this->userId = $id;
            $this->user = User::with('roles')->findOrFail($id);
        } catch (\Exception $e) {
            Log::error('Erreur dans Show::mount: ' . $e->getMessage());
            $this->error('Utilisateur non trouvé.');
            return $this->redirectRoute('settings.users.index', navigate: true);
        }
    }
    
    public function back()
    {
        return $this->redirectRoute('settings.users.index', navigate: true);
    }
    
    public function render()
    {
        return view('livewire.settings.users.show', [
            'title' => __('Détails de l\'utilisateur'),
        ])->layout($this->layout);
    }
}
