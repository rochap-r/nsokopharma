<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NsokoPharma - Gestion Simplifiée pour Votre Pharmacie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                        accent: {
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
        }

        .hero-gradient {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(16, 185, 129, 0.1) 100%);
        }

        .dark .hero-gradient {
            background: linear-gradient(135deg, rgba(29, 78, 216, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
        }

        .feature-card {
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .dark .feature-card:hover {
            box-shadow: 0 10px 25px -5px rgba(255, 255, 255, 0.05);
        }

        .benefit-icon {
            transition: all 0.3s ease;
        }

        .benefit-card:hover .benefit-icon {
            transform: scale(1.1);
        }

        .signup-step {
            position: relative;
            padding-left: 3rem;
        }

        .signup-step:before {
            content: '';
            position: absolute;
            left: 1.5rem;
            top: 0;
            height: 100%;
            width: 2px;
            background-color: #e5e7eb;
        }

        .dark .signup-step:before {
            background-color: #4b5563;
        }

        .signup-step:last-child:before {
            height: 50%;
        }

        .signup-step-number {
            position: absolute;
            left: 0;
            top: 0;
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            background-color: #3b82f6;
            color: white;
        }

        .dark .signup-step-number {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-colors duration-300">
<!-- Header/Navigation -->
<header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md shadow-sm">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center">
            <i class="fas fa-pills text-3xl text-primary-light dark:text-primary-dark mr-2"></i>
            <span class="text-2xl font-bold">Nsoko<span class="text-primary-light dark:text-primary-dark">Pharma</span></span>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex space-x-8">
            <a href="#about" class="font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">À propos</a>
            <a href="#features" class="font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Fonctionnalités</a>
            <a href="#benefits" class="font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Avantages</a>
            <a href="#signup" class="font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Inscription</a>
            <a href="#contact" class="font-medium hover:text-primary-light dark:hover:text-primary-dark transition-colors">Contact</a>
        </nav>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="md:hidden text-gray-600 dark:text-gray-300">
            <i class="fas fa-bars text-2xl"></i>
        </button>

        <!-- Dark Mode Toggle -->
        <button id="dark-mode-toggle" class="ml-4 p-2 rounded-full bg-gray-200 dark:bg-gray-700">
            <i class="fas fa-moon text-gray-700 dark:hidden"></i>
            <i class="fas fa-sun text-yellow-300 hidden dark:inline"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 py-2 px-4 shadow-lg">
        <a href="#about" class="block py-2 hover:text-primary-light dark:hover:text-primary-dark transition-colors">À propos</a>
        <a href="#features" class="block py-2 hover:text-primary-light dark:hover:text-primary-dark transition-colors">Fonctionnalités</a>
        <a href="#benefits" class="block py-2 hover:text-primary-light dark:hover:text-primary-dark transition-colors">Avantages</a>
        <a href="#signup" class="block py-2 hover:text-primary-light dark:hover:text-primary-dark transition-colors">Inscription</a>
        <a href="#contact" class="block py-2 hover:text-primary-light dark:hover:text-primary-dark transition-colors">Contact</a>
    </div>
</header>

<!-- Hero Section -->
<section class="hero-gradient">
    <div class="container mx-auto px-4 py-16 md:py-24">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Gestion simplifiée pour votre pharmacie à Kolwezi
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                    NsokoPharma offre une solution complète pour gérer efficacement votre pharmacie, avec des outils conçus spécifiquement pour les professionnels de santé en RDC.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('identification') }}" class="bg-primary-light dark:bg-primary-dark hover:bg-primary-dark dark:hover:bg-primary-light text-white font-bold py-3 px-6 rounded-lg text-center transition-colors shadow-lg hover:shadow-xl">
                        Démarrer la session !
                    </a>
                    <a href="{{ route('registration') }}" class="border-2 border-secondary-light dark:border-primary-dark text-primary-light dark:text-primary-dark hover:bg-gray-100 dark:hover:bg-gray-700 font-bold py-3 px-6 rounded-lg text-center transition-colors">
                        Créer Votre Etablissement
                    </a>
                </div>
            </div>
            <div class="md:w-1/2">
                <div class="relative">
                    <div class="absolute -inset-4 bg-primary-light dark:bg-primary-dark rounded-2xl opacity-20 blur-lg"></div>
                    <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80"
                         alt="Pharmacien travaillant"
                         class="relative w-full h-auto rounded-xl shadow-xl">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-16 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4">À propos de NsokoPharma</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Une solution conçue spécifiquement pour répondre aux besoins des pharmacies en RDC
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h3 class="text-2xl font-bold mb-4">Notre mission</h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    NsokoPharma a été créé pour simplifier la gestion quotidienne des pharmacies en République Démocratique du Congo. Notre plateforme intuitive permet aux professionnels de santé de gérer efficacement leurs stocks, leurs ventes et leur personnel.
                </p>
                <h3 class="text-2xl font-bold mb-4">Pourquoi choisir NsokoPharma ?</h3>
                <ul class="space-y-3 text-gray-600 dark:text-gray-300">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-secondary-light dark:text-secondary-dark mt-1 mr-2"></i>
                        <span>Conçu spécifiquement pour le marché congolais</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-secondary-light dark:text-secondary-dark mt-1 mr-2"></i>
                        <span>Interface simple et intuitive</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-secondary-light dark:text-secondary-dark mt-1 mr-2"></i>
                        <span>Accessible depuis n'importe quel appareil</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-secondary-light dark:text-secondary-dark mt-1 mr-2"></i>
                        <span>Support technique local</span>
                    </li>
                </ul>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 p-8 rounded-xl shadow-md">
                <h3 class="text-2xl font-bold mb-6 text-center">Notre équipe</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="bg-primary-light dark:bg-primary-dark text-white p-4 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-md text-3xl"></i>
                        </div>
                        <h4 class="font-bold">Dr. Jean K.</h4>
                        <p class="text-gray-600 dark:text-gray-300">Pharmacien consultant</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-primary-light dark:bg-primary-dark text-white p-4 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-laptop-code text-3xl"></i>
                        </div>
                        <h4 class="font-bold">Marie L.</h4>
                        <p class="text-gray-600 dark:text-gray-300">Développeuse principale</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-primary-light dark:bg-primary-dark text-white p-4 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chart-line text-3xl"></i>
                        </div>
                        <h4 class="font-bold">Paul M.</h4>
                        <p class="text-gray-600 dark:text-gray-300">Expert en gestion</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-primary-light dark:bg-primary-dark text-white p-4 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-headset text-3xl"></i>
                        </div>
                        <h4 class="font-bold">Sophie N.</h4>
                        <p class="text-gray-600 dark:text-gray-300">Support client</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tenant Creation Section -->
<section id="tenant-creation" class="py-16 bg-gray-100 dark:bg-gray-700">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                <h2 class="text-3xl font-bold mb-6">Créez votre établissement en 2 étapes simples</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                    Commencez à utiliser NsokoPharma pour gérer votre pharmacie en quelques minutes seulement.
                </p>

                <div class="space-y-8">
                    <!-- Step 1 -->
                    <div class="signup-step">
                        <div class="signup-step-number">1</div>
                        <h3 class="text-xl font-bold mb-2">Informations de base</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Entrez le nom, l'adresse et le numéro de téléphone de votre établissement.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="signup-step">
                        <div class="signup-step-number">2</div>
                        <h3 class="text-xl font-bold mb-2">Confirmation</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Un email vous sera envoyé avec un code unique (par exemple code.domaine.com) pour démarrer votre session.
                        </p>
                    </div>
                </div>

                <div class="mt-10">
                    <button id="show-tenant-form" class="inline-block bg-primary-light dark:bg-primary-dark hover:bg-primary-dark dark:hover:bg-primary-light text-white font-bold py-3 px-6 rounded-lg transition-colors shadow-lg hover:shadow-xl">
                        Créer un établissement
                    </button>
                </div>
            </div>

            <div class="lg:w-1/2">
                <div id="tenant-form-container" class="hidden bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md">
                    <h3 class="text-2xl font-bold mb-6 text-center">Création d'établissement</h3>
                    <form id="tenant-form">
                        <div class="mb-4">
                            <label for="pharmacy-name" class="block font-medium mb-2">Nom de la pharmacie*</label>
                            <input type="text" id="pharmacy-name" name="pharmacy-name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark bg-white dark:bg-gray-700" required>
                        </div>

                        <div class="mb-4">
                            <label for="pharmacy-address" class="block font-medium mb-2">Adresse complète*</label>
                            <textarea id="pharmacy-address" name="pharmacy-address" rows="3" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark bg-white dark:bg-gray-700" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="pharmacy-phone" class="block font-medium mb-2">Numéro de téléphone*</label>
                            <input type="tel" id="pharmacy-phone" name="pharmacy-phone" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark bg-white dark:bg-gray-700" required>
                        </div>

                        <div class="mb-4">
                            <label for="admin-email" class="block font-medium mb-2">Email administrateur*</label>
                            <input type="email" id="admin-email" name="admin-email" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark bg-white dark:bg-gray-700" required>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Cet email recevra le code d'accès et aura les droits administrateur</p>
                        </div>

                        <button type="submit" class="w-full bg-primary-light dark:bg-primary-dark hover:bg-primary-dark dark:hover:bg-primary-light text-white font-bold py-3 px-6 rounded-lg transition-colors shadow-lg hover:shadow-xl">
                            Envoyer la demande
                        </button>
                    </form>
                </div>

                <div id="tenant-success" class="hidden bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md text-center">
                    <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-check text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Demande envoyée avec succès !</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">
                        Nous avons bien reçu votre demande de création d'établissement. Vous recevrez sous peu un email avec votre code d'accès unique.
                    </p>
                    <p class="text-gray-600 dark:text-gray-300">
                        Merci d'avoir choisi NsokoPharma !
                    </p>
                </div>

                <div id="tenant-image" class="relative">
                    <div class="absolute -inset-4 bg-accent-light dark:bg-accent-dark rounded-2xl opacity-20 blur-lg"></div>
                    <img src="data:image/jpeg;base64,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"
                         alt="Pharmacie bien organisée"
                         class="relative w-full h-auto rounded-xl shadow-xl">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Session Initiation Section -->
<section id="session-initiation" class="py-16 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                <h2 class="text-3xl font-bold mb-6">Démarrez votre session avec votre code d'établissement</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                    Rendez-vous sur le lien code.domaine.com pour accéder à votre espace sécurisé.
                </p>

                <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-xl mb-8">
                    <h3 class="text-xl font-bold mb-4">Comment trouver votre code ?</h3>
                    <ul class="space-y-3 text-gray-600 dark:text-gray-300">
                        <li class="flex items-start">
                            <span class="bg-primary-light dark:bg-primary-dark text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 flex-shrink-0">1</span>
                            <span>Vérifiez votre boîte email (y compris les spams)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-primary-light dark:bg-primary-dark text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 flex-shrink-0">2</span>
                            <span>Recherchez un email de NsokoPharma avec votre code unique</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-primary-light dark:bg-primary-dark text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 flex-shrink-0">3</span>
                            <span>Utilisez ce code pour accéder à votre espace</span>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="https://code.domaine.com" class="bg-primary-light dark:bg-primary-dark hover:bg-primary-dark dark:hover:bg-primary-light text-white font-bold py-3 px-6 rounded-lg text-center transition-colors shadow-lg hover:shadow-xl">
                        Démarrer une session
                    </a>
                    <button id="resend-code" class="border-2 border-primary-light dark:border-primary-dark text-primary-light dark:text-primary-dark hover:bg-gray-100 dark:hover:bg-gray-700 font-bold py-3 px-6 rounded-lg text-center transition-colors">
                        Renvoyer le code
                    </button>
                </div>
            </div>

            <div class="lg:w-1/2">
                <div class="relative">
                    <div class="absolute -inset-4 bg-primary-light dark:bg-primary-dark rounded-2xl opacity-20 blur-lg"></div>
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                         alt="Tablette avec interface NsokoPharma"
                         class="relative w-full h-auto rounded-xl shadow-xl">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-16 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4">Fonctionnalités clés</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Découvrez comment NsokoPharma simplifie la gestion quotidienne de votre pharmacie
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="feature-card bg-gray-50 dark:bg-gray-700 p-8 rounded-xl shadow-md">
                <div class="text-primary-light dark:text-primary-dark text-5xl mb-6">
                    <i class="fas fa-book"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Bibliothèque de produits</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Accédez à une base commune de produits déjà catégorisés pour une gestion rapide et efficace de votre inventaire.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card bg-gray-50 dark:bg-gray-700 p-8 rounded-xl shadow-md">
                <div class="text-primary-light dark:text-primary-dark text-5xl mb-6">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Rappels de péremption</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Alertes automatiques pour éviter la vente de produits expirés et optimiser la rotation de vos stocks.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card bg-gray-50 dark:bg-gray-700 p-8 rounded-xl shadow-md">
                <div class="text-primary-light dark:text-primary-dark text-5xl mb-6">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Gestion des stocks critiques</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Suivi en temps réel des produits à faible stock pour prévenir les ruptures et assurer la continuité de service.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="feature-card bg-gray-50 dark:bg-gray-700 p-8 rounded-xl shadow-md">
                <div class="text-primary-light dark:text-primary-dark text-5xl mb-6">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Rapports journaliers</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Génération automatique de rapports clairs pour suivre vos ventes et stocks au quotidien.
                </p>
            </div>

            <!-- Feature 5 -->
            <div class="feature-card bg-gray-50 dark:bg-gray-700 p-8 rounded-xl shadow-md">
                <div class="text-primary-light dark:text-primary-dark text-5xl mb-6">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Localisation des produits</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Système intuitif pour trouver rapidement chaque médicament grâce à son emplacement précis dans la pharmacie.
                </p>
            </div>

            <!-- Feature 6 -->
            <div class="feature-card bg-gray-50 dark:bg-gray-700 p-8 rounded-xl shadow-md">
                <div class="text-primary-light dark:text-primary-dark text-5xl mb-6">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Gestion d'équipe</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Attribuez des rôles et permissions à votre personnel pour une collaboration efficace et sécurisée.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section id="benefits" class="py-16 bg-gray-100 dark:bg-gray-700">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4">Pourquoi choisir NsokoPharma ?</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                La solution optimale pour les pharmacies de Kolwezi et de la RDC
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Benefit 1 -->
            <div class="benefit-card bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md">
                <div class="benefit-icon bg-primary-light dark:bg-primary-dark text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Gagnez du temps</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Automatisez les tâches répétitives et concentrez-vous sur vos patients plutôt que sur la paperasse.
                </p>
            </div>

            <!-- Benefit 2 -->
            <div class="benefit-card bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md">
                <div class="benefit-icon bg-primary-light dark:bg-primary-dark text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Réduisez les erreurs</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Minimisez les erreurs humaines dans la gestion des stocks et des prescriptions médicamenteuses.
                </p>
            </div>

            <!-- Benefit 3 -->
            <div class="benefit-card bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md">
                <div class="benefit-icon bg-primary-light dark:bg-primary-dark text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <i class="fas fa-chart-pie text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Augmentez vos profits</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Optimisez votre gestion des stocks et identifiez les opportunités commerciales grâce à nos analyses détaillées.
                </p>
            </div>

            <!-- Benefit 4 -->
            <div class="benefit-card bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md">
                <div class="benefit-icon bg-primary-light dark:bg-primary-dark text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <i class="fas fa-mobile-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Accès mobile</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Gérez votre pharmacie depuis n'importe où avec notre application mobile compatible smartphones et tablettes.
                </p>
            </div>

            <!-- Benefit 5 -->
            <div class="benefit-card bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md">
                <div class="benefit-icon bg-primary-light dark:bg-primary-dark text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <i class="fas fa-headset text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Support local</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Notre équipe basée à Kolwezi est disponible pour vous accompagner à chaque étape.
                </p>
            </div>

            <!-- Benefit 6 -->
            <div class="benefit-card bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md">
                <div class="benefit-icon bg-primary-light dark:bg-primary-dark text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mb-6">
                    <i class="fas fa-shield-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Sécurité des données</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    Vos données sont sécurisées et conformes aux réglementations locales de santé en RDC.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Signup Process Section -->
<section id="signup" class="py-16 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                <h2 class="text-3xl font-bold mb-6">Comment créer votre compte ?</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                    En quelques étapes simples, vous pouvez commencer à utiliser NsokoPharma pour gérer votre pharmacie.
                </p>

                <div class="space-y-8">
                    <!-- Step 1 -->
                    <div class="signup-step">
                        <div class="signup-step-number">1</div>
                        <h3 class="text-xl font-bold mb-2">Créez votre compte</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            La personne qui crée le compte devient automatiquement le gérant principal de la pharmacie.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="signup-step">
                        <div class="signup-step-number">2</div>
                        <h3 class="text-xl font-bold mb-2">Renseignez les informations</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Fournissez les informations de votre pharmacie (nom, adresse, etc.) et vos coordonnées personnelles.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="signup-step">
                        <div class="signup-step-number">3</div>
                        <h3 class="text-xl font-bold mb-2">Commencez à utiliser la plateforme</h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            Une fois l'inscription validée, vous pouvez immédiatement accéder à toutes les fonctionnalités.
                        </p>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="#contact" class="inline-block bg-primary-light dark:bg-primary-dark hover:bg-primary-dark dark:hover:bg-primary-light text-white font-bold py-3 px-6 rounded-lg transition-colors shadow-lg hover:shadow-xl">
                        Commencer l'inscription
                    </a>
                </div>
            </div>

            <div class="lg:w-1/2">
                <div class="relative">
                    <div class="absolute -inset-4 bg-accent-light dark:bg-accent-dark rounded-2xl opacity-20 blur-lg"></div>
                    <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                         alt="Pharmacien souriant"
                         class="relative w-full h-auto rounded-xl shadow-xl">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary-light dark:bg-primary-dark">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Prêt à révolutionner la gestion de votre pharmacie ?</h2>
        <p class="text-xl text-white/90 mb-8 max-w-3xl mx-auto">
            Rejoignez les pharmaciens de Kolwezi et de la RDC qui utilisent déjà NsokoPharma pour simplifier leur quotidien.
        </p>
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="#signup" class="bg-white text-primary-light dark:text-primary-dark hover:bg-gray-100 font-bold py-3 px-6 rounded-lg text-center transition-colors shadow-lg hover:shadow-xl">
                Essayez gratuitement aujourd'hui !
            </a>
            <a href="#contact" class="border-2 border-white text-white hover:bg-white hover:text-primary-light dark:hover:text-primary-dark font-bold py-3 px-6 rounded-lg text-center transition-colors">
                Contactez notre équipe
            </a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-16 bg-gray-100 dark:bg-gray-700">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl font-bold mb-6">Contactez-nous</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-8">
                    Vous avez des questions sur NsokoPharma ? Notre équipe est là pour vous aider. Remplissez le formulaire ou contactez-nous directement.
                </p>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="bg-primary-light dark:bg-primary-dark text-white p-3 rounded-full mr-4 flex-shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold mb-1">Adresse</h4>
                            <p class="text-gray-600 dark:text-gray-300">
                                Avenue des Pharmaciens, 456<br>
                                Kolwezi, Lualaba<br>
                                République Démocratique du Congo
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="bg-primary-light dark:bg-primary-dark text-white p-3 rounded-full mr-4 flex-shrink-0">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4 class="font-bold mb-1">Téléphone</h4>
                            <p class="text-gray-600 dark:text-gray-300">
                                +243 81 234 5678<br>
                                +243 89 876 5432
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="bg-primary-light dark:bg-primary-dark text-white p-3 rounded-full mr-4 flex-shrink-0">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4 class="font-bold mb-1">Email</h4>
                            <p class="text-gray-600 dark:text-gray-300">
                                contact@nsokopharma.cd<br>
                                support@nsokopharma.cd
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-md">
                <form id="contact-form">
                    <div class="mb-4">
                        <label for="name" class="block font-medium mb-2">Nom complet</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark bg-white dark:bg-gray-700" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark bg-white dark:bg-gray-700" required>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block font-medium mb-2">Téléphone</label>
                        <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark bg-white dark:bg-gray-700">
                    </div>

                    <div class="mb-4">
                        <label for="pharmacy" class="block font-medium mb-2">Nom de votre pharmacie</label>
                        <input type="text" id="pharmacy" name="pharmacy" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark bg-white dark:bg-gray-700">
                    </div>

                    <div class="mb-4">
                        <label for="message" class="block font-medium mb-2">Message</label>
                        <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark bg-white dark:bg-gray-700" required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-primary-light dark:bg-primary-dark hover:bg-primary-dark dark:hover:bg-primary-light text-white font-bold py-3 px-6 rounded-lg transition-colors shadow-lg hover:shadow-xl">
                        Envoyer le message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 dark:bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center mb-4">
                    <i class="fas fa-pills text-3xl text-primary-light dark:text-primary-dark mr-2"></i>
                    <span class="text-2xl font-bold">Nsoko<span class="text-primary-light dark:text-primary-dark">Pharma</span></span>
                </div>
                <p class="text-gray-400 mb-4">
                    La solution de gestion pharmaceutique conçue pour les professionnels de santé en RDC.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4">Liens rapides</h3>
                <ul class="space-y-2">
                    <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Fonctionnalités</a></li>
                    <li><a href="#benefits" class="text-gray-400 hover:text-white transition-colors">Avantages</a></li>
                    <li><a href="#signup" class="text-gray-400 hover:text-white transition-colors">Inscription</a></li>
                    <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4">Ressources</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Documentation</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Support</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-bold mb-4">Légal</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Conditions d'utilisation</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Politique de confidentialité</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Mentions légales</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
            <p>&copy; 2023 NsokoPharma. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Dark mode toggle
    const darkModeToggle = document.getElementById('dark-mode-toggle');

    darkModeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
    });

    // Check for saved dark mode preference
    if (localStorage.getItem('darkMode') === 'true') {
        document.documentElement.classList.add('dark');
    }

    // Form submission
    const contactForm = document.getElementById('contact-form');

    contactForm.addEventListener('submit', (e) => {
        e.preventDefault();

        // Get form values
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const pharmacy = document.getElementById('pharmacy').value;
        const message = document.getElementById('message').value;

        // Here you would typically send this data to your server
        console.log({ name, email, phone, pharmacy, message });

        // Show success message
        alert('Merci pour votre message ! Nous vous contacterons bientôt.');

        // Reset form
        contactForm.reset();
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });
</script>
</body>
</html>
