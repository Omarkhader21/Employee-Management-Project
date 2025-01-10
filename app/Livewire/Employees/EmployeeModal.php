<?php

namespace App\Livewire\Employees;

use Carbon\Carbon;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Employee;
use App\Models\Department;
use LivewireUI\Modal\ModalComponent;

class EmployeeModal extends ModalComponent
{
    public $employee = []; // Stores all employee attributes
    public $isView = false;
    public $isEdit = false;
    public ?int $employeeId = null;
    public $departments;
    public $cities;
    public $states;
    public $countries;

    protected function rules()
    {
        return [
            'employee.first_name' => 'required|string|max:255',
            'employee.last_name' => 'required|string|max:255',
            'employee.middle_name' => 'nullable|string|max:255',
            'employee.address' => 'nullable|string',
            'employee.department_id' => 'required|exists:departments,id',
            'employee.city_id' => 'required|exists:cities,id',
            'employee.state_id' => 'required|exists:states,id',
            'employee.country_id' => 'required|exists:countries,id',
            'employee.zip_code' => 'required|string|max:20',
            'employee.birthdate' => 'nullable|date',
            'employee.date_hired' => 'nullable|date',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'employee.first_name' => 'First Name',
            'employee.last_name' => 'Last Name',
            'employee.middle_name' => 'Middle Name',
            'employee.address' => 'Address',
            'employee.department_id' => 'Department',
            'employee.city_id' => 'City',
            'employee.state_id' => 'State',
            'employee.country_id' => 'Country',
            'employee.zip_code' => 'Zip Code',
            'employee.birthdate' => 'Birthdate',
            'employee.date_hired' => 'Date Hired',
        ];
    }

    public function mount(?int $employeeId = null, bool $isView = false, bool $isEdit = false)
    {
        $this->employeeId = $employeeId;
        $this->isView = $isView;
        $this->isEdit = $isEdit;

        // Load related data for dropdowns
        $this->departments = Department::query()->select('id', 'name')->get();
        $this->cities = City::query()->select('id', 'name')->get();
        $this->states = State::query()->select('id', 'name')->get();
        $this->countries = Country::query()->select('id', 'name')->get();

        // Load employee data if an ID is provided
        if ($this->employeeId) {
            $this->employee = Employee::findOrFail($this->employeeId)->toArray();

            // Convert dates to string for form input
            $this->employee['birthdate'] = Carbon::parse($this->employee['birthdate'])->format('Y-m-d');
            $this->employee['date_hired'] = Carbon::parse($this->employee['date_hired'])->format('Y-m-d');
        }
    }

    public function save()
    {
        if ($this->isView) {
            return; // Prevent saving in view mode
        }

        $this->validate();

        if ($this->isEdit) {
            $employee = Employee::findOrFail($this->employeeId);

            // Only update if changes are detected
            $changes = $this->detectChanges($employee);

            if ($changes) {
                $employee->update($changes);
                flash()->success('Employee updated successfully!');
            } else {
                flash()->info('No changes detected.');
            }
        } else {
            // Create a new employee if not editing
            Employee::create($this->employee);
            flash()->success('Employee created successfully!');
        }

        $this->closeModal();
        $this->dispatch('update-employee-list');
    }

    // Helper function to detect changes between the original and updated employee data
    private function detectChanges(Employee $employee)
    {
        $changes = [];

        // Specify the fields to compare
        foreach (['first_name', 'last_name', 'middle_name', 'address', 'department_id', 'city_id', 'state_id', 'country_id', 'zip_code', 'birthdate', 'date_hired'] as $field) {
            // For dates, compare the Carbon instances
            if (in_array($field, ['birthdate', 'date_hired'])) {
                // Compare Carbon instances directly
                if (!Carbon::parse($employee->$field)->isSameDay(Carbon::parse($this->employee[$field]))) {
                    $changes[$field] = $this->employee[$field];
                }
            } else {
                // For other fields, compare values directly
                if ($employee->$field !== $this->employee[$field]) {
                    $changes[$field] = $this->employee[$field];
                }
            }
        }

        return $changes;
    }


    public function render()
    {
        return view('livewire.employees.employee-modal');
    }
}
