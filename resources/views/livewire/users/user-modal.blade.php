<div>
    <div class="p-6">
        <form wire:submit.prevent="save">
            <!-- Username -->
            <div>
                <x-label for="username" value="Username" />
                <x-input id="username" type="text" class="mt-1 block w-full" wire:model="state.username"
                    :disabled="$isView" />
                @error('state.username')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- First Name -->
            <div class="mt-4">
                <x-label for="first_name" value="First Name" />
                <x-input id="first_name" type="text" class="mt-1 block w-full" wire:model="state.first_name"
                    :disabled="$isView" />
                @error('state.first_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="last_name" value="Last Name" />
                <x-input id="last_name" type="text" class="mt-1 block w-full" wire:model="state.last_name"
                    :disabled="$isView" />
                @error('state.last_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" value="Email" />
                <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email"
                    :disabled="$isView" />
                @error('state.email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            @if (!$isView && !$isEdit)
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" value="Password" />
                <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" />
                @error('state.password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="Confirm Password" />
                <x-input id="password_confirmation" type="password" class="mt-1 block w-full"
                    wire:model="state.password_confirmation" />
                @error('state.password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            @endif

            <!-- Save Button -->
            @if (!$isView)
            <div class="mt-4">
                <x-button>Save</x-button>
                <div wire:loading>
                    <x-loading-spinner />
                </div>
            </div>
            @endif
        </form>
    </div>
</div>
