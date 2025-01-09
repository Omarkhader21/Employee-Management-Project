<?php

namespace App\Livewire\States;

use App\Models\State;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteStateModal extends ModalComponent
{
    public ?int $stateId = null;

    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function deleteState()
    {
        if ($this->stateId) {
            $state = State::findOrFail($this->stateId);
            $state->delete();

            // Flash message for successful deletion
            flash()->success('State deleted successfully!');

            // Emit event to update the user list
            $this->dispatch('update-state-list');
        }

        // Close the modal after deletion
        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.states.delete-state-modal');
    }
}
