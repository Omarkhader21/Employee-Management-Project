<div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
    <div class="p-6">
        <form wire:submit.prevent="save">
            <!-- Parent Department -->
            <div class="mb-4">
                <x-label for="parent_id" value="Parent Department" class="dark:text-gray-200" />
                <select id="parent_id" wire:model="department.parent_id" :disabled="$isView"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-md shadow-sm">
                    <option value="">No Parent</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
                @error('department.parent_id')
                    <span class="text-red-500 text-sm dark:text-red-400 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name -->
            <div class="mb-4">
                <x-label for="name" value="Department Name" class="dark:text-gray-200" />
                <x-input id="name" type="text"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="department.name" :disabled="$isView" />
                @error('department.name')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Code -->
            <div class="mb-4">
                <x-label for="code" value="Department Code" class="dark:text-gray-200" />
                <x-input id="code" type="text"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    wire:model="department.code" :disabled="$isView" />
                @error('department.code')
                    <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <x-label for="description" value="Description" class="dark:text-gray-200" />
                <textarea id="description"
                    class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-md shadow-sm"
                    wire:model="department.description" :disabled="$isView"></textarea>
                @error('department.description')
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
