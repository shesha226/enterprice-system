<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Employee Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold">Employee Directory</h3>
                    <button class="px-4 py-2 font-bold text-white bg-green-600 rounded hover:bg-green-700">
                        + Register Employee
                    </button>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <!-- Employee Card Sample -->
                    <div class="p-4 border rounded-lg shadow-sm bg-gray-50">
                        <h4 class="text-lg font-bold text-blue-600">John Doe</h4>
                        <p class="text-sm text-gray-500">ID: EMP-101</p>
                        <div class="mt-2 text-sm text-gray-700">
                            <p><strong>Age:</strong> 28</p>
                            <p><strong>Address:</strong> Colombo, Sri Lanka</p>
                            <p><strong>Salary:</strong> $1,200.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>