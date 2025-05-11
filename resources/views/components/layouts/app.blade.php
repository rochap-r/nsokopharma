<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{darkMode: localStorage.getItem('darkMode') === 'true'}" :class="{'dark': darkMode}">
<head>
    @include('partials.head')
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    <div class="min-h-screen">
        <x-toast />
        <x-layouts.app.sidebar>
            {{ $slot }}
        </x-layouts.app.sidebar>

        @fluxScripts
        @stack('scripts')
    </div>
</body>
</html>
