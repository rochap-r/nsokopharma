<?php

namespace App\Livewire\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        if (!tenant()) {
            abort(403, 'Vous n\'avez pas la permission d\'accéder à cette ressource.');
        }

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        // Create the admin role for the tenant
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        // Assign the permissions to the role admin
        $adminRole->syncPermissions(Permission::all());
        // Assign the role to the user
        $user->assignRole($adminRole);

        Auth::login($user);

        $tenant = $user->tenant;
        $tenantDomain = $tenant->domains()->first()->domain;
        $dashboardUrl = tenant_route($tenantDomain, 'dashboard');
        $this->redirectIntended(default:$dashboardUrl, navigate: true);
    }
}
