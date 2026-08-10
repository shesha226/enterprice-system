@extends('layouts.app')

@section('header')
<h2 class="text-xl font-bold leading-tight text-gray-800">
    Employee Management
</h2>
@endsection

@section('content')
<div class="min-h-screen py-8 bg-gray-50/50">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

        <!-- Header & Action Bar -->
        <div class="flex flex-col justify-between gap-4 p-6 mb-8 bg-white border border-gray-100 shadow-sm sm:flex-row sm:items-center rounded-2xl">
            <div>
                <h3 class="text-xl font-bold text-gray-900">Employee Directory</h3>
                <p class="text-sm text-gray-500 mt-0.5">Manage team members and their details</p>
            </div>
            <button class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-xl shadow-sm transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Register Employee
            </button>
        </div>

        <!-- Employee Cards Grid -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Sample Card -->
            <div class="p-6 transition-all duration-300 bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center justify-center w-12 h-12 text-lg font-bold text-indigo-600 bg-indigo-50 rounded-xl">
                        JD
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold text-green-700 border border-green-200 rounded-full bg-green-50">
                        Active
                    </span>
                </div>

                <h4 class="text-lg font-bold text-gray-900">John Doe</h4>
                <p class="text-xs font-mono text-gray-400 mt-0.5">ID: EMP-101</p>

                <div class="pt-4 mt-4 space-y-2 text-sm text-gray-600 border-t border-gray-100">
                    <div class="flex justify-between"><span class="text-gray-400">Age</span> <span class="font-medium text-gray-800">28</span></div>
                    <div class="flex justify-between"><span class="text-gray-400">Location</span> <span class="font-medium text-gray-800">Colombo, LK</span></div>
                    <div class="flex justify-between"><span class="text-gray-400">Salary</span> <span class="font-semibold text-gray-900">$1,200.00</span></div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection