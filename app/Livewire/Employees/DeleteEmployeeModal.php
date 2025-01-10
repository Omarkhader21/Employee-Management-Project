<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use Livewire\Component;

class DeleteEmployeeModal extends Component
{
    public ?int $employeeId = null;

    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function deleteEmployee()
    {
        if ($this->employeeId) {
            $state = Employee::findOrFail($this->employeeId);
            $state->delete();

            // Flash message for successful deletion
            flash()->success('Employee deleted successfully!');

            // Emit event to update the user list
            $this->dispatch('update-employee-list');
        }

        // Close the modal after deletion
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.employees.delete-employee-modal');
    }
}
