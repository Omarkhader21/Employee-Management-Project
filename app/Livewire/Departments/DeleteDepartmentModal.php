<?php

namespace App\Livewire\Departments;

use App\Models\Department;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteDepartmentModal extends ModalComponent
{
    public ?int $departmentId = null;

    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function deleteDepartment()
    {
        if ($this->departmentId) {
            $department = Department::findOrFail($this->departmentId);
            $department->delete();

            // Flash message for successful deletion
            flash()->success('Department deleted successfully!');

            // Emit event to update the user list
            $this->dispatch('update-department-list');
        }

        // Close the modal after deletion
        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.departments.delete-department-modal');
    }
}
