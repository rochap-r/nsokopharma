<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? 'NsokoPharma - Tableau de bord' }}</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<script src="https://cdn.tailwindcss.com"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    primary: {
                        light: '#3b82f6',
                        dark: '#1d4ed8'
                    },
                    secondary: {
                        light: '#10b981',
                        dark: '#059669'
                    },
                    danger: {
                        light: '#ef4444',
                        dark: '#dc2626'
                    },
                    warning: {
                        light: '#f59e0b',
                        dark: '#d97706'
                    }
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                },
            }
        }
    }
</script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        background-color: #f3f4f6;
    }

    .dark body {
        background-color: #111827;
    }

    .sidebar {
        transition: all 0.3s ease;
    }

    .sidebar-collapsed {
        width: 5rem;
    }

    .sidebar-collapsed .nav-text {
        display: none;
    }

    .sidebar-collapsed .logo-text {
        display: none;
    }

    .sidebar-collapsed .search-bar {
        display: none;
    }

    .main-content {
        transition: margin-left 0.3s ease;
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .dark .card-hover:hover {
        box-shadow: 0 10px 15px -3px rgba(255, 255, 255, 0.1), 0 4px 6px -2px rgba(255, 255, 255, 0.05);
    }

    /* Animation for alerts */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
        animation: fadeIn 0.3s ease forwards;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .dark ::-webkit-scrollbar-track {
        background: #374151;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .dark ::-webkit-scrollbar-thumb {
        background: #4b5563;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .dark ::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }
</style>
@fluxAppearance
@stack('styles')
