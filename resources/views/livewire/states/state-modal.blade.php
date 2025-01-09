<div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
    <div class="p-6">
        <form wire:submit.prevent="save">
            <!-- Country ID -->
            <div class="mb-4">
                <x-label for="country_id" value="Country" class="dark:text-gray-200" />
                <select id="country_id" wire:model="state.country_id" :disabled="$isView"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('state.country_id')
                    <span class="text-red-500 text-sm dark:text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" value="Name" class="dark:text-gray-200" />
                <x-input id="name" type="text"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="state.name" :disabled="$isView" />
                @error('state.name')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Abbreviation -->
            <div class="mt-4">
                <x-label for="abbreviation" value="Abbreviation" class="dark:text-gray-200" />
                <x-input id="abbreviation" type="text"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="state.abbreviation" :disabled="$isView" />
                @error('state.abbreviation')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- State Code -->
            <div class="mt-4">
                <x-label for="state_code" value="State Code" class="dark:text-gray-200" />
                <x-input id="state_code" type="text"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="state.state_code" :disabled="$isView" />
                @error('state.state_code')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

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
