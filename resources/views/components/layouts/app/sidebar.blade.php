@props(['title' => 'Tableau de bord'])

<!-- Sidebar -->
<div id="sidebar" class="sidebar fixed top-0 left-0 h-screen bg-white dark:bg-gray-800 shadow-lg z-50 overflow-y-auto border-r border-gray-200 dark:border-gray-700">
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
        <a href="{{ route('dashboard') }}" class="flex items-center" wire:navigate>
            <i class="fas fa-pills text-2xl text-primary-light dark:text-primary-dark mr-2"></i>
            <span class="logo-text text-xl font-bold">Nsoko<span class="text-primary-light dark:text-primary-dark">Pharma</span></span>
        </a>
        <button id="sidebar-toggle" class="p-1 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Search Bar -->
    <div class="p-4 search-bar">
        <div class="relative">
            <input
                type="text"
                placeholder="Rechercher..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark bg-white dark:bg-gray-700"
            >
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-2">
        <!-- Platform Section -->
        <div class="px-4 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
            <span class="nav-text">Plateforme</span>
        </div>

        <a href="{{ route('dashboard') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 relative {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}" wire:navigate>
            <i class="fas fa-tachometer-alt w-6 text-center mr-3 text-primary-light dark:text-primary-dark"></i>
            <span class="nav-text">Tableau de bord</span>
            <span class="nav-tooltip">Tableau de bord</span>
        </a>
        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 relative {{ request()->routeIs('products') ? 'bg-gray-100 dark:bg-gray-700' : '' }}" wire:navigate>
            <i class="fas fa-pills w-6 text-center mr-3 text-secondary-light dark:text-secondary-dark"></i>
            <span class="nav-text">Produits et stocks</span>
            <span class="nav-tooltip">Produits et stocks</span>
        </a>
        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 relative {{ request()->routeIs('sales') ? 'bg-gray-100 dark:bg-gray-700' : '' }}" wire:navigate>
            <i class="fas fa-shopping-cart w-6 text-center mr-3 text-green-500 dark:text-green-400"></i>
            <span class="nav-text">Ventes</span>
            <span class="nav-tooltip">Ventes</span>
        </a>
        <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 relative {{ request()->routeIs('reports') ? 'bg-gray-100 dark:bg-gray-700' : '' }}" wire:navigate>
            <i class="fas fa-chart-bar w-6 text-center mr-3 text-yellow-500 dark:text-yellow-400"></i>
            <span class="nav-text">Rapports et analyses</span>
            <span class="nav-tooltip">Rapports et analyses</span>
        </a>

        <!-- Resources Section -->
        <div class="px-4 py-2 mt-6 text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
            <span class="nav-text">Ressources</span>
        </div>
        <a href="https://github.com/user/nsokopharma" target="_blank" class="nav-item flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 relative">
            <i class="fab fa-github w-6 text-center mr-3 text-gray-500 dark:text-gray-400"></i>
            <span class="nav-text">Repository</span>
            <span class="nav-tooltip">Repository</span>
        </a>
        <a href="/docs" class="nav-item flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 relative">
            <i class="fas fa-book w-6 text-center mr-3 text-gray-500 dark:text-gray-400"></i>
            <span class="nav-text">Documentation</span>
            <span class="nav-tooltip">Documentation</span>
        </a>
    </nav>
</div>

<!-- Header -->
<header class="fixed top-0 left-0 right-0 z-40 bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 transition-all duration-300" id="header">
    <div class="flex items-center justify-between h-16 pl-4 pr-4 ml-64 transition-all duration-300" id="header-content">
        <!-- Left side -->
        <div class="flex items-center lg:hidden">
            <button id="mobile-sidebar-toggle" class="p-2 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Right side -->
        <div class="flex items-center ml-auto space-x-4">
            <!-- Dark mode toggle -->
            <button id="dark-mode-toggle" class="p-2 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                <i class="fas fa-moon"></i>
            </button>

            <!-- Notifications -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 relative">
                    <i class="fas fa-bell"></i>
                    <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">2</span>
                </button>

                <!-- Notifications dropdown -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-80 rounded-lg shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5" style="display: none;">
                    <div class="p-2">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Notifications</div>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <div class="font-medium">Nouvelle vente</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Il y a 5 minutes</div>
                        </a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                            <div class="font-medium">Stock faible</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Il y a 10 minutes</div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-3 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2">
                    <div class="h-8 w-8 rounded-lg bg-primary-light dark:bg-primary-dark flex items-center justify-center text-white">
                        <span>{{ auth()->user()->initials() }}</span>
                    </div>
                    <div class="hidden md:block text-left">
                        <div class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</div>
                    </div>
                </button>

                <!-- Profile dropdown panel -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5" style="display: none;">
                    <div class="py-1">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Mon profil</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Paramètres</a>
                        <hr class="my-1 border-gray-200 dark:border-gray-700">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div id="main-content" class="main-content ml-64 transition-all duration-300 pt-16">
    {{ $slot }}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const header = document.getElementById('header');
        const headerContent = document.getElementById('header-content');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
        const darkModeToggle = document.getElementById('dark-mode-toggle');

        function toggleSidebar() {
            sidebar.classList.toggle('sidebar-collapsed');
            mainContent.classList.toggle('ml-64');
            mainContent.classList.toggle('ml-20');
            headerContent.classList.toggle('ml-64');
            headerContent.classList.toggle('ml-20');
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        mobileSidebarToggle.addEventListener('click', toggleSidebar);

        darkModeToggle.addEventListener('click', function() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
        });

        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        }
    });
</script>
