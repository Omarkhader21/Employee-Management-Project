<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Countries') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Search Bar and Add User Button -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center space-x-2">
                    <!-- Search Bar -->
                    <input wire:model.live="search" type="text" placeholder="Search countries..."
                        class="border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                    <div wire:loading class="ml-2 text-gray-500 dark:text-gray-400">
                        <x-loading-spinner />
                    </div>
                </div>

                <!-- Add New User Button -->
                <button wire:click="$dispatch('openModal', { component: 'countries.country-modal'})"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    Add New Country
                </button>
            </div>

            <!-- Table -->
            <table id="userTable" class="min-w-full bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        <th
                            class="border-b border-gray-300 dark:border-gray-700 px-4 py-3 text-left text-sm font-medium">
                            #Id</th>
                        <th
                            class="border-b border-gray-300 dark:border-gray-700 px-4 py-3 text-left text-sm font-medium">
                            Country Code</th>
                        <th
                            class="border-b border-gray-300 dark:border-gray-700 px-4 py-3 text-left text-sm font-medium">
                            Name</th>
                        <th
                            class="border-b border-gray-300 dark:border-gray-700 px-4 py-3 text-left text-sm font-medium">
                            Region</th>
                        <th
                            class="border-b border-gray-300 dark:border-gray-700 px-4 py-3 text-left text-sm font-medium">
                            Phone Code</th>
                        <th
                            class="border-b border-gray-300 dark:border-gray-700 px-4 py-3 text-center text-sm font-medium">
                            Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($countries as $key => $country)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200 ease-in-out">
                            <td
                                class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-sm text-gray-600 dark:text-gray-200">
                                {{ $countries->firstItem() + $key }}</td>
                            <td
                                class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-sm text-gray-600 dark:text-gray-200">
                                {{ $country->country_code }}</td>
                            <td
                                class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-sm text-gray-600 dark:text-gray-200">
                                {{ $country->name }}</td>
                            <td
                                class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-sm text-gray-600 dark:text-gray-200">
                                {{ $country->region }}</td>
                            <td
                                class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-sm text-gray-600 dark:text-gray-200">
                                {{ $country->phone_code }}</td>
                            <td class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-center">
                                <button
                                    wire:click="$dispatch('openModal', {component: 'countries.country-modal', arguments: {countryId: {{ $country->id }}, isView: {{ true }}}})"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                                    View
                                </button>
                                <button
                                    wire:click="$dispatch('openModal', {component: 'countries.country-modal', arguments: {countryId: {{ $country->id }}, isEdit: {{ true }}}})"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                                    Edit
                                </button>
                                <button
                                    wire:click="$dispatch('openModal', { component: 'countries.delete-country-modal', arguments: { countryId: {{ $country->id }}}})"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border-b border-gray-200 dark:border-gray-700 px-4 py-3 text-center text-gray-500 dark:text-gray-400"
                                colspan="6">No Countries
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                <!-- Pagination Links -->
                <tfoot>
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center text-gray-600 dark:text-gray-200">
                            <!-- Livewire pagination links -->
                            {{ $countries->links('vendor.livewire.tailwind') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
