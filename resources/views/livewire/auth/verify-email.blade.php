<div>
    <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-white">Vérification de l'adresse e-mail</h1>
    <p class="text-gray-600 dark:text-gray-300 mb-8">
        Veuillez vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300 rounded-lg border border-green-200 dark:border-green-800">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <span>Un nouveau lien de vérification a été envoyé à l'adresse e-mail que vous avez fournie lors de l'inscription.</span>
            </div>
        </div>
    @endif

    <div class="space-y-6">
        <!-- Resend Button -->
        <div class="pt-2">
            <button
                wire:click="sendVerification"
                class="w-full auth-btn bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center shadow-md hover:shadow-lg"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove wire:target="sendVerification">Renvoyer l'e-mail de vérification</span>
                <span wire:loading wire:target="sendVerification" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Envoi en cours...
                </span>
            </button>
        </div>

        <div class="text-center mt-4">
            <a 
                href="#" 
                wire:click="logout"
                class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors"
            >
                Se déconnecter
            </a>
        </div>
    </div>

    <!-- Helpful Information -->
    <div class="mt-8 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-200 dark:border-blue-800">
        <h3 class="font-medium text-blue-800 dark:text-blue-200 mb-2">
            <i class="fas fa-info-circle mr-2"></i> Information importante
        </h3>
        <p class="text-sm text-blue-700 dark:text-blue-300">
            Si vous n'avez pas reçu notre e-mail, veuillez vérifier votre dossier de spam ou de courrier indésirable. Si vous ne trouvez toujours pas l'e-mail, cliquez sur le bouton ci-dessus pour recevoir un nouveau lien.
        </p>
    </div>
</div>
