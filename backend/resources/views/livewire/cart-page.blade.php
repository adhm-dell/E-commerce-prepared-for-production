<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-4 dark:text-white">Shopping Cart</h1>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4">
                <div class="bg-white dark:bg-gray-800 overflow-x-auto rounded-lg shadow-md p-6 mb-4">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-left font-semibold dark:text-gray-200">Product</th>
                                <th class="text-left font-semibold dark:text-gray-200">Price</th>
                                <th class="text-left font-semibold dark:text-gray-200">Quantity</th>
                                <th class="text-left font-semibold dark:text-gray-200">Total</th>
                                <th class="text-left font-semibold dark:text-gray-200">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b dark:border-gray-700">
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img class="h-16 w-16 mr-4 rounded bg-gray-100 dark:bg-gray-700"
                                            src="https://via.placeholder.com/150" alt="Product image">
                                        <span class="font-semibold dark:text-white">Product name</span>
                                    </div>
                                </td>
                                <td class="py-4 dark:text-gray-200">$19.99</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <button
                                            class="border rounded-md py-2 px-4 mr-2 dark:border-gray-600 dark:text-white dark:bg-gray-700">-</button>
                                        <span class="text-center w-8 dark:text-white">1</span>
                                        <button
                                            class="border rounded-md py-2 px-4 ml-2 dark:border-gray-600 dark:text-white dark:bg-gray-700">+</button>
                                    </div>
                                </td>
                                <td class="py-4 dark:text-gray-200">$19.99</td>
                                <td><button
                                        class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-red-600 dark:hover:border-red-700">Remove</button>
                                </td>
                            </tr>
                            <!-- More product rows -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-lg font-semibold mb-4 dark:text-white">Summary</h2>
                    <div class="flex justify-between mb-2">
                        <span class="dark:text-gray-200">Subtotal</span>
                        <span class="dark:text-gray-200">$19.99</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="dark:text-gray-200">Taxes</span>
                        <span class="dark:text-gray-200">$1.99</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="dark:text-gray-200">Shipping</span>
                        <span class="dark:text-gray-200">$0.00</span>
                    </div>
                    <hr class="my-2 border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold dark:text-white">Total</span>
                        <span class="font-semibold dark:text-white">$21.98</span>
                    </div>
                    <button
                        class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full dark:bg-blue-600 dark:hover:bg-blue-700">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
