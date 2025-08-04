<footer class="bg-gray-900 w-full">
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 lg:pt-20 mx-auto">
        <!-- Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            <div class="flex flex-col  col-span-full lg:col-span-1 text-center lg:text-left">
                <!-- Brand name -->

                <a class="flex-none text-2xl font-bold text-white dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="/" aria-label="Brand">
                    FR3ON GYM
                </a>


                <!-- Logo under brand name -->
                <div class="mt-2">
                    <img src="{{ asset('images/logo.png') }}" alt="FR3ON GYM Logo" class="mx-auto lg:mx-0 w-28 h-auto">
                </div>
            </div>

            <!-- End Col -->

            <div class="col-span-1">
                <h4 class="font-semibold text-gray-100">Product</h4>

                <div class="mt-3 grid space-y-3">
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/categories">Categories</a></p>
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/products">All Products</a></p>
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/products?on_sale=true">On Sale Products</a></p>
                </div>
            </div>
            <!-- End Col -->

            <div class="col-span-1">
                <h4 class="font-semibold text-gray-100">Company</h4>

                <div class="mt-3 grid space-y-3">
                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/about">About us</a></p>
                    {{-- <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="#">Blog</a></p>

                    <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="#">Customers</a></p> --}}
                </div>
            </div>
            <!-- End Col -->

            <div class="col-span-2">
                <h4 class="font-semibold text-gray-100">Contact Us</h4>

                <form wire:submit.prevent="sendMessage">
                    <div class="mt-4 flex flex-col gap-3  rounded-lg p-4 bg-gray-800">
                        <input type="text" wire:model.defer="name" placeholder="Your Name" required
                            class="py-3 px-4 block w-full rounded-lg text-sm bg-slate-900 text-gray-400" />

                        <input type="email" wire:model.defer="email" placeholder="Your Email" required
                            class="py-3 px-4 block w-full rounded-lg text-sm bg-slate-900 text-gray-400" />

                        <textarea wire:model.defer="message" rows="3" placeholder="Your Message" required
                            class="py-3 px-4 block w-full rounded-lg text-sm bg-slate-900 text-gray-400"></textarea>

                        <button type="submit"
                            class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-sm font-semibold">
                            <span wire:loading.remove>Send Message</span>
                            <span wire:loading>Sending...</span>
                        </button>

                        @if ($successMessage)
                            <p class="text-green-500 text-sm mt-2">{{ $successMessage }}</p>
                        @endif
                    </div>
                </form>

            </div>
            <!-- End Col -->
        </div>
        <!-- End Grid -->

        <div class="mt-5 sm:mt-12 grid gap-y-2 sm:gap-y-0 sm:flex sm:justify-between sm:items-center">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-400">© 2025 FR3ON GYM. All rights reserved.</p>
            </div>
            <!-- End Col -->

            <!-- Social Brands -->
            <div>
                <a class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
                    href="https://www.facebook.com/share/19pRYwXkUm/">
                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                    </svg>
                </a>

                <a class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
                    href="https://www.instagram.com/fr3on_gym?igsh=cnR2d2QyMDMxa3cx" target="_blank"
                    rel="noopener noreferrer" aria-label="Instagram">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M7.75 2C5.12665 2 3 4.12665 3 6.75V17.25C3 19.8734 5.12665 22 7.75 22H16.25C18.8734 22 21 19.8734 21 17.25V6.75C21 4.12665 18.8734 2 16.25 2H7.75ZM12 7.25C14.6234 7.25 16.75 9.37665 16.75 12C16.75 14.6234 14.6234 16.75 12 16.75C9.37665 16.75 7.25 14.6234 7.25 12C7.25 9.37665 9.37665 7.25 12 7.25ZM17.25 6.5C17.25 7.19036 16.6904 7.75 16 7.75C15.3096 7.75 14.75 7.19036 14.75 6.5C14.75 5.80964 15.3096 5.25 16 5.25C16.6904 5.25 17.25 5.80964 17.25 6.5Z" />
                    </svg>
                </a>

                <a class="w-10 h-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-1 focus:ring-gray-600"
                    href="https://wa.me/201018993993" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true">
                        <path
                            d="M16.003 3.001c-7.168 0-12.998 5.83-12.998 12.998a12.91 12.91 0 0 0 1.757 6.511l-1.159 4.229 4.331-1.137a12.939 12.939 0 0 0 6.069 1.515h.002c7.168 0 12.998-5.83 12.998-12.998s-5.83-12.998-12.998-12.998zm0 23.584a10.61 10.61 0 0 1-5.429-1.506l-.389-.231-3.162.83.847-3.084-.245-.399a10.585 10.585 0 1 1 8.378 4.39zm5.83-7.958c-.319-.159-1.889-.93-2.183-1.035s-.506-.159-.719.159c-.212.319-.824 1.035-1.01 1.248-.186.212-.372.239-.691.08-.319-.159-1.35-.497-2.575-1.587-.952-.848-1.595-1.892-1.782-2.211-.186-.319-.02-.491.139-.65.143-.143.319-.372.478-.558.159-.186.212-.319.319-.531.106-.212.053-.399-.026-.558s-.719-1.733-.983-2.38c-.259-.62-.523-.537-.719-.547-.186-.009-.399-.009-.612-.009s-.558.08-.85.372c-.292.292-1.118 1.092-1.118 2.662s1.145 3.09 1.304 3.305c.159.212 2.252 3.437 5.454 4.818.763.329 1.359.526 1.823.672.766.243 1.464.209 2.016.127.615-.092 1.889-.772 2.155-1.518.265-.745.265-1.383.186-1.518-.079-.135-.292-.212-.611-.372z" />
                    </svg>
                </a>



            </div>
            <!-- End Social Brands -->
        </div>
    </div>
</footer>
