<?php

namespace App\Livewire\Cities;

use App\Models\City;
use App\Models\State;
use LivewireUI\Modal\ModalComponent;

class CityModal extends ModalComponent
{
    public $city = [];
    public $isView = false;
    public $isEdit = false;
    public ?int $cityId = null;
    public $states;

    protected function rules()
    {
        return [
            'city.state_id' => 'required|integer',
            'city.name' => 'required|string|max:255',
            'city.postal_code' => 'required|string|max:10',
            'city.population' => 'required|integer|min:0',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'city.state_id' => 'state ID',
            'city.name' => 'name',
            'city.postal_code' => 'postal code',
            'city.population' => 'population',
        ];
    }

    public function mount(?int $cityId = null, bool $isView = false, bool $isEdit = false)
    {
        $this->cityId = $cityId;
        $this->isView = $isView;
        $this->isEdit = $isEdit;
        $this->states = State::query()->select('id', 'name')->get();

        if ($this->cityId) {
            $city = City::findOrFail($this->cityId);
            $this->city = $city->toArray();
        }
    }

    public function save()
    {
        if ($this->isView) {
            return;
        }

        $this->validate();

        if ($this->isEdit) {
            $city = City::findOrFail($this->city['id']);

            // Only update if changes are detected
            $changes = $this->detectChanges($city);

            if ($changes) {
                $city->update($changes);
                flash()->success('City updated successfully!');
            } else {
                flash()->info('No changes detected.');
            }
        } else {
            City::create($this->city);
            flash()->success('City created successfully!');
        }

        $this->closeModal();
        $this->dispatch('update-city-list');
    }

    // Helper function to detect changes between the original and updated city data
    private function detectChanges(City $city)
    {
        $changes = [];

        // Specify the editable fields to compare
        $editableFields = ['state_id', 'name', 'postal_code', 'population'];

        foreach ($editableFields as $field) {
            if ($city->$field !== $this->city[$field]) {
                $changes[$field] = $this->city[$field];
            }
        }

        return $changes;
    }

    public function render()
    {
        return view('livewire.cities.city-modal');
    }
}
