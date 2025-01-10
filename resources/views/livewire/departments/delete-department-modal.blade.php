<div class="p-4 bg-white dark:bg-gray-800 rounded shadow-lg">
    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Confirm Deletion</h2>
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
        Are you sure you want to delete this Department? This action cannot be undone.
    </p>
    <div class="mt-4 flex justify-end space-x-2">
        <button wire:click="closeModal"
            class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-gray-200">
            Cancel
        </button>
        <button wire:click="deleteDepartment"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded dark:bg-red-600 dark:hover:bg-red-800">
            Delete
        </button>
    </div>
</div>
