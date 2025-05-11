<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class ConfirmPassword extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Toggle theme preferences
     */
    public function toggleTheme()
    {
        $theme = cookie('theme') === 'dark' ? 'light' : 'dark';
        cookie()->queue(cookie('theme', $theme, 60 * 24 * 365));
    }

    public function render()
    {
        return view('livewire.auth.confirm-password', [
            'title' => 'Confirmation du mot de passe'
        ]);
    }
}
