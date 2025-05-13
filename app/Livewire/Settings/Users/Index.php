<?php

namespace App\Livewire\Settings\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Http\Livewire\Traits\WithToast;

class Index extends Component
{
    use WithPagination, WithToast;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $showDeleteModal = false;
    public $userIdToDelete = null;
    public $userName = '';

    protected $layout = 'components.layouts.app';

    /**
     * Execute au chargement de la page pour afficher les messages flash sous forme de toast
     */
    public function mount()
    {
        // Vérification des messages flash pour les afficher en toast
        if (session()->has('success')) {
            $this->success(session('success'), 6000);
            session()->forget('success'); // Reset pour éviter des affichages multiples
        }

        if (session()->has('error')) {
            $this->error(session('error'), 6000);
            session()->forget('error'); // Reset pour éviter des affichages multiples
        }

        // Vérifier s'il y a un message toast dans la session et l'afficher
        if (session()->has('toast_message')) {
            $message = session('toast_message');
            $type = session('toast_type', 'success'); // Par défaut, type success

            // Appeler la méthode appropriée du trait WithToast en fonction du type
            if ($type === 'success') {
                $this->success($message);
            } elseif ($type === 'error') {
                $this->error($message);
            } elseif ($type === 'info') {
                $this->info($message);
            } elseif ($type === 'warning') {
                $this->warning($message);
            }

            // Supprimer les messages de la session pour éviter qu'ils ne s'affichent à nouveau
            session()->forget(['toast_message', 'toast_type']);
        }
    }

    public function resetSearch()
    {
        $this->reset('search');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function navigateToCreateUser()
    {
         $this->redirectRoute('settings.users.create', navigate: true);
    }

    public function navigateToEditUser($userId)
    {
         $this->redirectRoute('settings.users.edit', ['id' => $userId], navigate: true);
    }

    public function navigateToViewUser($userId)
    {
         $this->redirectRoute('settings.users.show', ['id' => $userId], navigate: true);
    }

    public function confirmDelete($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $this->userIdToDelete = $userId;
            $this->userName = $user->name;
            $this->showDeleteModal = true;
            $this->dispatch('open-modal', ['name' => 'confirm-delete-user']);
        }
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->userIdToDelete = null;
        $this->userName = '';
        $this->dispatch('close-modal', ['name' => 'confirm-delete-user']);
    }

    public function deleteUser()
    {
        try {
            if ($this->userIdToDelete) {
                $user = User::find($this->userIdToDelete);

                if ($user) {
                    // Vérifier que ce n'est pas l'utilisateur actuel
                    if ($user->id === auth()->id()) {
                        $this->error('Vous ne pouvez pas supprimer votre propre compte.');
                        $this->closeDeleteModal();
                        return;
                    }

                    // Vérifier que l'utilisateur à supprimer n'a pas le même rôle que l'utilisateur connecté
                    $currentUser = Auth::user();
                    $currentUserRole = $currentUser->roles->first();

                    if ($currentUserRole) {
                        $userToDeleteRole = $user->roles->first();

                        if ($userToDeleteRole && $userToDeleteRole->id === $currentUserRole->id) {
                            $this->error('Vous ne pouvez pas supprimer un utilisateur ayant le même rôle que vous.');
                            $this->closeDeleteModal();
                            return;
                        }
                    }

                    // Détacher les rôles de l'utilisateur avant de le supprimer
                    $user->roles()->detach();

                    // Supprimer l'utilisateur
                    $user->delete();
                    $this->success('Utilisateur supprimé avec succès.');
                } else {
                    $this->error('Utilisateur non trouvé.');
                }
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de l\'utilisateur: ' . $e->getMessage());
            $this->error('Erreur lors de la suppression de l\'utilisateur: ' . $e->getMessage());
        }

        $this->closeDeleteModal();
    }

    public function render()
    {
        try {
            $users = User::with('roles')
                ->when($this->search, function ($query) {
                    return $query->where(function($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('email', 'like', '%' . $this->search . '%');
                    });
                })
                ->paginate(10);

            return view('livewire.settings.users.index', [
                'users' => $users,
                'title' => __('Gestion des Utilisateurs')
            ])->layout($this->layout);
        } catch (\Exception $e) {
            Log::error('Erreur dans Users\Index::render: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            $this->error('Erreur lors du chargement des utilisateurs: ' . $e->getMessage());
            return view('livewire.settings.users.index', [
                'users' => collect(),
                'title' => __('Gestion des Utilisateurs')
            ])->layout($this->layout);
        }
    }
}
