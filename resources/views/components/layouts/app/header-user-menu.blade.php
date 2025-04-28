@auth
<!-- Menu utilisateur adapté Flux pour l'entête, version robuste et interactive -->
<div class="flex items-center gap-4 relative" style="overflow:visible;">
    <flux:dropdown position="bottom" align="end" class="relative">
        <flux:profile
            :name="auth()->user()->name"
            :initials="auth()->user()->initials()"
            icon-trailing="chevrons-up-down"
        />
        <flux:menu
            class="absolute right-0 top-full mt-2 w-48 max-h-[80vh] z-50 overflow-y-auto"
            style="min-width:12rem;">
            <flux:menu.radio.group>
                <div class="p-0 text-sm font-normal">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                        <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                            <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                {{ auth()->user()->initials() }}
                            </span>
                        </span>
                        <div class="grid flex-1 text-start text-sm leading-tight">
                            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                            <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
            </flux:menu.radio.group>
            <flux:menu.separator />
            @cannot('view-roles')
            <flux:menu.radio.group>
                <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
            </flux:menu.radio.group>
            @endcan
            <flux:menu.separator />
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                    {{ __('Log Out') }}
                </flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</div>
@endauth
