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
        // The first user to register will be the super-admin of the tenant
        // No other user can register after the first one
        if (!tenant()) {
            abort(403, 'Vous n\'avez pas la permission d\'accéder à cette ressource.');
        }
        if (User::all()->count()==!0){
            abort(403, 'Vous n\'avez pas la permission d\'accéder à cette ressource. contacter votre administrateur pour créer votre compte.');
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
        //ce code servira à filtrer les permissions pour l'admin tout en lui retirant celles qu'il ne doit pas avoir

        /*$filtered = User::whereNotIn('email', ['morris.champlin@example.com', 'rod99@example.net']);
        $filtered=$filtered->get();
        dd($filtered);*/
        $permissions=Permission::WhereNotIn('name',[])->get();

        // Assign the permissions to the role admin
        $adminRole->syncPermissions($permissions);
        // Assign the role to the user
        $user->assignRole($adminRole);

        Auth::login($user);

        $tenant = $user->tenant;
        $tenantDomain = $tenant->domains()->first()->domain;
        $dashboardUrl = tenant_route($tenantDomain, 'dashboard');
        $this->redirectIntended(default:$dashboardUrl, navigate: true);
    }

    public function render()
    {

        // If there is no tenant or the tenant already has at least one user,
        // redirect the user to the home page
        if (!tenant() || User::all()->count() != 0) {
            $this->redirectIntended(default: route('home', absolute: false), navigate: true);
        }
        return view('livewire.auth.register');
    }
}
