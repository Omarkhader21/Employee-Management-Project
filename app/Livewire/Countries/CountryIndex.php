<?php

namespace App\Livewire\Countries;

use App\Models\Country;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class CountryIndex extends Component
{
    use WithPagination;

    // Ensure the search term is always a string, for easier handling
    #[Url(as: 'q')]
    public ?string $search = '';

    // Pagination properties
    public $perPage = 10;  // You can adjust this as needed

    // Function to mount initial data, if any
    public function mount(): void
    {
        // Any setup needed on initial load
    }

    // New method to encapsulate search filters
    private function applySearchFilters($query)
    {
        if (strlen($this->search) >= 2) {
            $query->where(function ($subQuery) {
                $subQuery->where('country_code', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('region', 'like', '%' . $this->search . '%')
                    ->orWhere('phone_code', 'like', '%' . $this->search . '%');
            });
        }
    }

    #[Layout('layouts.app')]
    #[On('update-country-list')]
    public function render()
    {
        // Base query for fetching countries
        $query = Country::query()
            ->select('id', 'country_code', 'name', 'region', 'phone_code');
        // Apply search filters
        $this->applySearchFilters($query);

        return view('livewire.countries.country-index', [
            'countries' => $query->paginate($this->perPage),
        ]);
    }

    // Method to clear the search filter
    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();  // Reset pagination to the first page
    }
}
