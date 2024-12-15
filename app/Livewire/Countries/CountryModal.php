<?php

namespace App\Livewire\Countries;

use App\Models\Country;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CountryModal extends ModalComponent
{
    public $state = [];
    public $isView = false;
    public $isEdit = false;
    public ?int $countryId = null;

    protected function rules()
    {
        return [
            'state.country_code' => 'required|string|max:3|unique:countries,country_code,' . ($this->countryId ?? 'NULL'),
            'state.name' => 'required|string|max:100|unique:countries,name,' . ($this->countryId ?? 'NULL'),
            'state.region' => 'nullable|string|max:50',
            'state.phone_code' => 'nullable|string|max:10',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'state.country_code' => 'country code',
            'state.name' => 'name',
            'state.region' => 'region',
            'state.phone_code' => 'phone code',
        ];
    }

    public function mount(?int $countryId = null, bool $isView = false, bool $isEdit = false)
    {
        $this->countryId = $countryId;
        $this->isView = $isView;
        $this->isEdit = $isEdit;

        if ($this->countryId) {
            $country = Country::findOrFail($this->countryId);
            $this->state = [
                'id' => $country->id,
                'country_code' => $country->country_code,
                'name' => $country->name,
                'region' => $country->region,
                'phone_code' => $country->phone_code,
            ];
        }
    }

    public function save()
    {
        if ($this->isView) {
            // Prevent saving in view mode
            return;
        }

        $this->validate();

        if ($this->isEdit) {
            $country = Country::findOrFail($this->state['id']);
            $country->update($this->state);

            flash()->success('Country updated successfully!');
        } else {
            Country::create($this->state);

            flash()->success('Country created successfully!');
        }

        $this->closeModal();
        $this->dispatch('update-country-list');
    }

    public function render()
    {
        return view('livewire.countries.country-modal');
    }
}
