<div>
    <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-white">Création d'un établissement</h1>
    <p class="text-gray-600 dark:text-gray-300 mb-8">
        Saisissez les informations de votre pharmacie pour créer un compte
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="create" class="space-y-6">
        <!-- Name Field -->
        <div class="relative">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Nom de l'Etablissement
            </label>
            <div class="relative rounded-lg shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-clinic-medical text-gray-400 dark:text-gray-300"></i>
                </div>
                <input
                    wire:model="name"
                    type="text"
                    id="name"
                    required
                    autofocus
                    autocomplete="name"
                    class="w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 bg-white dark:bg-gray-800 dark:text-white transition-all duration-200"
                    placeholder="Pharmacie la Bonne Santé"
                >
            </div>
            @error('name')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone Field -->
        <div class="relative">
            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                N° Téléphone
            </label>
            <div class="relative rounded-lg shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-phone text-gray-400 dark:text-gray-300"></i>
                </div>
                <input
                    wire:model="phone"
                    type="tel"
                    id="phone"
                    required
                    autocomplete="phone"
                    class="w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 bg-white dark:bg-gray-800 dark:text-white transition-all duration-200"
                    placeholder="+243 992522582"
                >
            </div>
            @error('phone')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Address Field -->
        <div class="relative">
            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Adresse de L'Etablissement
            </label>
            <div class="relative rounded-lg shadow-sm">
                <div class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none">
                    <i class="fas fa-map-marker-alt text-gray-400 dark:text-gray-300"></i>
                </div>
                <textarea
                    wire:model="address"
                    id="address"
                    rows="2"
                    required
                    autocomplete="address"
                    class="w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 bg-white dark:bg-gray-800 dark:text-white transition-all duration-200"
                    placeholder="N° 115,Av:Kasongo, Q:Latin, C:Manika, Kolwezi"
                ></textarea>
            </div>
            @error('address')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Math Question (Anti-robot) -->
        <div class="relative bg-blue-50 dark:bg-blue-900/30 p-4 rounded-lg">
            <label for="userAnswer" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                <i class="fas fa-shield-alt mr-2"></i> Vérification de sécurité
            </label>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                Veuillez résoudre cette opération simple : {{ $firstNumber }} {{ $operation }} {{ $secondNumber }} = ?
            </p>
            <div class="relative rounded-lg shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-calculator text-gray-400 dark:text-gray-300"></i>
                </div>
                <input
                    wire:model="userAnswer"
                    type="text"
                    id="userAnswer"
                    required
                    class="w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 bg-white dark:bg-gray-800 dark:text-white transition-all duration-200"
                    placeholder="Votre réponse"
                >
            </div>
            @error('userAnswer')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Hidden reCAPTCHA token field -->
        <input type="hidden" wire:model="recaptchaToken" id="recaptchaToken">
        @error('recaptchaToken')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
        
        <!-- Error for bot protection timing -->
        @error('bot_protection')
        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror

        <!-- Submit Button -->
        <div class="pt-2">
            <button
                type="submit"
                class="w-full auth-btn bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center shadow-md hover:shadow-lg"
                wire:loading.attr="disabled"
                id="submitBtn"
            >
                <span wire:loading.remove>Créer votre Compte</span>
                <span wire:loading class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Création en cours...
                </span>
            </button>
        </div>
    </form>

    <!-- Login Link -->
    <div class="mt-8 text-center">
        <p class="text-gray-600 dark:text-gray-300">
            Avez-vous déjà créé l'Etablissement?
            <a href="{{ route('identification') }}" wire:navigate class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                Démarrer la session
            </a>
        </p>
    </div>
    
    <!-- reCAPTCHA v3 Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Charger le script Google reCAPTCHA v3
            var script = document.createElement('script');
            script.src = 'https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}';
            document.head.appendChild(script);
            
            script.onload = function() {
                // Fonction pour récupérer et mettre à jour le token reCAPTCHA
                function updateRecaptchaToken() {
                    grecaptcha.ready(function() {
                        grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'tenant_register'})
                            .then(function(token) {
                                document.getElementById('recaptchaToken').value = token;
                                // Mettre à jour le modèle Livewire
                                @this.set('recaptchaToken', token);
                            });
                    });
                }
                
                // Mettre à jour le token initialement et toutes les 90 secondes (les tokens expirent après 2 minutes)
                updateRecaptchaToken();
                setInterval(updateRecaptchaToken, 90000);
                
                // Mettre à jour le token lors de la soumission du formulaire pour garantir qu'il est frais
                document.getElementById('submitBtn').addEventListener('click', function(e) {
                    updateRecaptchaToken();
                });
            };
        });
    </script>
</div>
