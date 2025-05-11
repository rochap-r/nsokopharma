<!-- Header -->
<header class="fixed top-0 right-0 z-30 bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 transition-all duration-300" :class="{'left-64': sidebarOpen, 'left-20': !sidebarOpen}">
    <div class="flex items-center justify-between h-16 px-4">
        <!-- Mobile menu button -->
        <button @click="toggleSidebar" class="p-1 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none lg:hidden">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Page Title -->
        <h1 class="text-xl font-semibold text-gray-900 dark:text-white hidden lg:block">{{ $title }}</h1>

        <!-- Mobile Header -->
        <div class="mobile-header flex items-center lg:hidden">
            <i class="fas fa-prescription-bottle-alt text-xl text-primary-600 dark:text-primary-400 mr-2"></i>
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white">NsokoPharmacy</h1>
        </div>

        <!-- Right-side header content -->
        <div class="flex items-center space-x-4">
            <!-- Dark Mode Toggle -->
            <button @click="toggleDarkMode" class="p-1 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none">
                <i class="fas" :class="{'fa-moon': !darkMode, 'fa-sun': darkMode}"></i>
            </button>

            <!-- Notifications Dropdown -->
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open" class="p-1 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none relative">
                    <i class="fas fa-bell"></i>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                </button>
                <div x-show="open" class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 shadow-lg rounded-md py-1 z-50" style="display: none;">
                    <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Notifications</h3>
                    </div>
                    <div class="max-h-60 overflow-y-auto">
                        <a href="#" class="block px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-primary-100 dark:bg-primary-900 rounded-full p-1">
                                    <i class="fas fa-bell text-primary-600 dark:text-primary-400"></i>
                                </div>
                                <div class="ml-3 w-0 flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Stocks bas</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Paracétamol 500mg est à 10% du stock</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Il y a 30 minutes</p>
                                </div>
                            </div>
                        </a>
                        <!-- Plus de notifications... -->
                    </div>
                    <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-700">
                        <a href="#" class="text-xs text-primary-600 dark:text-primary-400 hover:underline">Voir toutes les notifications</a>
                    </div>
                </div>
            </div>

            <!-- User Menu -->
            @auth
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                        {{ auth()->user()->initials() }}
                    </span>
                    <span class="hidden md:block text-sm text-gray-900 dark:text-white">{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-lg rounded-md py-1 z-50" style="display: none;">
                    <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                {{ auth()->user()->initials() }}
                            </span>
                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('settings.profile') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-user mr-2"></i> {{ __('Mon Profil') }}
                    </a>
                    @can('manage-roles')
                    <a href="{{ route('settings.roles.index') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-user-shield mr-2"></i> {{ __('Rôles et Permissions') }}
                    </a>
                    @endcan
                    <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>
</header>
