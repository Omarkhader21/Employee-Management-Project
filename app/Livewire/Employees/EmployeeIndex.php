<?php

namespace App\Livewire\Employees;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class EmployeeIndex extends Component
{
    use WithPagination;

    // Ensure the search term is always a string, for easier handling
    #[Url(as: 'q')]
    public ?string $search = '';
    public $perPage = 10;
    public $department_id;
    public $city_id;
    public $state_id;
    public $country_id;
    public $departments;
    public $cities;
    public $states;
    public $countries;

    protected $queryString = [
        'search' => ['except' => ''],
        'department_id' => ['except' => ''],
        'city_id' => ['except' => ''],
        'state_id' => ['except' => ''],
        'country_id' => ['except' => ''],
    ];

    public function mount()
    {
        $this->departments = Department::query()->pluck('id', 'name');
        $this->cities = City::query()->pluck('name', 'id');
        $this->states = State::query()->pluck('name', 'id');
        $this->countries = Country::query()->pluck('name', 'id');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function applyFilters($query)
    {
        if ($this->search) {
            $query->where(function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('middle_name', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->department_id) {
            $query->where('department_id', $this->department_id);
        }

        if ($this->city_id) {
            $query->where('city_id', $this->city_id);
        }

        if ($this->state_id) {
            $query->where('state_id', $this->state_id);
        }

        if ($this->country_id) {
            $query->where('country_id', $this->country_id);
        }
    }

    #[Layout('layouts.app')]
    #[On('update-employee-list')]
    public function render()
    {
        $query = Employee::query();

        $this->applyFilters($query);

        $employees = $query->paginate($this->perPage);

        return view('livewire.employees.employee-index', [
            'employees' => $employees,
        ]);
    }
}
