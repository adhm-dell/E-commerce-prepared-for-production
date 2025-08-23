<div>
    <div
        class="w-full min-h-screen bg-gradient-to-r from-blue-200 to-cyan-200 py-6 sm:py-8 lg:py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Grid -->
            <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">

                <!-- Text Column -->
                <div class="text-center md:ltr:text-left md:rtl:text-right">
                    <h1
                        class="block text-2xl sm:text-3xl md:text-4xl lg:text-6xl font-bold text-gray-800 lg:leading-tight">
                        {{ __('home.start_your_journey') }} <span class="text-blue-600">{{ __('home.fr3on_gym') }}</span>
                    </h1>
                    <p class="mt-3 text-base sm:text-lg text-gray-800 max-w-2xl mx-auto md:mx-0 rtl:md:mx-auto">
                        {{ __('home.title_p') }}
                    </p>

                    <!-- Buttons -->
                    <div class="mt-7 flex flex-col gap-3 w-full sm:flex-row sm:justify-center md:justify-start ">
                        <a wire:navigate
                            class="w-full sm:w-auto py-2.5 sm:py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/products">
                            {{ __('home.shop_now') }}
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                        <a wire:navigate
                            class="w-full sm:w-auto py-2.5 sm:py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/contact">
                            {{ __('home.contact_experts') }}
                        </a>
                    </div>
                    <!-- End Buttons -->

                    <!-- Review -->
                    <div class="mt-6 lg:mt-10 grid grid-cols-2 gap-x-5 rtl:text-right">
                        <!-- review content stays the same -->
                    </div>
                    <!-- End Review -->
                </div>
                <!-- End Text Column -->

                <!-- Image Column -->
                <div class="relative lg:ml-auto rtl:lg:mr-auto sm:w-sm sm:mx-auto">
                    <img class="w-full rounded-md" src="{{ asset('images/supplement.png') }}"
                        alt="Protein supplement and dumbbells">

                    <div
                        class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0">
                    </div>
                </div>
                <!-- End Image Column -->

            </div>
            <!-- End Grid -->
        </div>
    </div>



    <section class="py-20 ">
        <div class="max-w-xl mx-auto">
            <div class="text-center ">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-4xl font-bold dark:text-gray-200"> {{ __('home.browse_Popular') }}<span
                            class="text-blue-500">
                            {{ __('home.brands') }}
                        </span> </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200">
                        </div>
                        <div class="flex-1 h-2 bg-blue-400">
                        </div>
                        <div class="flex-1 h-2 bg-blue-600">
                        </div>
                    </div>
                </div>
                <p class="mb-12 text-base text-center text-gray-500">
                    {{ __('home.browse_brands_subtitle') }}
                </p>
            </div>
        </div>
        <div class="justify-center max-w-6xl px-4 py-4 mx-auto lg:py-0">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 md:grid-cols-2">

                @foreach ($brands as $brand)
                    <div class="bg-white rounded-lg shadow-md dark:bg-gray-800" wire:key="{{ $brand->id }}">
                        <a href="/products?selected_brands[0]={{ $brand->id }}" class="">
                            <img src="{{ url('storage', $brand->image) }}" alt="{{ $brand->name }}"
                                class="object-cover w-full h-64 rounded-t-lg">
                        </a>
                        <div class="p-5 text-center">
                            <a href=""
                                class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-300">
                                {{ $brand->name }}
                            </a>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </section>

    <div class="bg-orange-200 py-20">
        <div class="max-w-xl mx-auto">
            <div class="text-center ">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-4xl font-bold dark:text-gray-500"> {{ __('home.browse_Popular') }}<span
                            class="text-blue-500">
                            {{ __('home.categories') }}
                        </span> </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200">
                        </div>
                        <div class="flex-1 h-2 bg-blue-400">
                        </div>
                        <div class="flex-1 h-2 bg-blue-600">
                        </div>
                    </div>
                </div>
                <p class="mb-12 text-base text-center text-gray-500">
                    {{ __('home.browse_categories_subtitle') }}
                </p>
            </div>
        </div>

        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">

                @foreach ($categories as $category)
                    <a wire:key="{{ $category->id }}"
                        class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        href="/products?selected_categories[0]={{ $category->id }}">
                        <div class="p-4 md:p-5">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                        src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}">
                                    <div class="ms-3">
                                        <h3
                                            class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                                            {{ $category->name }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="ps-3">
                                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach



            </div>
        </div>

    </div>

    <section class="py-20 ">
        <div class="max-w-xl mx-auto">
            <div class="text-center ">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-4xl font-bold dark:text-gray-200"> {{ __('home.browse') }}<span
                            class="text-blue-500">
                            {{ __('home.featured_products') }}
                        </span> </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200">
                        </div>
                        <div class="flex-1 h-2 bg-blue-400">
                        </div>
                        <div class="flex-1 h-2 bg-blue-600">
                        </div>
                    </div>
                </div>
                <p class="mb-12 text-base text-center text-gray-500">
                    {{ __('home.browse_products_subtitle') }}
                </p>
            </div>
        </div>
        <div class="justify-center max-w-6xl px-4 py-4 mx-auto lg:py-0">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 md:grid-cols-2">

                @foreach ($products as $product)
                    <div class="bg-white rounded-lg shadow-md dark:bg-gray-800" wire:key="{{ $product->id }}">
                        <a href="/products?selected_products[0]={{ $product->id }}" class="">
                            <img src="{{ url('storage', $product->image) }}" alt="{{ $product->name }}"
                                class="object-cover w-full h-64 rounded-t-lg">
                        </a>
                        <div class="p-5 text-center">
                            <a href=""
                                class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-300">
                                {{ $product->name }}
                            </a>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </section>
</div>
