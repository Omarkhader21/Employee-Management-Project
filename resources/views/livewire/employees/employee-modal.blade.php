<div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200">
    <div class="p-6 max-w-4xl mx-auto">
        <form wire:submit.prevent="save">
            <!-- Employee Info Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- First Name -->
                <div class="mb-4">
                    <x-label for="first_name" value="First Name" class="dark:text-gray-200" />
                    <x-input id="first_name" type="text"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="employee.first_name" :disabled="$isView" />
                    @error('employee.first_name')
                        <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="mb-4">
                    <x-label for="last_name" value="Last Name" class="dark:text-gray-200" />
                    <x-input id="last_name" type="text"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="employee.last_name" :disabled="$isView" />
                    @error('employee.last_name')
                        <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Middle Name -->
                <div class="mb-4">
                    <x-label for="middle_name" value="Middle Name" class="dark:text-gray-200" />
                    <x-input id="middle_name" type="text"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="employee.middle_name" :disabled="$isView" />
                    @error('employee.middle_name')
                        <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <x-label for="address" value="Address" class="dark:text-gray-200" />
                    <x-input id="address" type="text"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="employee.address" :disabled="$isView" />
                    @error('employee.address')
                        <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Department -->
                <div class="mb-4">
                    <x-label for="department_id" value="Department" class="dark:text-gray-200" />
                    <select id="department_id" wire:model="employee.department_id" :disabled="$isView"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-md shadow-sm">
                        <option value="">Select Department</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                    @error('employee.department_id')
                        <span class="text-red-500 text-sm dark:text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- City -->
                <div class="mb-4">
                    <x-label for="city_id" value="City" class="dark:text-gray-200" />
                    <select id="city_id" wire:model="employee.city_id" :disabled="$isView"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-md shadow-sm">
                        <option value="">Select City</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('employee.city_id')
                        <span class="text-red-500 text-sm dark:text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- State -->
                <div class="mb-4">
                    <x-label for="state_id" value="State" class="dark:text-gray-200" />
                    <select id="state_id" wire:model="employee.state_id" :disabled="$isView"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-md shadow-sm">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                    @error('employee.state_id')
                        <span class="text-red-500 text-sm dark:text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Country -->
                <div class="mb-4">
                    <x-label for="country_id" value="Country" class="dark:text-gray-200" />
                    <select id="country_id" wire:model="employee.country_id" :disabled="$isView"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-md shadow-sm">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('employee.country_id')
                        <span class="text-red-500 text-sm dark:text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Zip Code -->
                <div class="mb-4">
                    <x-label for="zip_code" value="Zip Code" class="dark:text-gray-200" />
                    <x-input id="zip_code" type="text"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="employee.zip_code" :disabled="$isView" />
                    @error('employee.zip_code')
                        <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Birthdate -->
                <div class="mb-4">
                    <x-label for="birthdate" value="Birthdate" class="dark:text-gray-200" />
                    <x-input id="birthdate" type="date"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="employee.birthdate" :disabled="$isView" />
                    @error('employee.birthdate')
                        <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Date Hired -->
                <div class="mb-4">
                    <x-label for="date_hired" value="Date Hired" class="dark:text-gray-200" />
                    <x-input id="date_hired" type="date"
                        class="mt-1 block w-full dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="employee.date_hired" :disabled="$isView" />
                    @error('employee.date_hired')
                        <span class="text-red-500 text-sm dark:text-red-400">{{ $message }}</span>
                    @enderror
                </div>
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
