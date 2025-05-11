<?php

namespace App\Livewire\Tenants;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Identificator extends Component
{
    #[Validate('required|string')]
    public string $name = '';

    public function identify():void
    {

        $this->validate();
        $this->name=Str::lower($this->name);
        $tenant=Tenant::where('id',$this->name)->first();
        //dd($tenant);

        $tenantDomain = $tenant->domains()->first()->domain;
        $dashboardUrl = tenant_route($tenantDomain, 'login');
        //dd($dashboardUrl);
        //$this->redirect($dashboardUrl);
        $this->redirect($dashboardUrl, navigate: false);

    }
    public function render()
    {
        return view('livewire.tenants.identificator');
    }
}
