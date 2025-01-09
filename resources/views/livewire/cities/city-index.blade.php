<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('City') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Search Bar and Add City Button -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center space-x-2">
                    <!-- Search Bar -->
                    <input wire:model.live="search" type="text" placeholder="Search cities..."
                        class="border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 dark:bg-gray-800 dark:text-gray-200 dark:placeholder-gray-400" />
                    <div wire:loading class="ml-2 text-gray-500 dark:text-gray-400">
                        <x-loading-spinner />
                    </div>
                </div>

                <!-- Add New City Button -->
                <button wire:click="$dispatch('openModal', { component: 'cities.city-modal'})"
                    class="bg-green-500 hover:bg-green-700 dark:bg-green-600 dark:hover:bg-green-800 text-white font-bold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    Add New City
                </button>
            </div>

            <!-- Table -->
            <table id="cityTable" class="min-w-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <th
                            class="border-b border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-medium">
                            #Id</th>
                        <th
                            class="border-b border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-medium">
                            Name</th>
                        <th
                            class="border-b border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-medium">
                            Postal Code</th>
                        <th
                            class="border-b border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-medium">
                            Population</th>
                        <th
                            class="border-b border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-medium">
                            State</th>
                        <th
                            class="border-b border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-medium">
                            Country</th>
                        <th
                            class="border-b border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-medium">
                            Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cities as $key => $city)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200 ease-in-out">
                            <td
                                class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                {{ $cities->firstItem() + $key }}</td>
                            <td
                                class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                {{ $city->name }}</td>
                            <td
                                class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                {{ $city->postal_code }}</td>
                            <td
                                class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                {{ $city->population }}</td>
                            <td
                                class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                {{ $city->state->name }}</td>
                            <td
                                class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-sm text-gray-600 dark:text-gray-300">
                                {{ $city->state->country->name }}</td>
                            <td class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-center">
                                <button
                                    wire:click="$dispatch('openModal', {component: 'cities.city-modal', arguments: {cityId: {{ $city->id }}, isView: {{ true }}}})"
                                    class="bg-green-500 hover:bg-green-700 dark:bg-green-600 dark:hover:bg-green-800 text-white font-bold py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                                    View
                                </button>
                                <button
                                    wire:click="$dispatch('openModal', {component: 'cities.city-modal', arguments: {cityId: {{ $city->id }}, isEdit: {{ true }}}})"
                                    class="bg-blue-500 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                                    Edit
                                </button>
                                <button
                                    wire:click="$dispatch('openModal', { component: 'cities.delete-city-modal', arguments: { cityId: {{ $city->id }}}})"
                                    class="bg-red-500 hover:bg-red-700 dark:bg-red-600 dark:hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-center text-gray-500 dark:text-gray-400"
                                colspan="7">
                                No city found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                <!-- Pagination Links -->
                <tfoot>
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center">
                            {{ $cities->links('vendor.livewire.tailwind') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
