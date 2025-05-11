 <div>
    <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-white">Réinitialisation de mot de passe</h1>
    <p class="text-gray-600 dark:text-gray-300 mb-8">
        Saisissez votre adresse e-mail pour recevoir un lien de réinitialisation.
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="space-y-6">
        <!-- Email Field -->
        <div class="relative">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Adresse e-mail
            </label>
            <div class="relative rounded-lg shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400 dark:text-gray-300"></i>
                </div>
                <input
                    wire:model="email"
                    type="email"
                    id="email"
                    required
                    autofocus
                    autocomplete="email"
                    class="w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 bg-white dark:bg-gray-800 dark:text-white transition-all duration-200"
                    placeholder="votre@email.com"
                >
            </div>
            @error('email')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button
                type="submit"
                class="w-full auth-btn bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center shadow-md hover:shadow-lg"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Envoyer le lien de réinitialisation</span>
                <span wire:loading class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Envoi en cours...
                </span>
            </button>
        </div>
    </form>

    <!-- Login Link -->
    <div class="mt-8 text-center">
        <p class="text-gray-600 dark:text-gray-300">
            Vous vous souvenez de votre mot de passe ?
            <a href="{{ route('login') }}" wire:navigate class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                Connectez-vous ici
            </a>
        </p>
    </div>
</div>
