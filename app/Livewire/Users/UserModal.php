<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class UserModal extends ModalComponent
{
    public $state = [];
    public $isView = false;
    public $isEdit = false;
    public ?int $userId = null;

    protected function rules()
    {
        return [
            'state.username' => 'required|string|max:255',
            'state.first_name' => 'required|string|max:255',
            'state.last_name' => 'required|string|max:255',
            'state.email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->userId ?? null),
            ],
            'state.password' => $this->isEdit ? 'nullable|string|min:8|confirmed' : 'required|string|min:8|confirmed',
            'state.password_confirmation' => $this->isEdit ? 'nullable|string|min:8' : 'required|string|min:8',
        ];
    }

    protected function validationAttributes()
    {
        return [
            'state.username' => 'username',
            'state.first_name' => 'first name',
            'state.last_name' => 'last name',
            'state.email' => 'email',
            'state.password' => 'password',
            'state.password_confirmation' => 'password confirmation',
        ];
    }

    public function mount(?int $userId = null, bool $isView = false, bool $isEdit = false)
    {
        $this->userId = $userId;
        $this->isView = $isView;
        $this->isEdit = $isEdit;

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $this->state = $user->only(['id', 'username', 'first_name', 'last_name', 'email']); // Cleaner assignment
        }
    }

    public function save()
    {
        if ($this->isView) {
            return; // Prevent saving in view mode
        }

        $this->validate();

        if ($this->isEdit) {
            $user = User::findOrFail($this->state['id']);
            $changes = $this->detectChanges($user);

            if ($changes) {
                $user->update($changes);
                flash()->success('User updated successfully!');
            } else {
                flash()->info('No changes detected.');
            }
        } else {
            User::create([
                'username' => $this->state['username'],
                'first_name' => $this->state['first_name'],
                'last_name' => $this->state['last_name'],
                'email' => $this->state['email'],
                'password' => bcrypt($this->state['password']),
            ]);

            flash()->success('User created successfully!');
        }

        $this->closeModal();
        $this->dispatch('update-user-list');
    }

    // Helper function to detect changes between original and updated user data
    private function detectChanges(User $user)
    {
        $changes = [];

        // Loop through state and detect changes
        foreach (['username', 'first_name', 'last_name', 'email'] as $field) {
            if ($user->$field !== $this->state[$field]) {
                $changes[$field] = $this->state[$field];
            }
        }

        // Check if password is provided and is different from the current one
        if (!empty($this->state['password']) && bcrypt($this->state['password']) !== $user->password) {
            $changes['password'] = bcrypt($this->state['password']);
        }

        return $changes;
    }

    public function render()
    {
        return view('livewire.users.user-modal');
    }
}
