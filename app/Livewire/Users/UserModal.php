<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
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
                Rule::unique('users', 'email')->ignore($this->state['id'] ?? null),
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
        // Assign passed arguments
        $this->userId = $userId;
        $this->isView = $isView;
        $this->isEdit = $isEdit;

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $this->state = [
                'id' => $user->id,
                'username' => $user->username,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
            ];
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
            $user->update([
                'username' => $this->state['username'],
                'first_name' => $this->state['first_name'],
                'last_name' => $this->state['last_name'],
                'email' => $this->state['email'],
            ]);

            flash()->success('User updated successfully!');
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

    public function render()
    {
        return view('livewire.users.user-modal');
    }
}
