<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="create" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Nom de l\'Etablissement')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Pharmacie la Bonne Santé')"
        />

        <!-- Phone-->
        <flux:input
            wire:model="phone"
            :label="__('N° Téléphone')"
            type="tel"
            required
            autocomplete="phone"
            placeholder="+243 992522582"
        />

        <flux:textarea required wire:model="address" rows="2" :label="__('Adresse de L\'Etablissement')" autocomplete="address"
                       :placeholder="__('N° 115,Av:Kasongo, Q:Latin, C:Manika, Kolwezi')" />


        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Créer l\'Etablissement') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Avez-vous déjà créé l\'Etablissement?') }}
        <flux:link :href="route('identification')" wire:navigate>{{ __('Démarrer la session') }}</flux:link>
    </div>
</div>
