<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4 dark:text-white">{{ __('cart.title') }}</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4">
                <div class="bg-white dark:bg-gray-800 overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="ltr:text-left rtl:text-right font-semibold dark:text-gray-200">
                                    {{ __('cart.table.product') }}
                                </th>
                                <th class="ltr:text-left rtl:text-right font-semibold dark:text-gray-200">
                                    {{ __('cart.table.price') }}</th>
                                <th class="ltr:text-left rtl:text-right font-semibold dark:text-gray-200">
                                    {{ __('cart.table.quantity') }}
                                </th>
                                <th class="ltr:text-left rtl:text-right font-semibold dark:text-gray-200">
                                    {{ __('cart.table.total') }}</th>
                                <th class="ltr:text-left rtl:text-right font-semibold dark:text-gray-200">
                                    {{ __('cart.table.remove') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cartItems as $item)
                                <tr wire:key='{{ $item['product_id'] }}' class="border-b dark:border-gray-700">
                                    <td class="py-4 px-1">
                                        <div class="flex items-center">
                                            <img class="h-16 w-16 ltr:mr-4 rtl:ml-4 rounded bg-gray-100 dark:bg-gray-700"
                                                src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">
                                            <span
                                                class="font-semibold dark:text-white ltr:mr-0.5 rtl:ml-0.5">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-1 dark:text-gray-200">
                                        {{ Number::currency($item['unit_amount'], 'EGP') }}</td>
                                    <td class="py-4 px-1">
                                        <div class="flex items-center">
                                            <button
                                                class="border rounded-md py-2 px-4 mr-2 dark:border-gray-600 dark:text-white dark:bg-gray-700 hover:bg-gray-200 hover:text-blue-600 dark:hover:bg-gray-600 dark:hover:text-blue-400 transition-colors duration-150 cursor-pointer"
                                                wire:click='decrementQuantity({{ $item['product_id'] }})'>-</button>
                                            <span
                                                class="text-center w-8 dark:text-white">{{ $item['quantity'] }}</span>
                                            <button
                                                class="border rounded-md py-2 px-4 ml-2 dark:border-gray-600 dark:text-white dark:bg-gray-700 hover:bg-gray-200 hover:text-blue-600 dark:hover:bg-gray-600 dark:hover:text-blue-400 transition-colors duration-150 cursor-pointer"
                                                wire:click='incrementQuantity({{ $item['product_id'] }})'>+</button>
                                        </div>
                                    </td>
                                    <td class="py-4 px-1 dark:text-gray-200">
                                        {{ Number::currency($item['total_amount'], 'EGP') }}</td>
                                    <td class="px-1">
                                        <button wire:click="removeItem({{ $item['product_id'] }})"
                                            class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-red-600 dark:hover:border-red-700 transition-colors duration-150 cursor-pointer">
                                            <span wire:loading.remove
                                                wire:target="removeItem({{ $item['product_id'] }})">{{ __('cart.table.remove') }}</span>
                                            <span wire:loading
                                                wire:target="removeItem({{ $item['product_id'] }})">{{ __('cart.table.removing') }}</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="text-center text-4xl font-semibold py-4 text-slate-500 dark:text-gray-200">
                                        {{ __('cart.table.empty') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4 dark:text-white">{{ __('cart.summary.title') }}</h2>
                    <div class="flex justify-between mb-2">
                        <span class="dark:text-gray-200">{{ __('cart.summary.subtotal') }}</span>
                        <span class="dark:text-gray-200">{{ Number::currency($grand_total, 'EGP') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="dark:text-gray-200">{{ __('cart.summary.taxes') }}</span>
                        <span class="dark:text-gray-200">{{ Number::currency(0, 'EGP') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="dark:text-gray-200">{{ __('cart.summary.shipping') }}</span>
                        <span class="dark:text-gray-200">{{ Number::currency(0, 'EGP') }}</span>
                    </div>
                    <hr class="my-2 border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold dark:text-white">{{ __('cart.summary.grand_total') }}</span>
                        <span class="font-semibold dark:text-white">{{ Number::currency($grand_total, 'EGP') }}</span>
                    </div>
                    @if ($cartItems)
                        <a href="{{ route('checkout') }}" wire:navigate
                            class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full text-center block dark:bg-blue-600 dark:hover:bg-blue-700">
                            {{ __('cart.summary.checkout') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
