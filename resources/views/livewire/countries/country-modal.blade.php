<div class="bg-white dark:bg-gray-800 p-6 rounded shadow-lg">
    <form wire:submit.prevent="save">
        <!-- Country Code -->
        <div>
            <x-label for="country_code" value="Country Code" class="text-gray-800 dark:text-gray-200" />
            <x-input id="country_code" type="text"
                class="mt-1 block w-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600"
                wire:model="state.country_code" :disabled="$isView" />
            @error('state.country_code')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-label for="name" value="Name" class="text-gray-800 dark:text-gray-200" />
            <x-input id="name" type="text"
                class="mt-1 block w-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600"
                wire:model="state.name" :disabled="$isView" />
            @error('state.name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Region -->
        <div class="mt-4">
            <x-label for="region" value="Region" class="text-gray-800 dark:text-gray-200" />
            <x-input id="region" type="text"
                class="mt-1 block w-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600"
                wire:model="state.region" :disabled="$isView" />
            @error('state.region')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Phone Code -->
        <div class="mt-4">
            <x-label for="phone_code" value="Phone Code" class="text-gray-800 dark:text-gray-200" />
            <x-input id="phone_code" type="text"
                class="mt-1 block w-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600"
                wire:model="state.phone_code" :disabled="$isView" />
            @error('state.phone_code')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Save Button -->
        @unless ($isView)
            <div class="mt-4">
                <x-button class="bg-blue-500 hover:bg-blue-700 text-white dark:bg-blue-600 dark:hover:bg-blue-800">
                    {{ $isEdit ? 'Update' : 'Create' }}
                </x-button>
                <div wire:loading>
                    <x-loading-spinner />
                </div>
            </div>
        @endunless
    </form>
</div>
