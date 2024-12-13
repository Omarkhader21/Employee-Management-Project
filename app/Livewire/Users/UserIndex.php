<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

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

    public function render()
    {
        // Base query for fetching users
        $query = User::query()
            ->select('id', 'username', 'first_name', 'last_name', 'email')
            ->when(strlen($this->search) > 3, function ($query) {
                // Optimized search query with condition
                return $query->where(function ($query) {
                    $query->where('username', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%');
                });
            });

        // Return the view with users and handle pagination
        return view('livewire.users.user-index', [
            'users' => $query->paginate($this->perPage),
        ])->layout('layouts.app');
    }

    // Method to clear the search filter
    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();  // Reset pagination to the first page
    }
}
