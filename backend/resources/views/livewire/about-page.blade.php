<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h1 class="text-5xl font-extrabold text-blue-600 drop-shadow-sm">
            {{ __('about.title') }} <span class="text-gray-900 dark:text-white">{{ __('about.brand') }}</span>
        </h1>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
            {{ __('about.subtitle') }}
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-12 items-start text-gray-700 dark:text-gray-300 text-lg leading-relaxed">
        <div class="space-y-6">
            <p>{{ __('about.description.p1') }}</p>
            <p>{{ __('about.description.p2') }}</p>
            <p>{{ __('about.description.p3') }}</p>
        </div>

        <div class="space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-blue-500 mb-2">{{ __('about.why_choose_us.title') }}</h2>
                <ul class="list-disc list-inside space-y-1 text-gray-600 dark:text-gray-400">
                    @foreach (__('about.why_choose_us.points') as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-blue-500 mb-2">{{ __('about.vision.title') }}</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ __('about.vision.text') }}</p>
            </div>
        </div>
    </div>

    <div class="mt-16 text-center">
        <a href="/contact"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300">
            {{ __('about.contact_btn') }}
        </a>
    </div>
</div>
