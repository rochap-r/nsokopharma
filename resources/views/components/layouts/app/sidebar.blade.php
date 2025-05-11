@props(['title' => 'Tableau de bord'])

<!-- Sidebar -->
<div
    x-data="{
        sidebarOpen: true,
        darkMode: localStorage.getItem('darkMode') === 'true',
        activeTooltip: null,
        tooltipText: '',
        tooltipVisible: false,
        tooltipTop: 0,
        showTooltip(event, text) {
            if (!this.sidebarOpen) {
                this.tooltipText = text;
                this.tooltipTop = event.target.getBoundingClientRect().top + window.scrollY;
                this.tooltipVisible = true;
            }
        },
        hideTooltip() {
            this.tooltipVisible = false;
        },
        toggleSidebar() {
            this.sidebarOpen = !this.sidebarOpen;
            if (!this.sidebarOpen) {
                document.getElementById('sidebar').classList.add('sidebar-collapsed');
                // Force masquer tous les éléments tenant-text
                document.querySelectorAll('.tenant-text').forEach(el => {
                    el.style.display = 'none';
                    el.style.visibility = 'hidden';
                });
            } else {
                document.getElementById('sidebar').classList.remove('sidebar-collapsed');
                this.tooltipVisible = false;
                // Réinitialiser le style des éléments tenant-text (Alpine.js reprendra le contrôle)
                if (this.sidebarOpen) {
                    setTimeout(() => {
                        document.querySelectorAll('.tenant-text').forEach(el => {
                            el.style.display = '';
                            el.style.visibility = '';
                        });
                    }, 10);
                }
            }
        },
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', this.darkMode);
            window.dispatchEvent(new CustomEvent('dark-mode-toggled'));
        }
    }"
    x-init="
        if (darkMode) document.documentElement.classList.add('dark');
        $watch('darkMode', value => localStorage.setItem('darkMode', value));
    "
    class="min-h-screen"
