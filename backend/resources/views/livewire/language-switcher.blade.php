<div class="hs-dropdown relative md:[--strategy:fixed] md:py-4">
    <button type="button"
        class="flex items-center w-full text-gray-500 hover:text-gray-400 font-medium
               dark:text-gray-400 dark:hover:text-gray-500 bg-white dark:bg-gray-800
               border border-gray-200 dark:border-gray-700 px-3 py-2 rounded-xl shadow-sm">
        <img src="{{ asset('images/flags/' . app()->getLocale() . '.webp') }}" class="w-5 h-5 ltr:mr-2 rtl:ml-2"
            alt="flag">
        <span class="uppercase rtl:mr-1">{{ app()->getLocale() }}</span>
        <svg class="ms-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m6 9 6 6 6-6" />
        </svg>
    </button>

    <div
        class="hs-dropdown-menu absolute top-full right-0 z-10 transition-[opacity,margin] duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 md:w-36 hidden bg-white shadow-md rounded-lg p-2 dark:bg-gray-800 border dark:border-gray-700 dark:divide-gray-700">

        <button wire:click="switch('en')"
            class="flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800
                   hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
            <img src="{{ asset('images/flags/en.webp') }}" class="w-5 h-5" alt="English">
            English
        </button>

        <button wire:click="switch('ar')"
            class="flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800
                   hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300">
            <img src="{{ asset('images/flags/ar.webp') }}" class="w-5 h-5" alt="العربية">
            العربية
        </button>
    </div>
</div>
