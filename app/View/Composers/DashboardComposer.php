<?php

namespace App\View\Composers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\View\View;
use App\Models\Department;

class DashboardComposer
{
    public function compose(View $view)
    {
        $view->with([
            'usersCount' => User::query()->count(),
            'employeesCount' => Employee::query()->count(),
            'departmentsCount' => Department::query()->count(),
        ]);
    }
}
