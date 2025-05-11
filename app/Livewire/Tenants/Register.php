<?php

namespace App\Livewire\Tenants;

use App\Models\Tenant;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('components.layouts.auth')]
class Register extends Component
{

    public string $name = '';

    public string $address = '';
    public string $phone = '';

    public function create()
    {
        $messages = [
            'name.required' => 'Le champ Nom de l\'établissement est obligatoire.',
            'name.string' => 'Le champ Nom de l\'établissement doit être une chaîne de caractères.',
            'name.max' => 'Le champ Nom de l\'établissement ne doit pas dépasser 255 caractères.',
            'name.unique' => 'Ce Nom de l\'établissement est déjà utilisé.',

            'address.required' => 'Le champ Adresse est obligatoire.',
            'address.string' => 'Le champ Adresse doit être une chaîne de caractères.',
            'address.max' => 'Le champ Adresse ne doit pas dépasser 255 caractères.',

            'phone.required' => 'Le champ Téléphone est obligatoire.',
            'phone.string' => 'Le champ Téléphone doit être une chaîne de caractères.',
            'phone.max' => 'Le champ Téléphone ne doit pas dépasser 255 caractères.',
            'phone.unique' => 'Ce numéro de Téléphone est déjà utilisé.',
        ];


        $validated=$this->validate([
            'name' => ['required', 'string', 'max:255','unique:'.Tenant::class],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255','unique:'.Tenant::class],
        ],$messages);
        $validated['id']= Str::random(6);
        //dd($validated);
        $tenant=Tenant::create($validated);
        $tenant_id=$tenant->id;

        $tenant->domains()->create(['domain' => $tenant_id.'.'. parse_url(config('app.url'), PHP_URL_HOST)]);

        $tenantDomain = $tenant->domains()->first()->domain;
        $dashboardUrl = tenant_route($tenantDomain, 'login');

        $this->redirect($dashboardUrl, navigate: false);
    }

    public function render()
    {
        return view('livewire.tenants.register');
    }
}
