<?php

namespace App\Livewire\Cities;

use App\Models\City;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteCityModal extends ModalComponent
{
    public ?int $cityId = null;

    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function deleteCity()
    {
        if ($this->cityId) {
            $city = City::findOrFail($this->cityId);
            $city->delete();

            // Flash message for successful deletion
            flash()->success('city deleted successfully!');

            // Emit event to update the user list
            $this->dispatch('update-city-list');
        }

        // Close the modal after deletion
        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.cities.delete-city-modal');
    }
}
