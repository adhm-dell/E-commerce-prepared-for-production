<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 dark:text-gray-200">{{ __('contact.title') }}</h1>

    {{-- Contact Form --}}
    <form wire:submit.prevent="sendMessage" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 space-y-4">
        <input type="text" wire:model.defer="name" placeholder="{{ __('contact.form.name') }}" required
            class="w-full py-2 px-4 rounded border text-sm dark:bg-slate-900 dark:text-gray-300" />

        <input type="email" wire:model.defer="email" placeholder="{{ __('contact.form.email') }}" required
            class="w-full py-2 px-4 rounded border text-sm dark:bg-slate-900 dark:text-gray-300" />

        <textarea wire:model.defer="message" placeholder="{{ __('contact.form.message') }}" rows="5" required
            class="w-full py-2 px-4 rounded border text-sm dark:bg-slate-900 dark:text-gray-300"></textarea>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded text-sm font-semibold">
            <span wire:loading.remove>{{ __('contact.form.submit') }}</span>
            <span wire:loading>{{ __('contact.form.sending') }}</span>
        </button>

        @if ($successMessage)
            <p class="text-green-500 text-sm mt-2">{{ $successMessage }}</p>
        @endif
    </form>

    {{-- Google Map --}}
    <div class="mt-10">
        <h2 class="text-xl font-semibold mb-3 text-gray-800 dark:text-gray-200">{{ __('contact.location.title') }}</h2>
        <div class="w-full h-64 rounded-lg overflow-hidden shadow">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.219597446924!2d31.19525822499012!3d30.030557219229507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584718abf84945%3A0xa02696c587f61ddb!2sFR3ON%20GYM!5e0!3m2!1sar!2seg!4v1754056168144!5m2!1sar!2seg"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
