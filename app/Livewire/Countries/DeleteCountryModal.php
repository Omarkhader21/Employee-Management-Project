<?php

namespace App\Livewire\Countries;

use App\Models\Country;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteCountryModal extends ModalComponent
{
    public ?int $countryId = null;

    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function deleteCountry()
    {
        if ($this->countryId) {
            $country = Country::findOrFail($this->countryId);
            $country->delete();

            // Flash message for successful deletion
            flash()->success('Country deleted successfully!');

            // Emit event to update the country list
            $this->dispatch('update-country-list');
        }

        // Close the modal after deletion
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.countries.delete-country-modal');
    }
}
