<?php

namespace App\Livewire\Cities;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class CityIndex extends Component
{
    use WithPagination;

    public $state_id;
    // Ensure the search term is always a string, for easier handling
    #[Url(as: 'q')]
    public ?string $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $states;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'state_id' => ['except' => ''],
    ];

    public function mount()
    {
        $this->states = State::query()->select('id', 'name')->get();
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
                $query->where('cities.name', 'like', '%' . $this->search . '%')
                    ->orWhere('cities.postal_code', 'like', '%' . $this->search . '%')
                    ->orWhere('cities.population', 'like', '%' . $this->search . '%')
                    ->orWhereHas('state', function ($query) {
                        $query->where('states.name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->state_id) {
            $query->where('state_id', $this->state_id);
        }
    }

    #[Layout('layouts.app')]
    #[On('update-city-list')]
    public function render()
    {
        // Base query for fetching cities
        $query = City::query()
            ->select('id', 'name', 'postal_code', 'population', 'state_id');

        // Apply search filters
        $this->applySearchFilters($query);

        // Apply sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        // Return the view with cities and handle pagination
        return view('livewire.cities.city-index', [
            'cities' => $query->paginate($this->perPage),
        ]);
    }
}
