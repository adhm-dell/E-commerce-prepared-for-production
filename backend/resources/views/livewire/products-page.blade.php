<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="flex flex-wrap  mb-24 -mx-3">
                <div class="w-full sm:grid sm:grid-cols-2 sm:gap-2 pr-2 sm:px-2 lg:w-1/4 lg:block">
                    <div x-data="{ open: false }"
                        class="p-4 mb-5 sm:mb-2 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400 flex justify-between items-center cursor-pointer lg:cursor-default"
                            @click="open = !open">
                            Categories
                            <svg class="w-5 h-5 ml-2 lg:hidden transform transition-transform duration-300"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>

                        {{-- Dropdown only collapses on small and medium screens --}}
                        <ul x-show="open || window.innerWidth >= 1024" x-transition class="overflow-hidden lg:block">
                            @foreach ($categories as $category)
                                <li wire:key="{{ $category->id }}" class="mb-4">
                                    <label for="{{ $category->slug }}" class="flex items-center dark:text-gray-400 ">
                                        <input type="checkbox" wire:model.live="selected_categories"
                                            id="{{ $category->slug }}" value="{{ $category->id }}" class="w-4 h-4 mr-2">
                                        <span class="text-lg">{{ $category->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div x-data="{ open: false }"
                        class="p-4 mb-5 sm:mb-2 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400 flex justify-between items-center cursor-pointer lg:cursor-default"
                            @click="open = !open">
                            Brand
                            <svg class="w-5 h-5 ml-2 lg:hidden transform transition-transform duration-300"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </h2>

                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>

                        <ul x-show="open || window.innerWidth >= 1024" x-transition x-cloak
                            class="overflow-hidden lg:block">
                            @foreach ($brands as $brand)
                                <li wire:key="{{ $brand->id }}" class="mb-4">
                                    <label for="{{ $brand->slug }}" class="flex items-center dark:text-gray-300">
                                        <input wire:model.live="selected_brands" id="{{ $brand->slug }}"
                                            value="{{ $brand->id }}" type="checkbox" class="w-4 h-4 mr-2">
                                        <span class="text-lg dark:text-gray-400">{{ $brand->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                    <div x-data="{ open: false }"
                        class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400 flex justify-between items-center cursor-pointer lg:cursor-default"
                            @click="open = !open">
                            Product Status
                            <svg class="w-5 h-5 ml-2 lg:hidden transform transition-transform duration-300"
                                :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </h2>

                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>

                        <ul x-show="open || window.innerWidth >= 1024" x-transition x-cloak
                            class=" overflow-hidden lg:block">
                            <li class="mb-4">
                                <label class="flex items-center dark:text-gray-300">
                                    <input wire:model.live="in_stock" value="1" type="checkbox"
                                        class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-gray-400">In Stock</span>
                                </label>
                            </li>
                            <li class="mb-4">
                                <label class="flex items-center dark:text-gray-300">
                                    <input wire:model.live="on_sale" value="1" type="checkbox"
                                        class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-gray-400">On Sale</span>
                                </label>
                            </li>
                        </ul>
                    </div>


                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Price</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>

                        <div>
                            {{-- Display the current price (fallback to maxPrice or 0 to prevent null errors) --}}
                            <div class="dark:text-white font-semibold">
                                {{ Number::currency($price ?? ($this->maxPrice ?? 0), 'EGP') }}
                            </div>

                            {{-- Price range input --}}
                            <input type="range" min="{{ $this->minPrice }}" max="{{ $this->maxPrice }}"
                                step="100" wire:model.live="price"
                                class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer">

                            {{-- Show min and max labels --}}
                            <div class="flex justify-between">
                                <span class="inline-block text-lg font-bold text-blue-400">
                                    {{ Number::currency($this->minPrice ?? 0, 'EGP') }}
                                </span>
                                <span class="inline-block text-lg font-bold text-blue-400">
                                    {{ Number::currency($this->maxPrice ?? 0, 'EGP') }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="w-full px-3 lg:w-3/4">
                    <div class="px-3 mb-4">
                        <div class="items-center justify-between px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900">
                            <div class="flex items-center justify-between">
                                <select wire:model.live="sortBy"
                                    class="block w-40 text-base bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                                    <option value="latest">Sort by Latest</option>
                                    <option value="price">Sort by Price</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center ">
                        @foreach ($products as $product)
                            <div wire:key="{{ $product->id }}" class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3">
                                <div class="border border-gray-300 dark:border-gray-700">
                                    <div class="relative bg-gray-200">
                                        @if (!$product->in_stock)
                                            <div
                                                class="absolute top-1 left-1 bg-red-600 text-white text-lg font-bold px-2 py-1 rounded shadow-md z-10">
                                                Out of Stock
                                            </div>
                                        @endif
                                        <a wire:navigate href="/products/{{ $product->slug }}" class="">
                                            <img src="{{ url('storage', $product->image[0]) }}"
                                                alt="{{ $product->name }}" class="object-cover w-full h-56 mx-auto ">
                                        </a>
                                    </div>
                                    <div class="p-3 ">
                                        <div class="flex items-center justify-between gap-2 mb-2">
                                            <h3 class="text-xl font-medium dark:text-gray-400">
                                                {{ $product->name }}
                                            </h3>
                                        </div>
                                        <p class="text-lg ">
                                            <span
                                                class="@if ($product->discount) line-through mr-0.5 @endif text-green-600 dark:text-green-600">{{ Number::currency($product->price, 'EGP') }}</span>
                                            @if ($product->discount)
                                                <span
                                                    class="text-green-600 dark:text-green-600">{{ Number::currency($product->price - $product->discount, 'EGP') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                                        @if ($product->in_stock)
                                            <a wire:click.prevent='addToCart({{ $product->id }})' href="#"
                                                class="text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="w-4 h-4 bi bi-cart3"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                                    </path>
                                                </svg>
                                                <span wire:loading.remove
                                                    wire:target='addToCart({{ $product->id }})'>Add to Cart</span>
                                                <span wire:loading
                                                    wire:target='addToCart({{ $product->id }})'>Adding...</span>
                                            </a>
                                        @else
                                            <button disabled
                                                class="text-gray-400 flex items-center space-x-2 cursor-not-allowed dark:text-gray-500">

                                                <span>Unavailable</span>
                                            </button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <!-- pagination start -->
                    <div class="flex justify-end mt-6">
                        {{ $products->links() }}
                    </div>
                    <!-- pagination end -->
                </div>
            </div>
        </div>
    </section>

</div>
