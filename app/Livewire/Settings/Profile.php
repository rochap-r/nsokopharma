<?php

namespace App\Livewire\Settings;

use App\Models\User;
use App\Http\Livewire\Traits\WithToast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Profile extends Component
{
    use WithToast;

    public string $name = '';

    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        try {
            $user = Auth::user();

            $validated = $this->validate([
                'name' => ['required', 'string', 'max:255'],

                'email' => [
                    'required',
                    'string',
                    'lowercase',
                    'email',
                    'max:255',
                    Rule::unique(User::class)->ignore($user->id),
                ],
            ]);

            $user->fill($validated);

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            $this->dispatch('profile-updated', name: $user->name);
            $this->success('Profil mis à jour avec succès !');
        } catch (\Exception $e) {
            $this->error('Une erreur est survenue lors de la mise à jour du profil.');
        }
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        try {
            $user = Auth::user();

            if ($user->hasVerifiedEmail()) {
                $this->redirectIntended(default: route('dashboard', absolute: false));

                return;
            }

            $user->sendEmailVerificationNotification();

            $this->info('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.');
        } catch (\Exception $e) {
            $this->error('Impossible d\'envoyer le lien de vérification. Veuillez réessayer plus tard.');
        }
    }
}
