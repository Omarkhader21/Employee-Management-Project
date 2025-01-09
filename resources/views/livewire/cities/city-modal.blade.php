<div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
    <div class="p-6">
        <form wire:submit.prevent="save">
            <!-- State ID -->
            <div class="mb-4">
                <x-label for="state_id" value="State" class="dark:text-gray-200" />
                <select id="state_id" wire:model="city.state_id" :disabled="$isView"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-md shadow-sm">
                    <option value="">Select State</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
                @error('city.state_id')
                    <span class="text-red-500 text-sm dark:text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" value="Name" class="dark:text-gray-200" />
                <x-input id="name" type="text"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="city.name" :disabled="$isView" />
                @error('city.name')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Postal Code -->
            <div class="mt-4">
                <x-label for="postal_code" value="Postal Code" class="dark:text-gray-200" />
                <x-input id="postal_code" type="text"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="city.postal_code" :disabled="$isView" />
                @error('city.postal_code')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Population -->
            <div class="mt-4">
                <x-label for="population" value="Population" class="dark:text-gray-200" />
                <x-input id="population" type="number"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="city.population" :disabled="$isView" />
                @error('city.population')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Save Button -->
            @unless ($isView)
                <div class="mt-4">
                    <x-button class="dark:bg-blue-600 dark:hover:bg-blue-700">
                        {{ $isEdit ? 'Update' : 'Create' }}
                    </x-button>
                </div>
            @endunless
        </form>
    </div>
</div>
