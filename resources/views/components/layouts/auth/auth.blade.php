<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ request()->cookie('theme') === 'dark' ? 'dark' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'NsokoPharma') }} - {{ $title ?? 'Authentification' }}</title>

    @include('partials.head')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            transition: background-color var(--transition-speed) ease, color var(--transition-speed) ease;
        }

        .dark body {
            background-color: #111827;
            color: #f3f4f6;
        }

        .auth-illustration {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(16, 185, 129, 0.1) 100%);
            transition: background var(--transition-speed) ease;
        }

        .dark .auth-illustration {
            background: linear-gradient(135deg, rgba(29, 78, 216, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);
        }

        .auth-btn {
            transition: all var(--transition-speed) ease;
        }

        .auth-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .dark .auth-btn:hover {
            box-shadow: 0 4px 6px -1px rgba(255, 255, 255, 0.1), 0 2px 4px -1px rgba(255, 255, 255, 0.06);
        }

        /* Amélioration des transitions pour le dark mode */
        header, main, footer, button, a, input, *, *::before, *::after {
            transition: background-color var(--transition-speed) ease,
            border-color var(--transition-speed) ease,
            color var(--transition-speed) ease,
            box-shadow var(--transition-speed) ease;
        }

        /* Amélioration du bouton de dark mode toggle */
        .theme-toggle {
            position: relative;
            width: 48px;
            height: 24px;
            border-radius: 24px;
            background-color: #e5e7eb;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
        }

        .dark .theme-toggle {
            background-color: #4b5563;
        }

        .theme-toggle-circle {
            position: absolute;
            top: 2px;
            left: 2px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            transition: transform var(--transition-speed) ease;
        }

        .dark .theme-toggle-circle {
            transform: translateX(24px);
            background-color: #f59e0b;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
<!-- Header -->
<header class="bg-white dark:bg-gray-800 shadow-sm">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('home') }}" class="flex items-center" wire:navigate>
                <x-app-logo />
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex items-center space-x-6">
            <a href="#"  class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors font-medium">
                Contacter le support
            </a>

            <!-- Dark Mode Toggle -->
            <button x-data="{ darkMode: document.documentElement.classList.contains('dark') }"
                    @click="darkMode = !darkMode; document.documentElement.classList.toggle('dark'); $wire.toggleTheme(); window.dispatchEvent(new CustomEvent('dark-mode-toggled'))"
                    class="theme-toggle" aria-label="Toggle dark mode">
                    <span class="theme-toggle-circle">
                        <i class="fas fa-moon text-gray-700 dark:hidden absolute inset-0 flex items-center justify-center text-xs"></i>
                        <i class="fas fa-sun text-yellow-300 hidden dark:inline absolute inset-0 flex items-center justify-center text-xs"></i>
                    </span>
            </button>
        </nav>
    </div>
</header>

<!-- Main Content -->
<main class="flex-grow">
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row items-start justify-center gap-10">
            <!-- Form Section -->
            <div class="w-full lg:w-5/12 order-2 lg:order-1">
                <div class="max-w-md mx-auto">
                    {{ $slot }}
                </div>
            </div>

            <!-- Illustration Section -->
            <div class="w-full lg:w-6/12 order-1 lg:order-2 flex justify-center items-center p-4">
                <div class="auth-illustration p-6 rounded-2xl lg:sticky lg:top-24 w-full max-w-lg">
                    <div class="relative">
                        <div class="absolute -inset-2 bg-primary-600 dark:bg-primary-700 rounded-lg opacity-10 blur-sm"></div>
                        <img
                            src="{{ global_asset('images/auth/login.png') }}"
                            alt="Pharmacie illustration"
                            class="relative rounded-lg shadow-md w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 dark:bg-gray-900 text-white py-8 mt-auto">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center mb-4">
                    <x-app-logo />
                </div>
                <p class="text-gray-400">
                    La solution de gestion pharmaceutique conçue pour les professionnels de santé en RDC.
                </p>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4">Liens utiles</h3>
                <ul class="space-y-2">
                    <li><a href="#"  class="text-gray-400 hover:text-white transition-colors">Support technique</a></li>
                    <li><a href="#"  class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="#"  class="text-gray-400 hover:text-white transition-colors">Documentation</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4">Légal</h3>
                <ul class="space-y-2">
                    <li><a href="#"  class="text-gray-400 hover:text-white transition-colors">Politique de confidentialité</a></li>
                    <li><a href="#"  class="text-gray-400 hover:text-white transition-colors">Conditions générales</a></li>
                    <li><a href="#"  class="text-gray-400 hover:text-white transition-colors">Politique des cookies</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'NsokoPharma') }}. Tous droits réservés.</p>
        </div>
    </div>
</footer>

@fluxScripts
</body>
</html>
