<div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
    <div class="p-6">
        <form wire:submit.prevent="save">
            <!-- Username -->
            <div>
                <x-label for="username" value="Username" class="dark:text-gray-200" />
                <x-input id="username" type="text"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="state.username" :disabled="$isView" />
                @error('state.username')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- First Name -->
            <div class="mt-4">
                <x-label for="first_name" value="First Name" class="dark:text-gray-200" />
                <x-input id="first_name" type="text"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="state.first_name" :disabled="$isView" />
                @error('state.first_name')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="last_name" value="Last Name" class="dark:text-gray-200" />
                <x-input id="last_name" type="text"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="state.last_name" :disabled="$isView" />
                @error('state.last_name')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" value="Email" class="dark:text-gray-200" />
                <x-input id="email" type="email"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="state.email" :disabled="$isView" />
                @error('state.email')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            @if (!$isView && !$isEdit)
                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" value="Password" class="dark:text-gray-200" />
                    <x-input id="password" type="password"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="state.password" />
                    @error('state.password')
                        <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="mt-4">
                    <x-label for="password_confirmation" value="Confirm Password" class="dark:text-gray-200" />
                    <x-input id="password_confirmation" type="password"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="state.password_confirmation" />
                    @error('state.password_confirmation')
                        <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <!-- Save Button -->
            @unless ($isView)
                <div class="mt-4">
                    <x-button class="dark:bg-blue-600 dark:hover:bg-blue-700">
                        {{ $isEdit ? 'Update' : 'Create' }}
                    </x-button>
                    <div wire:loading>
                        <x-loading-spinner />
                    </div>
                </div>
            @endunless
        </form>
    </div>
</div>
