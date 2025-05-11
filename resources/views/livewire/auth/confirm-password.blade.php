<div>
    <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-white">Confirmation de sécurité</h1>
    <p class="text-gray-600 dark:text-gray-300 mb-8">
        Il s'agit d'une zone sécurisée de l'application. Veuillez confirmer votre mot de passe avant de continuer.
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="confirmPassword" class="space-y-6">
        <!-- Password Field -->
        <div class="relative">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Mot de passe
            </label>
            <div class="relative rounded-lg shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400 dark:text-gray-300"></i>
                </div>
                <input
                    wire:model="password"
                    type="password"
                    id="password"
                    required
                    autocomplete="current-password"
                    class="w-full pl-10 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 bg-white dark:bg-gray-800 dark:text-white transition-all duration-200"
                    placeholder="•••••••••"
                >
                <div x-data="{ show: false }" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <button @click="show = !show; $refs.passwordInput.type = show ? 'text' : 'password'" type="button" class="text-gray-400 hover:text-gray-600 dark:text-gray-300 dark:hover:text-gray-100 focus:outline-none">
                        <i x-show="!show" class="fas fa-eye"></i>
                        <i x-show="show" class="fas fa-eye-slash"></i>
                    </button>
                    <input
                        x-ref="passwordInput"
                        :type="show ? 'text' : 'password'"
                        x-bind:id="'password-' + $id"
                        x-bind:name="'password-' + $id"
                        class="sr-only"
                    >
                </div>
            </div>
            @error('password')
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
                <span wire:loading.remove>Confirmer</span>
                <span wire:loading class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Confirmation en cours...
                </span>
            </button>
        </div>
    </form>

    <!-- Back Link -->
    <div class="mt-8 text-center">
        <p class="text-gray-600 dark:text-gray-300">
            <a href="javascript:history.back()" class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                Retourner en arrière
            </a>
        </p>
    </div>
</div>
