<?php

namespace App\Livewire\States;

use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class StateIndex extends Component
{
    use WithPagination;

    public $country_id;
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $countries;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'country_id' => ['except' => ''],
    ];

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    protected function applySearchFilters($query)
    {
        if ($this->search) {
            $query->where(function ($query) {
                $query->where('states.name', 'like', '%' . $this->search . '%')
                    ->orWhere('states.abbreviation', 'like', '%' . $this->search . '%')
                    ->orWhere('states.state_code', 'like', '%' . $this->search . '%')
                    ->orWhereHas('country', function ($query) {
                        $query->where('countries.name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->country_id) {
            $query->where('country_id', $this->country_id);
        }
    }

    #[Layout('layouts.app')]
    #[On('update-state-list')]
    public function render()
    {
        // Base query for fetching states
        $query = State::query()
            ->select('id', 'name', 'abbreviation', 'state_code', 'country_id');

        // Apply search filters
        $this->applySearchFilters($query);

        // Apply sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        // Return the view with states and handle pagination
        return view('livewire.states.state-index', [
            'states' => $query->paginate($this->perPage),
        ]);
    }
}
