<div>
    <div class="p-6">
        <form wire:submit.prevent="save">
            <!-- Country Code -->
            <div>
                <x-label for="country_code" value="Country Code" />
                <x-input id="country_code" type="text" class="mt-1 block w-full" wire:model="state.country_code"
                    :disabled="$isView" />
                @error('state.country_code')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-label for="name" value="Name" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" :disabled="$isView" />
                @error('state.name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Region -->
            <div class="mt-4">
                <x-label for="region" value="Region" />
                <x-input id="region" type="text" class="mt-1 block w-full" wire:model="state.region"
                    :disabled="$isView" />
                @error('state.region')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone Code -->
            <div class="mt-4">
                <x-label for="phone_code" value="Phone Code" />
                <x-input id="phone_code" type="text" class="mt-1 block w-full" wire:model="state.phone_code"
                    :disabled="$isView" />
                @error('state.phone_code')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Save Button -->
            @unless($isView)
            <div class="mt-4">
                <x-button>
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