>
    <!-- Tooltip flottant global (un seul pour toute l'application) -->
    <div
        x-show="tooltipVisible"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        :style="`top: ${tooltipTop}px; left: 5rem;`"
        class="fixed z-50 py-1 px-2 bg-gray-900 text-white text-xs rounded shadow-lg pointer-events-none"
        style="display: none;"
        @mouseleave="hideTooltip()"
    >
        <span x-text="tooltipText"></span>
    </div>

    <div id="sidebar" class="sidebar fixed top-0 left-0 h-full w-64 bg-white dark:bg-gray-800 shadow-lg z-40 border-r border-gray-200 dark:border-gray-700 transition-all duration-300 flex flex-col" :class="{'w-20': !sidebarOpen}"
         @mouseleave="hideTooltip()">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between h-16 p-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center" wire:navigate>
                    <x-app-logo />
                </a>
            </div>
            <button @click="toggleSidebar" class="p-2 rounded-lg bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600">
                <i class="fas fa-bars text-gray-700 dark:text-gray-300"></i>
            </button>
        </div>

        <!-- Navigation Links (Scrollable) -->
        <div class="flex-1 overflow-y-auto py-2">
            <div class="nav-item">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}"
                   @mouseenter="showTooltip($event, 'Tableau de bord')"
                   @mouseleave="hideTooltip()"
                   wire:navigate>
                    <div class="flex items-center">
                        <i class="fas fa-tachometer-alt w-6 text-center text-primary-600 dark:text-primary-400 flex items-center"></i>
                        <span class="ml-3 nav-text" x-show="sidebarOpen" style="display: none;" x-transition:enter.duration.300ms x-transition:leave.duration.0ms>Tableau de bord</span>
                    </div>
                </a>
            </div>

            <div class="nav-item">
                <a href="#" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700"
                   @mouseenter="showTooltip($event, 'Produits et stocks')"
                   @mouseleave="hideTooltip()">
                    <div class="flex items-center">
                        <i class="fas fa-pills w-6 text-center text-secondary-600 dark:text-secondary-400 flex items-center"></i>
                        <span class="ml-3 nav-text" x-show="sidebarOpen" style="display: none;" x-transition:enter.duration.300ms x-transition:leave.duration.0ms>Produits et stocks</span>
                    </div>
                </a>
            </div>

            <div class="nav-item">
                <a href="#" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700"
                   @mouseenter="showTooltip($event, 'Ventes')"
                   @mouseleave="hideTooltip()">
                    <div class="flex items-center">
                        <i class="fas fa-shopping-cart w-6 text-center text-green-600 dark:text-green-400 flex items-center"></i>
                        <span class="ml-3 nav-text" x-show="sidebarOpen" style="display: none;" x-transition:enter.duration.300ms x-transition:leave.duration.0ms>Ventes</span>
                    </div>
                </a>
            </div>

            <div class="nav-item">
                <a href="#" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700"
                   @mouseenter="showTooltip($event, 'Rapports et analyses')"
                   @mouseleave="hideTooltip()">
                    <div class="flex items-center">
                        <i class="fas fa-chart-bar w-6 text-center text-yellow-600 dark:text-yellow-400 flex items-center"></i>
                        <span class="ml-3 nav-text" x-show="sidebarOpen" style="display: none;" x-transition:enter.duration.300ms x-transition:leave.duration.0ms>Rapports et analyses</span>
                    </div>
                </a>
            </div>

            <!-- Resources Section -->
            <div class="px-4 py-2 mt-6" x-show="sidebarOpen">
                <h2 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Ressources
                </h2>
            </div>

            <div class="nav-item">
                <a href="#" target="_blank" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700"
                   @mouseenter="showTooltip($event, 'Repository')"
                   @mouseleave="hideTooltip()">
                    <div class="flex items-center">
                        <i class="fab fa-github w-6 text-center text-gray-500 dark:text-gray-400 flex items-center"></i>
                        <span class="ml-3 nav-text" x-show="sidebarOpen" style="display: none;" x-transition:enter.duration.300ms x-transition:leave.duration.0ms>Repository</span>
                    </div>
                </a>
            </div>

            <div class="nav-item">
                <a href="/docs" class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700"
                   @mouseenter="showTooltip($event, 'Documentation')"
                   @mouseleave="hideTooltip()">
                    <div class="flex items-center">
                        <i class="fas fa-book w-6 text-center text-gray-500 dark:text-gray-400 flex items-center"></i>
                        <span class="ml-3 nav-text" x-show="sidebarOpen" style="display: none;" x-transition:enter.duration.300ms x-transition:leave.duration.0ms>Documentation</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Tenant Info (Fixed at bottom) -->
        <div class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 mt-auto"
            :class="sidebarOpen ? 'px-4 py-4 flex items-center' : 'flex justify-center items-center py-4'">
            <div
                @mouseenter="showTooltip($event, 'Pharmacie du Peuple - Kolwezi, RDC')"
                @mouseleave="hideTooltip()"
                class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-store w-6 text-center text-primary-600 dark:text-primary-400"></i>
                </div>
                <div
                    class="ml-3 tenant-text"
                    x-show="sidebarOpen"
                    x-cloak
                    style="display: none;"
                >
                    <p class="text-sm font-medium text-gray-900 dark:text-white">Pharmacie du Peuple</p>
                    <p class="text-xs text-gray-500 dark:text-red-400">Kolwezi, RDC</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header -->
    @include('components.layouts.app.header')

    <!-- Main Content -->
    <main class="pt-16 transition-all duration-300 flex-1 flex flex-col" :class="{'ml-64': sidebarOpen, 'ml-20': !sidebarOpen}">
        <div class="p-6 w-full h-full bg-gray-50 dark:bg-gray-900">
            {{ $slot }}
        </div>
    </main>
</div>
