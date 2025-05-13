<!-- Conteneur principal -->
<div class="w-full max-w-6xl mx-auto">
    <!-- En-tête avec titre et description -->
    <div class="bg-white dark:bg-gray-800/90 rounded-xl shadow-md p-6 mb-6 hover:shadow-lg transition-all duration-300 border border-gray-100 dark:border-gray-700">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-6 h-6 mr-2 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    {{ $editMode ? 'Modifier le rôle' : 'Créer un nouveau rôle' }}
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ $editMode ? 'Modifiez les informations du rôle et sélectionnez les permissions associées.' : 'Créez un nouveau rôle et attribuez-lui des permissions spécifiques.' }}
                </p>
            </div>
            <div class="flex space-x-3">
                <button 
                    wire:click="cancelEdit"
                    type="button"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-200 ring-1 ring-gray-300 dark:ring-gray-600 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour à la liste
                </button>
            </div>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="bg-white dark:bg-gray-800/90 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
        <div class="p-5 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/60 rounded-t-xl">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white flex items-center">
                <svg class="w-5 h-5 mr-2 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                {{ $editMode ? 'Informations du rôle' : 'Détails du nouveau rôle' }}
            </h3>
        </div>
        
        <div class="p-6">
            <form wire:submit.prevent="saveRole" class="space-y-6">
                <!-- Champ: Nom du rôle -->
                <div>
                    <label for="roleName" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center">
                        Nom du rôle <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none z-10">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-500 transition-colors duration-200 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input 
                            wire:model="roleName" 
                            type="text" 
                            id="roleName" 
                            class="pl-11 w-full bg-gray-50 border-0 text-gray-900 rounded-lg py-3 ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 outline-none 
                            focus:ring-2 focus:ring-inset focus:ring-primary-500 
                            dark:bg-gray-800 dark:text-white dark:ring-gray-600 dark:placeholder-gray-500 
                            dark:focus:ring-primary-500 transition-all duration-200" 
                            placeholder="Ex: Administrateur, Gestionnaire, etc.">
                    </div>
                    @error('roleName') 
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Section des permissions -->
                <div class="pt-4">
                    <div class="flex items-center justify-between mb-4">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2m2-5h.01M9 9a2 2 0 012-2h2a2 2 0 012 2v3"></path>
                            </svg>
                            Permissions associées
                        </label>
                        @if(count($permissionsByGroup) > 0)
                            <div class="flex space-x-2">
                                <button 
                                    type="button" 
                                    wire:click="selectAllPermissions"
                                    class="text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 focus:outline-none transition-colors duration-150">
                                    Tout sélectionner
                                </button>
                                <span class="text-gray-300 dark:text-gray-600">|</span>
                                <button 
                                    type="button" 
                                    wire:click="confirmDeselectAllPermissions"
                                    class="text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 focus:outline-none transition-colors duration-150">
                                    Tout désélectionner
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Groupes de permissions -->
                    <div class="space-y-5">
                        @forelse($permissionsByGroup as $group => $groupPermissions)
                            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-5 shadow-inner">
                                <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200 capitalize mb-4 flex items-center">
                                    <span class="w-2 h-2 bg-primary-500 rounded-full mr-2"></span>
                                    {{ $group }}
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($groupPermissions as $permission)
                                        <label class="group flex items-center space-x-3 p-2 rounded-lg hover:bg-white dark:hover:bg-gray-700 transition-colors duration-150">
                                            <div class="relative flex items-center">
                                                <input 
                                                    wire:model="selectedPermissions" 
                                                    type="checkbox" 
                                                    value="{{ $permission->id }}" 
                                                    id="permission-{{ $permission->id }}"
                                                    class="w-5 h-5 rounded text-primary-600 bg-gray-100 
                                                    border-gray-300 focus:ring-primary-500 focus:ring-offset-0
                                                    dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-400 
                                                    transition-colors duration-150 cursor-pointer">
                                            </div>
                                            <span class="text-sm text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white transition-colors duration-150">{{ $permission->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 bg-gray-50 dark:bg-gray-800/30 rounded-xl">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Aucune permission trouvée.</p>
                            </div>
                        @endforelse
                    </div>

                    @error('selectedPermissions') 
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-4 pt-4">
                    <button 
                        type="button" 
                        wire:click="cancelEdit"
                        class="inline-flex justify-center py-3 px-5 ring-1 ring-gray-300 dark:ring-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                        <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Annuler
                    </button>
                    <button 
                        type="submit"
                        class="inline-flex justify-center items-center py-3 px-5 ring-1 ring-primary-600 dark:ring-primary-700 rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                        <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ $editMode ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Modale de confirmation pour désélectionner toutes les permissions -->
    <div
        x-data="{ open: @entangle('showConfirmDeselectModal').live }"
        x-show="open"
        x-cloak
        @keydown.escape.window="open = false"
        x-on:open-modal.window="$event.detail.name === 'confirm-deselect' ? open = true : null"
        x-on:close-modal.window="$event.detail.name === 'confirm-deselect' ? open = false : null"
        class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
    >
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-75 transition-opacity"
                aria-hidden="true"
            ></div>
            
            <!-- Centrage de la modale -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <!-- Contenu de la modale -->
            <div
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md w-full sm:p-6"
                @click.away="open = false"
            >
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 dark:bg-yellow-900">
                        <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                            Désélectionner toutes les permissions
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Êtes-vous sûr de vouloir désélectionner toutes les permissions ? Cette action supprimera toutes les permissions actuellement sélectionnées pour ce rôle.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                    <button type="button" wire:click="deselectAllPermissions" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:col-start-2 sm:text-sm">
                        Confirmer
                    </button>
                    <button type="button" wire:click="cancelDeselectAllPermissions" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 text-base font-medium text-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 dark:focus:ring-offset-gray-800 sm:mt-0 sm:col-start-1 sm:text-sm">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
