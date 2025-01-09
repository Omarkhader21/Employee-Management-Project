<div class="bg-white dark:bg-gray-800 p-4 rounded shadow-lg">
    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Confirm Deletion</h2>
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
        Are you sure you want to delete this user? This action cannot be undone.
    </p>
    <div class="mt-4 flex justify-end space-x-2">
        <!-- Cancel Button -->
        <button wire:click="closeModal"
            class="bg-gray-300 hover:bg-gray-400 text-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 
                   dark:text-gray-200 font-bold py-2 px-4 rounded">
            Cancel
        </button>
        <!-- Delete Button -->
        <button wire:click="deleteUser"
            class="bg-red-500 hover:bg-red-700 text-white dark:bg-red-600 dark:hover:bg-red-800 
                   font-bold py-2 px-4 rounded">
            Delete
        </button>
    </div>
</div>
