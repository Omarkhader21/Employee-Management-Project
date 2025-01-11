<div
    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
        Welcome to {{ auth()->user()->username }}'s Dashboard
    </h1>

    <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
        Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application.
    </p>
</div>

<div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6 lg:p-8">
    <!-- Users Card -->
    <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <i class="fas fa-users text-4xl text-gray-400 dark:text-gray-300"></i>
            <div class="ml-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Users
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm">
                    {{ $usersCount }} Users
                </p>
            </div>
        </div>
        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
            Manage the users of your application, including their roles and permissions.
        </p>
        <p class="mt-4 text-sm">
            <a href="{{ route('users.index') }}"
                class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                View Users
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </p>
    </div>

    <!-- Employees Card -->
    <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <i class="fas fa-briefcase text-4xl text-gray-400 dark:text-gray-300"></i>
            <div class="ml-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Employees
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm">
                    {{ $employeesCount }} Employees
                </p>
            </div>
        </div>
        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
            Keep track of your employees and their roles in your organization.
        </p>
        <p class="mt-4 text-sm">
            <a href="{{ route('employees.index') }}"
                class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                View Employees
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </p>
    </div>

    <!-- Departments Card -->
    <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <i class="fas fa-building text-4xl text-gray-400 dark:text-gray-300"></i>
            <div class="ml-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Departments
                </h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm">
                    {{ $departmentsCount }} Departments
                </p>
            </div>
        </div>
        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
            Organize your application by managing departments and assigning employees.
        </p>
        <p class="mt-4 text-sm">
            <a href="{{ route('departments.index') }}"
                class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300">
                View Departments
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </p>
    </div>
</div>
