<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Search Bar and Add User Button -->
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center space-x-2">
                    <!-- Search Bar -->
                    <input wire:model.live="search" type="text" placeholder="Search users..."
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" />

                    <div wire:loading class="ml-2 text-gray-500">
                        <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Add New User Button -->
                <button
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    Add New User
                </button>
            </div>

            <!-- Table -->
            <table id="userTable"
                class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="border-b border-gray-300 px-4 py-3 text-left text-sm font-medium">#Id</th>
                        <th class="border-b border-gray-300 px-4 py-3 text-left text-sm font-medium">Username</th>
                        <th class="border-b border-gray-300 px-4 py-3 text-left text-sm font-medium">Email</th>
                        <th class="border-b border-gray-300 px-4 py-3 text-left text-sm font-medium">First Name</th>
                        <th class="border-b border-gray-300 px-4 py-3 text-left text-sm font-medium">Last Name</th>
                        <th class="border-b border-gray-300 px-4 py-3 text-center text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $key => $user)
                    <tr class="hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="border-b border-gray-200 px-4 py-3 text-sm text-gray-600">{{ $users->firstItem() +
                            $key }}</td>
                        <td class="border-b border-gray-200 px-4 py-3 text-sm text-gray-600">{{ $user->username }}</td>
                        <td class="border-b border-gray-200 px-4 py-3 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="border-b border-gray-200 px-4 py-3 text-sm text-gray-600">{{ $user->first_name }}
                        </td>
                        <td class="border-b border-gray-200 px-4 py-3 text-sm text-gray-600">{{ $user->last_name }}</td>
                        <td class="border-b border-gray-200 px-4 py-3 text-center">
                            <button
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                                View
                            </button>
                            <button
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                                Edit
                            </button>
                            <button
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200 ease-in-out">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="border-b border-gray-200 px-4 py-3 text-center text-gray-500" colspan="6">No Users
                        </td>
                    </tr>
                    @endforelse
                </tbody>

                <!-- Pagination Links -->
                <tfoot>
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center">
                            <!-- Livewire pagination links -->
                            {{ $users->links('pagination::tailwind') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>