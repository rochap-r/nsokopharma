<div>
    <header class="mb-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold tracking-tight dark:text-white">{{ $title }}</h1>
        <button wire:click="back" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100 transition-colors">
            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour
        </button>
    </header>

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-900/20 dark:border-green-500 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
            class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-900/20 dark:border-red-500 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden dark:bg-gray-800 dark:border dark:border-gray-700">
        <div class="px-6 py-5 border-b border-gray-200 flex items-center space-x-4 dark:border-gray-700">
            <div class="h-16 w-16 rounded-full bg-primary-100 flex items-center justify-center dark:bg-primary-800/30">
                <span class="text-xl font-medium text-primary-700 dark:text-primary-300">{{ $user->initials() }}</span>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $user->name }}</h2>
                <p class="text-gray-600 dark:text-gray-300">{{ $user->email }}</p>
            </div>
        </div>

        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 mb-4 dark:text-white">Rôles</h3>
            @if ($user->roles->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">Aucun rôle attribué</p>
            @else
                <div class="flex flex-wrap gap-2">
                    @foreach ($user->roles as $role)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-300">
                            {{ $role->name }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-medium text-gray-900 mb-4 dark:text-white">Permissions (via rôles)</h3>
            @php
                $permissions = $user->getAllPermissions();
            @endphp

            @if ($permissions->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">Aucune permission</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($permissions->groupBy(function ($permission) {
                        $parts = explode('.', $permission->name);
                        return $parts[0] ?? 'Autre';
                    }) as $group => $perms)
                        <div class="border border-gray-200 rounded-lg overflow-hidden dark:border-gray-700">
                            <div class="bg-gray-50 px-4 py-2.5 border-b border-gray-200 dark:bg-gray-700 dark:border-gray-600">
                                <h4 class="font-medium text-gray-700 capitalize dark:text-gray-200">{{ $group }}</h4>
                            </div>
                            <ul class="divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                                @foreach ($perms as $permission)
                                    <li class="px-4 py-2.5 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $permission->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 dark:bg-gray-700">
            <a href="{{ route('settings.users.edit', ['id' => $user->id]) }}" class="inline-flex items-center px-4 py-2.5 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:ring-offset-gray-800 transition-colors">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 0L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Modifier
            </a>
        </div>
    </div>
</div>
