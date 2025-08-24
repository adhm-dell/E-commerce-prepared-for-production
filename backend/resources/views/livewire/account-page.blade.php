<div class="max-w-xl my-3 mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">
        {{ __('account.title') }}
    </h2>

    @if (session()->has('success'))
        <div class="mb-4 text-green-600 dark:text-green-400 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="space-y-6">
        <div>
            <label class="block mb-1 text-gray-700 dark:text-gray-300" for="name">
                {{ __('account.name') }}
            </label>
            <input wire:model.defer="name" id="name" type="text"
                class="w-full px-4 py-2 border rounded-md dark:bg-gray-900 dark:text-white @error('name') border-red-500 @enderror">
            @error('name')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block mb-1 text-gray-700 dark:text-gray-300" for="email">
                {{ __('account.email') }}
            </label>
            <input wire:model.defer="email" id="email" type="email"
                class="w-full px-4 py-2 border rounded-md dark:bg-gray-900 dark:text-white @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block mb-1 text-gray-700 dark:text-gray-300" for="password">
                {{ __('account.new_password') }}
            </label>
            <input wire:model.defer="password" id="password" type="password"
                class="w-full px-4 py-2 border rounded-md dark:bg-gray-900 dark:text-white @error('password') border-red-500 @enderror">
            @error('password')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block mb-1 text-gray-700 dark:text-gray-300" for="password_confirmation">
                {{ __('account.confirm_password') }}
            </label>
            <input wire:model.defer="password_confirmation" id="password_confirmation" type="password"
                class="w-full px-4 py-2 border rounded-md dark:bg-gray-900 dark:text-white">
        </div>

        <div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                {{ __('account.save_changes') }}
            </button>
        </div>
    </form>
</div>
