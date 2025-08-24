<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500 dark:text-slate-200">
        {{ __('orders.title') }}
    </h1>

    <div class="flex flex-col bg-white dark:bg-slate-900 p-5 rounded mt-4 shadow-lg">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle mb-2">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-slate-800">
                            <tr>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    {{ __('orders.order') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    {{ __('orders.date') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    {{ __('orders.order_status') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    {{ __('orders.payment_status') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    {{ __('orders.order_amount') }}
                                </th>
                                <th
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">
                                    {{ __('orders.action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($my_orders as $order)
                                @php
                                    $status = match ($order->status) {
                                        'new' => '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">' .
                                            __('orders.status_new') .
                                            '</span>',
                                        'processing'
                                            => '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">' .
                                            __('orders.status_processing') .
                                            '</span>',
                                        'delivered'
                                            => '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">' .
                                            __('orders.status_delivered') .
                                            '</span>',
                                        'cancelled' => '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">' .
                                            __('orders.status_cancelled') .
                                            '</span>',
                                        'shipped' => '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">' .
                                            __('orders.status_shipped') .
                                            '</span>',
                                        default => '',
                                    };

                                    $payment_status = match ($order->payment_status) {
                                        'paid' => '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">' .
                                            __('orders.payment_paid') .
                                            '</span>',
                                        'failed' => '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">' .
                                            __('orders.payment_failed') .
                                            '</span>',
                                        'pending'
                                            => '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">' .
                                            __('orders.payment_pending') .
                                            '</span>',
                                        default => '',
                                    };
                                @endphp

                                <tr wire:key='{{ $order->id }}'
                                    class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-100">
                                        {{ $order->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-100">
                                        {{ $order->created_at->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-100">
                                        {!! $status !!}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-100">
                                        {!! $payment_status !!}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-100">
                                        {{ Number::currency($order->grand_total, 'EGP') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a href="/my-orders/{{ $order->id }}"
                                            class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">
                                            {{ __('orders.view_details') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                {{ $my_orders->links() }}
            </div>
        </div>
    </div>
</div>
