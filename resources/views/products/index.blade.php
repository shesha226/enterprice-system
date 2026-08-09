<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Product Inventory Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">

                <!-- Add Product Button -->
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold">All Products List</h3>
                    <button class="px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-700">
                        + Add New Product
                    </button>
                </div>

                <!-- Product Table -->
                <table class="min-w-full border divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Product ID</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Stock</th>
                            <th class="px-4 py-2 text-left">Price</th>
                            <th class="px-4 py-2 text-left">Supplier Info</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-2 font-bold">PRD-001</td>
                            <td class="px-4 py-2">Wireless Mouse</td>
                            <td class="px-4 py-2"><span class="px-2 py-1 text-sm text-green-800 bg-green-100 rounded">45 units</span></td>
                            <td class="px-4 py-2">$15.00</td>
                            <td class="px-4 py-2">TechSupplies Ltd</td>
                            <td class="px-4 py-2 text-center">
                                <button class="text-blue-600 hover:underline me-2">Edit</button>
                                <button class="text-red-600 hover:underline">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>