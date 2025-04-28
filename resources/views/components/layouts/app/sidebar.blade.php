@props(['title' => 'Tableau de bord'])

<!-- Sidebar -->
<div
    x-data="{
        sidebarOpen: true,
        darkMode: localStorage.getItem('darkMode') === 'true',
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            document.getElementById('sidebar').classList.toggle('sidebar-collapsed');
        },
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', this.darkMode);
        }
    }"
    x-init="
        if (darkMode) document.documentElement.classList.add('dark');
        $watch('darkMode', value => localStorage.setItem('darkMode', value))
    "
    class="min-h-screen"
>
    <div id="sidebar" class="sidebar fixed top-0 left-0 h-screen bg-white dark:bg-gray-800 shadow-lg z-50 overflow-y-auto border-r border-gray-200 dark:border-gray-700">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
            <a href="{{ route('dashboard') }}" class="flex items-center" wire:navigate>
                <div class="flex items-center">
                    <i class="fas fa-pills text-2xl mb-2 mr-0.5 flex items-center" style="color: #2563eb!important;"></i>
                    <div class="logo-text font-bold text-lg" x-show="sidebarOpen">
                        <span style="color: #000!important;">Nsoko</span><span style="color: #2563eb;">Pharma</span>
                    </div>
                </div>
            </a>
            <button @click="toggleSidebar" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="fas fa-bars text-gray-500 dark:text-gray-400"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="mt-2">
            <div class="nav-item">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}" wire:navigate>
                    <div class="flex items-center">
                        <i class="fas fa-tachometer-alt w-6 text-center text-primary-600 dark:text-primary-400 flex items-center"></i>
                        <span class="ml-3" x-show="sidebarOpen">Tableau de bord</span>
                    </div>
                </a>
                <div class="nav-tooltip">Tableau de bord</div>
            </div>

            <div class="nav-item">
                <a href="#" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-pills w-6 text-center text-secondary-600 dark:text-secondary-400 flex items-center"></i>
                        <span class="ml-3" x-show="sidebarOpen">Produits et stocks</span>
                    </div>
                </a>
                <div class="nav-tooltip">Produits et stocks</div>
            </div>

            <div class="nav-item">
                <a href="#" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-shopping-cart w-6 text-center text-green-600 dark:text-green-400 flex items-center"></i>
                        <span class="ml-3" x-show="sidebarOpen">Ventes</span>
                    </div>
                </a>
                <div class="nav-tooltip">Ventes</div>
            </div>

            <div class="nav-item">
                <a href="#" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-chart-bar w-6 text-center text-yellow-600 dark:text-yellow-400 flex items-center"></i>
                        <span class="ml-3" x-show="sidebarOpen">Rapports et analyses</span>
                    </div>
                </a>
                <div class="nav-tooltip">Rapports et analyses</div>
            </div>

            <!-- Resources Section -->
            <div class="px-4 py-2 mt-6" x-show="sidebarOpen">
                <h2 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Ressources
                </h2>
            </div>

            <div class="nav-item">
                <a href="#" target="_blank" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fab fa-github w-6 text-center text-gray-500 dark:text-gray-400 flex items-center"></i>
                        <span class="ml-3" x-show="sidebarOpen">Repository</span>
                    </div>
                </a>
                <div class="nav-tooltip">Repository</div>
            </div>

            <div class="nav-item">
                <a href="/docs" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex items-center">
                        <i class="fas fa-book w-6 text-center text-gray-500 dark:text-gray-400 flex items-center"></i>
                        <span class="ml-3" x-show="sidebarOpen">Documentation</span>
                    </div>
                </a>
                <div class="nav-tooltip">Documentation</div>
            </div>

            <!-- Tenant Info (Collapsible) -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-store w-6 text-center text-primary-light dark:text-primary-dark"></i>
                    </div>
                    <div class="ml-3 nav-text">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Pharmacie du Peuple</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Kolwezi, RDC</p>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Menu utilisateur supprimé de la sidebar -->
    </div>

    <!-- Header -->
    <header class="fixed top-0 right-0 left-0 z-40 bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between h-16 px-4">
            <!-- Left side -->
            <div class="flex items-center lg:hidden">
                <button @click="toggleSidebar" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas fa-bars text-gray-500 dark:text-gray-400"></i>
                </button>
            </div>

            <!-- Right side -->
            <div class="flex items-center ml-auto space-x-4">
                <!-- Dark mode toggle -->
                <button @click="toggleDarkMode" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="fas" :class="darkMode ? 'fa-sun' : 'fa-moon'" class="text-gray-500 dark:text-gray-400"></i>
                </button>

                <!-- Notifications -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 relative">
                        <i class="fas fa-bell text-gray-500 dark:text-gray-400"></i>
                        <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-xs text-white">2</span>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 rounded-lg bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black ring-opacity-5">
                        <div class="p-2">
                            <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Notifications</div>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                                <div class="font-medium text-gray-900 dark:text-white">Nouvelle vente</div>
                                <div class="text-xs text-gray-500">Il y a 5 minutes</div>
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                                <div class="font-medium text-gray-900 dark:text-white">Stock faible</div>
                                <div class="text-xs text-gray-500">Il y a 10 minutes</div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Profile dropdown -->
                @include('components.layouts.app.header-user-menu')
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-16" :class="{'ml-64': sidebarOpen, 'ml-20': !sidebarOpen}">
        <div class="p-4">
            {{ $slot }}
        </div>
    </main>
</div>
