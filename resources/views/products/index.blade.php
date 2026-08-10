@extends('layouts.app')

@section('header')
<h2 class="text-xl font-bold leading-tight text-gray-800">
    Products Management
</h2>
@endsection

@section('content')
<div class="min-h-screen py-8 bg-gray-50/50">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

        <!-- Header & Action Bar -->
        <div class="flex flex-col justify-between gap-4 p-6 mb-8 bg-white border border-gray-100 shadow-sm sm:flex-row sm:items-center rounded-2xl">
            <div>
                <h3 class="text-xl font-bold text-gray-900">All Products List</h3>
                <p class="text-sm text-gray-500 mt-0.5">Manage inventory, pricing, and suppliers</p>
            </div>
            <button class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-xl shadow-sm transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Product
            </button>
        </div>

        <!-- Product Table Container -->
        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50/50">
                            <th class="px-6 py-4">Product ID</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Stock</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Supplier Info</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        <tr class="transition-colors duration-150 hover:bg-gray-50/50">
                            <td class="px-6 py-4 font-mono font-semibold text-gray-900">PRD-001</td>
                            <td class="px-6 py-4 font-medium text-gray-900">Wireless Mouse</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    45 units
                                </span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">$15.00</td>
                            <td class="px-6 py-4 text-gray-500">TechSupplies Ltd</td>
                            <td class="px-6 py-4 space-x-2 text-center">
                                <button class="px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">Edit</button>
                                <button class="px-3 py-1.5 text-xs font-medium text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection