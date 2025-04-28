@props(['type' => 'success'])

<div 
    x-data="{ 
        show: false, 
        message: '', 
        type: 'success',
        styles: {
            success: {
                light: {
                    background: 'bg-green-100',
                    text: 'text-green-800',
                    border: 'border-green-500',
                    icon: 'text-green-500'
                },
                dark: {
                    background: 'dark:bg-green-800',
                    text: 'dark:text-green-100',
                    border: 'dark:border-green-500',
                    icon: 'dark:text-green-400'
                }
            },
            error: {
                light: {
                    background: 'bg-red-100',
                    text: 'text-red-800',
                    border: 'border-red-500',
                    icon: 'text-red-500'
                },
                dark: {
                    background: 'dark:bg-red-800',
                    text: 'dark:text-red-100',
                    border: 'dark:border-red-500',
                    icon: 'dark:text-red-400'
                }
            },
            warning: {
                light: {
                    background: 'bg-yellow-100',
                    text: 'text-yellow-800',
                    border: 'border-yellow-500',
                    icon: 'text-yellow-500'
                },
                dark: {
                    background: 'dark:bg-yellow-800',
                    text: 'dark:text-yellow-100',
                    border: 'dark:border-yellow-500',
                    icon: 'dark:text-yellow-400'
                }
            },
            info: {
                light: {
                    background: 'bg-blue-100',
                    text: 'text-blue-800',
                    border: 'border-blue-500',
                    icon: 'text-blue-500'
                },
                dark: {
                    background: 'dark:bg-blue-800',
                    text: 'dark:text-blue-100',
                    border: 'dark:border-blue-500',
                    icon: 'dark:text-blue-400'
                }
            }
        },
        icons: {
            success: 'fa-check-circle',
            error: 'fa-times-circle',
            warning: 'fa-exclamation-circle',
            info: 'fa-info-circle'
        }
    }"
    x-show="show"
    @notify.window="
        show = true;
        message = $event.detail[0].message;
        type = $event.detail[0].type || 'success';
        setTimeout(() => { show = false }, $event.detail[0].duration || 3000)
    "
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed bottom-4 right-4 z-[9999] flex items-center p-4 rounded-lg shadow-lg max-w-sm border-l-4"
    :class="[
        styles[type].light.background,
        styles[type].dark.background,
        styles[type].light.border,
        styles[type].dark.border
    ]"
    role="alert"
    style="display: none;"
>
    <div class="flex items-center gap-3 w-full">
        <div class="flex-shrink-0">
            <i class="fas text-xl" 
               :class="[
                   icons[type],
                   styles[type].light.icon,
                   styles[type].dark.icon
               ]"
            ></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-medium" 
               :class="[
                   styles[type].light.text,
                   styles[type].dark.text
               ]" 
               x-text="message"
            ></p>
        </div>
        <div class="flex-shrink-0">
            <button 
                type="button" 
                class="inline-flex rounded-lg p-1.5 transition-all duration-200 focus:outline-none hover:bg-gray-100 dark:hover:bg-gray-700"
                :class="[
                    styles[type].light.text,
                    styles[type].dark.text
                ]"
                x-on:click="show = false"
            >
                <span class="sr-only">Fermer</span>
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
    </div>
</div>
