<?php

namespace App\Livewire\Departments;

use Livewire\Component;
use App\Models\Department;
use Illuminate\Validation\Rule;
use LivewireUI\Modal\ModalComponent;

class DepartmentModal extends ModalComponent
{
    public $department = [];
    public $departments = [];
    public $isView = false;
    public $isEdit = false;
    public ?int $departmentId = null;

    protected function rules()
    {
        return [
            'department.name' => 'required|string|max:255',
            'department.code' => 'required|string|max:20',
            'department.parent_id' => 'nullable|exists:departments,id',
            'department.description' => 'nullable|string',
            Rule::unique('departments')->whereNull('deleted_at'), // Exclude soft-deleted users
        ];
    }

    protected function validationAttributes()
    {
        return [
            'department.name' => 'name',
            'department.code' => 'code',
            'department.description' => 'description',
        ];
    }

    public function mount(?int $departmentId = null, bool $isView = false, bool $isEdit = false)
    {
        $this->departmentId = $departmentId;
        $this->isView = $isView;
        $this->isEdit = $isEdit;

        if ($this->departmentId) {
            $department = Department::findOrFail($this->departmentId);
            $this->department = $department->toArray();

            // Exclude the current department from the list of selectable parents
            $this->departments = Department::where('id', '!=', $this->departmentId)->get();
        } else {
            $this->departments = Department::query()->select('id', 'name')->get();
        }
    }

    public function save()
    {
        if ($this->isView) {
            return;
        }

        $this->validate();

        if ($this->isEdit) {
            $department = Department::findOrFail($this->department['id']);

            // Detect changes
            $changes = $this->detectChanges($department);

            if (!empty($changes)) {
                // Apply changes if there are any
                $department->update($changes);
                flash()->success('Department updated successfully!');
            } else {
                flash()->info('No changes detected.');
            }
        } else {
            Department::create($this->department);
            flash()->success('Department created successfully!');
        }

        $this->closeModal();
        $this->dispatch('update-department-list');
    }

    private function detectChanges(Department $department)
    {
        $changes = [];

        // Define the editable fields for a department
        $editableFields = ['name', 'code', 'parent_id', 'description'];

        foreach ($editableFields as $field) {
            if ($department->$field !== $this->department[$field]) {
                $changes[$field] = $this->department[$field];
            }
        }

        return $changes;
    }

    public function render()
    {
        return view('livewire.departments.department-modal');
    }
}
