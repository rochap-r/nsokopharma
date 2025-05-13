<?php

declare(strict_types=1);

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\ScopeSessions;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    'auth',
    InitializeTenancyByDomain::class,
    ScopeSessions::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/test', function () {
        return 'Bonjour Mr/Mme: ' . User::findOrFail(1)->name;
    });

    Route::view('/', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');


    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    
    // Routes pour les rôles et permissions
    Route::get('settings/roles', App\Livewire\Settings\Roles\Index::class)
        ->name('settings.roles.index')
        ->middleware('can:manage-roles');
    Route::get('settings/roles/create', App\Livewire\Settings\Roles\CreateEdit::class)
        ->name('settings.roles.create')
        ->middleware('can:manage-roles');
    Route::get('settings/roles/{id}/edit', App\Livewire\Settings\Roles\CreateEdit::class)
        ->name('settings.roles.edit')
        ->middleware('can:manage-roles');
    Route::get('settings/roles/{id}/permissions', App\Livewire\Settings\Roles\Permissions::class)
        ->name('settings.roles.permissions')
        ->middleware('can:manage-roles');

    // Routes pour la gestion des utilisateurs
    Route::get('settings/users', App\Livewire\Settings\Users\Index::class)
        ->name('settings.users.index')
        ->middleware('can:manage-users');
    Route::get('settings/users/create', App\Livewire\Settings\Users\CreateEdit::class)
        ->name('settings.users.create')
        ->middleware('can:manage-users');
    Route::get('settings/users/{id}/edit', App\Livewire\Settings\Users\CreateEdit::class)
        ->name('settings.users.edit')
        ->middleware('can:manage-users');
    Route::get('settings/users/{id}/show', App\Livewire\Settings\Users\Show::class)
        ->name('settings.users.show')
        ->middleware('can:manage-users');
});
