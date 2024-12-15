<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class UserIndex extends Component
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
        if (strlen($this->search) >= 3) {
            $query->where(function ($subQuery) {
                $subQuery->where('username', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
            });
        }
    }

    #[Layout('layouts.app')]
    #[On('update-user-list')]
    public function render()
    {
        // Base query for fetching users
        $query = User::query()
            ->select('id', 'username', 'first_name', 'last_name', 'email');

        // Apply search filters
        $this->applySearchFilters($query);

        // Return the view with users and handle pagination
        return view('livewire.users.user-index', [
            'users' => $query->paginate($this->perPage),
        ]);
    }

    // Method to clear the search filter
    public function clearSearch()
    {
        $this->query = '';
        $this->resetPage();  // Reset pagination to the first page
    }
}
