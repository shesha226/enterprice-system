<nav class="flex items-center justify-between px-6 py-3 bg-white border-b border-gray-200">
    <div class="flex items-center space-x-6">
        <a href="{{ route('dashboard') }}" class="text-lg font-semibold">Dashboard</a>
        <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600">Products</a>
        <a href="{{ route('users.index') }}" class="text-gray-700 hover:text-blue-600">Users</a>
        <a href="{{ route('employees.index') }}" class="text-gray-700 hover:text-blue-600">Employees</a>
        <a href="{{ route('attendance.index') }}" class="text-gray-700 hover:text-blue-600">Attendance</a>
    </div>
    <div class="text-gray-600">
        {{ Auth::user()->name ?? 'shashika' }} ▾
    </div>
</nav>