<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Démarrage de la session')" :description="__('Entrez votre code de la pharmacie')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="identify" class="flex flex-col gap-6">
        <!-- Tenant Code -->
        <flux:input
            wire:model="name"
            :label="__('Code Pharmacie')"
            type="text"
            required
            autofocus
            autocomplete="name"
            placeholder="TENANT1"
        />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('Démarrer la Session') }}</flux:button>
        </div>
    </form>


</div>

