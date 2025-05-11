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

    public string $pharmacy_name = '';

    public string $pharmacy_address = '';

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
            'pharmacy_name' => ['required', 'string', 'max:255'],
            'pharmacy_address' => ['required', 'string', 'max:255'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            // Stockez des informations sur la pharmacie dans les métadonnées de l'utilisateur
            'meta' => [
                'pharmacy_name' => $validated['pharmacy_name'],
                'pharmacy_address' => $validated['pharmacy_address']
            ]
        ]);

        event(new Registered($user));

        // Create the admin role for the tenant
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

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
        return view('livewire.auth.register', [
            'title' => 'Création de compte'
        ]);
    }

    /**
     * Toggle theme preferences
     */
    public function toggleTheme()
    {
        $theme = cookie('theme') === 'dark' ? 'light' : 'dark';
        cookie()->queue(cookie('theme', $theme, 60 * 24 * 365));
    }
}
