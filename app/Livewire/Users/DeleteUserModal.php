<?php

namespace App\Livewire\Users;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class DeleteUserModal extends ModalComponent
{
    public ?int $userId = null;

    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function deleteUser()
    {
        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->delete();

            // Flash message for successful deletion
            flash()->success('User deleted successfully!');

            // Emit event to update the user list
            $this->dispatch('update-user-list');
        }

        // Close the modal after deletion
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.users.delete-user-modal');
    }
}
