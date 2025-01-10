<?php

namespace App\Livewire\Departments;

use Livewire\Component;
use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class DepartmentIndex extends Component
{
    use WithPagination;

     // Ensure the search term is always a string, for easier handling
     #[Url(as: 'q')]
     public ?string $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
    ];

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
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('code', 'like', '%' . $this->search . '%');
        }
    }

    #[Layout('layouts.app')]
    #[On('update-department-list')]
    public function render()
    {
        $query = Department::query();

        $this->applySearchFilters($query);

        $query->orderBy($this->sortField, $this->sortDirection);

        return view('livewire.departments.department-index', [
            'departments' => $query->paginate($this->perPage),
        ]);
    }
}
