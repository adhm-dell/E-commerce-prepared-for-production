<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
        {{ __('checkout.title') }}
    </h1>
    <form wire:submit.prevent="placeOrder">
        <div class="grid grid-cols-12 gap-4">
            <div class="md:col-span-12 lg:col-span-8 col-span-12">
                <!-- Card -->
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <!-- Shipping Address -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                            {{ __('checkout.shipping.title') }}
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="first_name">
                                    {{ __('checkout.shipping.first_name') }}
                                </label>
                                <input wire:model="first_name"
                                    class="w-full rounded-lg border py-2 px-3
    dark:bg-gray-700 dark:text-white
    @error('first_name') border-red-500 dark:border-red-500 @else dark:border-none @enderror"
                                    id="first_name" type="text">
                                </input>
                                @error('first_name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="last_name">
                                    {{ __('checkout.shipping.last_name') }}
                                </label>
                                <input wire:model="last_name"
                                    class="w-full rounded-lg border py-2 px-3
    dark:bg-gray-700 dark:text-white
    @error('last_name') border-red-500 dark:border-red-500 @else dark:border-none @enderror"
                                    id="last_name" type="text">
                                </input>
                                @error('last_name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="phone">
                                {{ __('checkout.shipping.phone') }}
                            </label>
                            <input wire:model="phone"
                                class="w-full rounded-lg border py-2 px-3
    dark:bg-gray-700 dark:text-white
    @error('phone') border-red-500 dark:border-red-500 @else dark:border-none @enderror"
                                id="phone" type="text">
                            </input>
                            @error('phone')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="address">
                                {{ __('checkout.shipping.address') }}
                            </label>
                            <input wire:model="street_address"
                                class="w-full rounded-lg border py-2 px-3
    dark:bg-gray-700 dark:text-white
    @error('street_address') border-red-500 dark:border-red-500 @else dark:border-none @enderror"
                                id="address" type="text">
                            </input>
                            @error('street_address')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-white mb-1" for="city">
                                {{ __('checkout.shipping.city') }}
                            </label>
                            <input wire:model="city"
                                class="w-full rounded-lg border py-2 px-3
    dark:bg-gray-700 dark:text-white
    @error('city') border-red-500 dark:border-red-500 @else dark:border-none @enderror"
                                id="city" type="text">
                            </input>
                            @error('city')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="state">
                                    {{ __('checkout.shipping.state') }}
                                </label>
                                <input wire:model="state"
                                    class="w-full rounded-lg border py-2 px-3
    dark:bg-gray-700 dark:text-white
    @error('state') border-red-500 dark:border-red-500 @else dark:border-none @enderror"
                                    id="state" type="text">
                                </input>
                                @error('state')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-white mb-1" for="zip">
                                    {{ __('checkout.shipping.zip') }}
                                </label>
                                <input wire:model="zip_code"
                                    class="w-full rounded-lg border py-2 px-3
    dark:bg-gray-700 dark:text-white
    @error('zip_code') border-red-500 dark:border-red-500 @else dark:border-none @enderror"
                                    id="zip" type="text">
                                </input>
                                @error('zip_code')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-lg font-semibold mb-4 dark:text-white">
                        {{ __('checkout.payment.title') }}
                    </div>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        <li>
                            <input wire:model='payment_method' class="hidden peer" id="cod" required=""
                                type="radio" value="cod" />
                            <label
                                class="inline-flex items-center justify-between w-full p-5
    text-gray-500 bg-white border rounded-lg cursor-pointer
    peer-checked:border-blue-600 peer-checked:text-blue-600
    hover:text-gray-600 hover:bg-gray-100
    dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700
    @error('payment_method') border-red-500 dark:border-red-500
    @else border-gray-200 dark:border-gray-700
    @enderror"
                                for="cod">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        {{ __('checkout.payment.cod') }}
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                    </path>
                                </svg>
                            </label>
                        </li>
                        <li>
                            <input wire:model='payment_method' class="hidden peer" id="card" type="radio"
                                value="card">
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 @error('payment_method') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror"
                                for="card">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        {{ __('checkout.payment.card') }}
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                    </path>
                                </svg>
                            </label>
                            </input>
                        </li>
                        <li>
                            <input wire:model='payment_method' class="hidden peer" id="wallet" type="radio"
                                value="wallet">
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 @error('payment_method') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror"
                                for="wallet">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        {{ __('checkout.payment.wallet') }}
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2">
                                    </path>
                                </svg>
                            </label>
                            </input>
                        </li>
                        @error('payment_method')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </ul>
                </div>
                <!-- End Card -->
            </div>
            <div class="md:col-span-12 lg:col-span-4 col-span-12">
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900 dark:text-white">
                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                        {{ __('checkout.summary.title') }}
                    </div>
                    <div class="flex justify-between mb-2 font-bold ">
                        <span>
                            {{ __('checkout.summary.subtotal') }}
                        </span>
                        <span>
                            {{ Number::currency($grand_total, 'EGP') }} </span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            {{ __('checkout.summary.taxes') }}
                        </span>
                        <span>
                            {{ Number::currency($taxes ?? 0, 'EGP') }} </span>
                        </span>
                    </div>
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            {{ __('checkout.summary.shipping') }}
                        </span>
                        <span>
                            {{ Number::currency($shipping_cost ?? 0, 'EGP') }} </span>
                        </span>
                    </div>
                    <hr class="bg-slate-400 my-4 h-1 rounded">
                    <div class="flex justify-between mb-2 font-bold">
                        <span>
                            {{ __('checkout.summary.grand_total') }}
                        </span>
                        <span>
                            {{ Number::currency($grand_total ?? (0 + $shipping_cost ?? (0 + $taxes ?? 0)), 'EGP') }}
                        </span>
                        </span>
                    </div>
                    </hr>
                </div>
                <!-- Coupon Code Section -->
                <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900 dark:text-white">
                    <div class="text-lg font-bold text-gray-700 dark:text-white mb-2">
                        {{ __('checkout.coupon.title') }}
                    </div>
                    <div class="flex gap-2">
                        <input type="text" wire:model.defer="coupon_code"
                            class="flex-1 rounded-lg border px-3 py-2 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            placeholder="{{ __('checkout.coupon.placeholder') }}">
                        <button type="button" wire:click="applyCoupon"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            {{ __('checkout.coupon.apply') }}
                        </button>
                    </div>
                    @if ($coupon_applied)
                        <div class="mt-2 text-green-500 font-semibold">
                            {{ __('checkout.coupon.applied') }} {{ $coupon_discount }}%.
                        </div>
                    @elseif($invalid_coupon)
                        <div class="mt-2 text-red-500 font-semibold">
                            {{ __('checkout.coupon.invalid') }}
                        </div>
                    @endif
                </div>

                <button type="submit"
                    class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                    <span wire:loading.remove>{{ __('checkout.place_order') }}</span>
                    <span wire:loading>{{ __('checkout.processing') }}</span>
                </button>
                @error('stock_error')
                    <div class="mt-2 text-red-600 text-sm font-medium">
                        {{ $message }}
                    </div>
                @enderror
                <div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
                        {{ __('checkout.basket.title') }}
                    </div>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
                        @foreach ($cart_items as $item)
                            <li class="py-3 sm:py-4" wire:key='{{ $item['product_id'] }}'>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="{{ $item['name'] }}" class="w-12 h-12 rounded-full"
                                            src="{{ url('storage', $item['image']) }}">
                                        </img>
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $item['name'] }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            {{ __('checkout.basket.quantity') }}: {{ $item['quantity'] }}
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ Number::currency($item['total_amount'], 'EGP') }}
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
