<?php

namespace App\Livewire\States;

use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class StateModal extends ModalComponent
{
    public $state = [];
    public $isView = false;
    public $isEdit = false;
    public ?int $stateId = null;
    public $countries;

    protected function rules()
    {
        return [
            'state.country_id' => 'required|integer',
            'state.name' => 'required|string|max:255',
            'state.abbreviation' => 'required|string|max:10',
            'state.state_code' => 'required|string|max:10',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'state.country_id' => 'country ID',
            'state.name' => 'name',
            'state.abbreviation' => 'abbreviation',
            'state.state_code' => 'state code',
        ];
    }

    public function mount(?int $stateId = null, bool $isView = false, bool $isEdit = false)
    {
        // Assign passed arguments
        $this->stateId = $stateId;
        $this->isView = $isView;
        $this->isEdit = $isEdit;
        $this->countries = Country::all();

        // Initialize state data if stateId is provided
        if ($this->stateId) {
            $state = State::findOrFail($this->stateId);
            $this->state = $state->toArray(); // Leverage Eloquent's toArray for cleaner code
        }
    }

    public function save()
    {
        if ($this->isView) {
            return; // Prevent saving in view mode
        }

        $this->validate();

        if ($this->isEdit) {
            $state = State::findOrFail($this->state['id']);

            // Only update if changes are detected
            $changes = $this->detectChanges($state);

            if ($changes) {
                $state->update($changes);
                flash()->success('State updated successfully!');
            } else {
                flash()->info('No changes detected.');
            }
        } else {
            // Create a new state if not editing
            State::create($this->state);
            flash()->success('State created successfully!');
        }

        $this->closeModal();
        $this->dispatch('update-state-list');
    }

    // Helper function to detect changes between the original and updated state
    private function detectChanges(State $state)
    {
        $changes = [];

        // Specify the editable fields to compare
        $editableFields = ['country_id', 'name', 'abbreviation', 'state_code'];

        foreach ($editableFields as $field) {
            if ($state->$field !== $this->state[$field]) {
                $changes[$field] = $this->state[$field];
            }
        }

        return $changes;
    }

    public function render()
    {
        return view('livewire.states.state-modal');
    }
}
