<div>
    <div class="p-4">
        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Confirm Deletion</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Are you sure you want to delete this user? This action cannot be undone.
        </p>
        <div class="mt-4 flex justify-end space-x-2">
            <button wire:click="closeModal"
                class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded">
                Cancel
            </button>
            <button wire:click="deleteUser" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Delete
            </button>
        </div>
    </div>
</div>
