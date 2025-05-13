<div x-data="{ showPassword: false }" class="max-w-6xl mx-auto">
    <header class="mb-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $title }}</h1>
        <button wire:click="cancelEdit" class="inline-flex items-center text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100 transition-colors duration-200">
            <svg class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour
        </button>
    </header>

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-900/20 dark:border-green-500 dark:text-green-400 rounded-r-md shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-900/20 dark:border-red-500 dark:text-red-400 rounded-r-md shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md p-8 dark:bg-gray-800/90 dark:backdrop-blur-sm dark:border dark:border-gray-700 transition-all duration-200 hover:shadow-lg">
        <form wire:submit.prevent="saveUser" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                <!-- Nom -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 flex items-center">
                        Nom <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none z-10">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-500 transition-colors duration-200 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input wire:model="name" type="text" id="name" 
                            class="pl-11 w-full bg-gray-50 border-0 text-gray-900 rounded-lg py-3 ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 outline-none 
                            focus:ring-2 focus:ring-inset focus:ring-primary-500 
                            dark:bg-gray-800 dark:text-white dark:ring-gray-600 dark:placeholder-gray-500 
                            dark:focus:ring-primary-500 transition-all duration-200"
                            placeholder="Entrez le nom complet">
                    </div>
                    @error('name')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200 flex items-center">
                        Email <span class="text-red-500 ml-1">*</span>
                    </label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none z-10">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-500 transition-colors duration-200 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input wire:model="email" type="email" id="email" 
                            class="pl-11 w-full bg-gray-50 border-0 text-gray-900 rounded-lg py-3 ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 outline-none 
                            focus:ring-2 focus:ring-inset focus:ring-primary-500 
                            dark:bg-gray-800 dark:text-white dark:ring-gray-600 dark:placeholder-gray-500 
                            dark:focus:ring-primary-500 transition-all duration-200"
                            placeholder="exemple@email.com">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <!-- Mot de passe -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200 flex items-center">
                        Mot de passe
                        @if ($userId)
                            <span class="text-gray-500 text-xs ml-2 dark:text-gray-400">(Laisser vide pour conserver l'actuel)</span>
                        @else
                            <span class="text-red-500 ml-1">*</span>
                            <span class="text-gray-500 text-xs ml-2 dark:text-gray-400">(Par défaut: 12345678)</span>
                        @endif
                    </label>
                    <div class="group relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none z-10">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary-500 transition-colors duration-200 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input wire:model="password" :type="showPassword ? 'text' : 'password'" id="password" 
                            class="pl-11 pr-11 w-full bg-gray-50 border-0 text-gray-900 rounded-lg py-3 ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 outline-none 
                            focus:ring-2 focus:ring-inset focus:ring-primary-500 
                            dark:bg-gray-800 dark:text-white dark:ring-gray-600 dark:placeholder-gray-500 
                            dark:focus:ring-primary-500 transition-all duration-200"
                            placeholder="Entrez le mot de passe">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" @click="showPassword = !showPassword" 
                                class="text-gray-400 hover:text-primary-500 focus:outline-none focus:text-primary-500 transition-colors duration-200 
                                dark:text-gray-500 dark:hover:text-primary-400">
                                <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" />
                                </svg>
                                <svg x-show="showPassword" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
            <!-- Rôle (version radio button pour sélection unique) -->
            <div class="mt-8">
                <div class="flex items-center mb-4">
                    <span class="block text-sm font-medium text-gray-700 dark:text-gray-200 mr-2">Rôle</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-300">
                        Obligatoire <span class="text-red-500 ml-1">*</span>
                    </span>
                </div>
                <div class="bg-gray-50 p-6 rounded-xl shadow-inner dark:bg-gray-800/50">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($roles as $role)
                            <div class="relative flex items-start bg-white p-4 rounded-xl border border-gray-200 
                                hover:border-primary-300 hover:shadow-md transition-all duration-200 
                                dark:bg-gray-800 dark:border-gray-700 dark:hover:border-primary-500
                                @if($selectedRole == $role->id) ring-2 ring-primary-500 dark:ring-primary-400 @endif">
                                <div class="flex items-center h-5">
                                    <input wire:model="selectedRole" id="role-{{ $role->id }}" name="selectedRole" value="{{ $role->id }}" type="radio" 
                                        class="h-5 w-5 text-primary-600 border-gray-300 focus:ring-primary-500 
                                        dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-primary-500 
                                        transition-colors duration-200 cursor-pointer">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="role-{{ $role->id }}" class="font-medium text-gray-700 dark:text-gray-300 cursor-pointer select-none">
                                        {{ $role->name }}
                                    </label>
                                    @if(isset($role->description) && $role->description)
                                        <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">{{ $role->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @error('selectedRole')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400 flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="pt-5 flex justify-end space-x-4">
                <button wire:click.prevent="cancelEdit" type="button" 
                    class="inline-flex justify-center py-3 px-5 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 
                    bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 
                    dark:text-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:ring-offset-gray-800 
                    transition-colors duration-200 ease-in-out">
                    <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Annuler
                </button>
                <button type="submit" 
                    class="inline-flex justify-center py-3 px-5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white 
                    bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 
                    dark:focus:ring-offset-gray-800 transition-colors duration-200 ease-in-out">
                    <svg class="mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ $userId ? 'Mettre à jour' : 'Enregistrer' }}
                </button>
            </div>
        </form>
    </div>
</div>
