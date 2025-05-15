<?php

namespace App\Livewire\Settings\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Http\Livewire\Traits\WithToast;

class CreateEdit extends Component
{
    use WithToast;

    public $userId = null;
    public $name = '';
    public $email = '';
    public $password = '12345678';
    public $selectedRole = null;

    protected $layout = 'components.layouts.app';

    protected function rules()
    {
        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255',
            'selectedRole' => 'required'
        ];

        // Si c'est une création ou si le mot de passe est modifié
        if (!$this->userId || $this->password) {
            $rules['password'] = 'required|min:8';
        }

        // Vérification d'unicité de l'email
        $emailRule = 'unique:users,email';
        if ($this->userId) {
            $emailRule .= ',' . $this->userId;
        }
        $rules['email'] .= '|' . $emailRule;

        return $rules;
    }

    protected function messages()
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'name.min' => 'Le nom doit contenir au moins 3 caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'selectedRole.required' => 'Veuillez sélectionner un rôle pour l\'utilisateur.'
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            try {
                $user = User::findOrFail($id);

                // Vérifier que l'utilisateur ne tente pas de se modifier lui-même pour changer son rôle
                if ($user->id === Auth::id()) {
                    // Si c'est son propre compte, on ne permet pas de changer le rôle
                    $this->info('Vous ne pouvez pas modifier votre propre rôle.');
                }

                $this->userId = $id;
                $this->name = $user->name;
                $this->email = $user->email;
                $this->password = ''; // Ne pas afficher le mot de passe actuel

                // Récupérer le premier rôle (et potentiellement le seul) de l'utilisateur
                $userRole = $user->roles->first();
                $this->selectedRole = $userRole ? $userRole->id : null;
            } catch (\Exception $e) {
                Log::error('Erreur dans CreateEdit::mount: ' . $e->getMessage());
                $this->error('Utilisateur non trouvé.');
                $this->redirectRoute('settings.users.index',navigate: true);
            }
        }
    }

    public function saveUser()
    {
        try {
            // Valider les données
            $this->validate();

            // Vérifier que l'utilisateur connecté ne tente pas d'assigner son propre rôle
            $currentUser = Auth::user();
            $currentUserRole = $currentUser->roles->first();

            if ($currentUserRole && $currentUserRole->id == $this->selectedRole) {
                $this->error('Vous ne pouvez pas assigner votre propre rôle à un autre utilisateur.');
                return null;
            }

            // Si c'est sa propre modification et qu'il tente de changer son rôle
            if ($this->userId && $this->userId == $currentUser->id && $currentUserRole && $currentUserRole->id != $this->selectedRole) {
                $this->error('Vous ne pouvez pas modifier votre propre rôle.');
                return null;
            }

            // Récupérer l'objet Role complet à partir de l'ID sélectionné
            $roleObject = Role::find($this->selectedRole);

            // Vérification si le rôle existe
            if (!$roleObject) {
                $this->error('Le rôle sélectionné n\'existe pas.');
                return null;
            }

            if ($this->userId) {
                // Mise à jour d'un utilisateur existant
                $user = User::findOrFail($this->userId);

                // Vérifier que ce n'est pas l'utilisateur actuel qui tente de se modifier lui-même
                if ($user->id === $currentUser->id) {
                    // On peut mettre à jour le nom, l'email et le mot de passe, mais pas le rôle
                    $user->name = $this->name;
                    $user->email = $this->email;

                    // Mise à jour du mot de passe si fourni
                    if ($this->password) {
                        $user->password = Hash::make($this->password);
                    }

                    $user->save();

                    $message = 'Votre profil a été mis à jour avec succès.';
                } else {
                    $user->name = $this->name;
                    $user->email = $this->email;

                    // Mise à jour du mot de passe si fourni
                    if ($this->password) {
                        $user->password = Hash::make($this->password);
                    }

                    $user->save();

                    // Assigner un seul rôle (remplace tous les rôles précédents)
                    // Utiliser l'objet Role au lieu de l'ID
                    $user->syncRoles([$roleObject]);

                    $message = 'Utilisateur mis à jour avec succès.';
                }
            } else {
                // Création d'un nouvel utilisateur
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'tenant_id' => tenant('id'),
                ]);

                // Attribuer un seul rôle en utilisant l'objet Role au lieu de l'ID
                $user->assignRole($roleObject);

                $message = 'Utilisateur créé avec succès.';
            }

            // Utilisez session()->flash pour enregistrer le message qui sera
            // affichable après la redirection
            session()->flash('success', $message);

            // Redirection vers la liste des utilisateurs
            $this->redirectRoute('settings.users.index',navigate:false );
        } catch (\Exception $e) {
            Log::error('Erreur dans CreateEdit::saveUser: ' . $e->getMessage());
            $this->error('Erreur lors de l\'enregistrement de l\'utilisateur: ' . $e->getMessage());
        }
    }

    public function cancelEdit()
    {
        $this->redirectRoute('settings.users.index',navigate: true);
    }

    public function render()
    {
        try {
            // Récupérer tous les rôles sauf celui de l'utilisateur connecté
            $currentUser = Auth::user();
            $currentUserRole = $currentUser->roles->first();

            $roles = Role::when($currentUserRole, function($query) use ($currentUserRole) {
                // Exclure le rôle actuel de l'utilisateur connecté de la liste
                return $query->where('id', '!=', $currentUserRole->id);
            })->get();

            // Si on est en train de modifier un utilisateur existant qui a déjà un rôle,
            // assurons-nous que ce rôle apparaît toujours dans la liste même si c'est le même que celui de l'utilisateur connecté
            if ($this->userId && $this->selectedRole && $currentUserRole && $this->selectedRole == $currentUserRole->id) {
                $userRole = Role::find($this->selectedRole);
                if ($userRole && !$roles->contains('id', $userRole->id)) {
                    $roles->push($userRole);
                }
            }

            return view('livewire.settings.users.create-edit', [
                'roles' => $roles,
                'title' => $this->userId ? __('Modifier l\'utilisateur') : __('Créer un utilisateur')
            ])->layout($this->layout);
        } catch (\Exception $e) {
            Log::error('Erreur dans CreateEdit::render: ' . $e->getMessage());
            $this->error('Erreur lors du chargement des rôles: ' . $e->getMessage());
            return view('livewire.settings.users.create-edit', [
                'roles' => collect(),
                'title' => $this->userId ? __('Modifier l\'utilisateur') : __('Créer un utilisateur')
            ])->layout($this->layout);
        }
    }
}
