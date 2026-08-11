@extends('layouts.app')

@section('header')
<h2 class="p-6 text-2xl font-normal leading-tight text-gray-800 bg-white border-b border-gray-100">
    Employee Management
</h2>
@endsection

@section('content')
<div class="min-h-screen py-12 bg-gray-100/50">
    <div class="px-6 mx-auto max-w-7xl">

        <div class="p-10 mb-10 text-center bg-white border border-gray-100 shadow-sm rounded-xl">
            <div>
                <h3 class="text-xl font-medium text-gray-900">Daily Attendance Log</h3>
                <p class="mt-2 text-sm text-gray-500">Track employee check-ins, check-outs, and work status</p>
            </div>

            <button class="inline-flex items-center justify-center gap-2 px-5 py-2.5 mt-6 text-sm font-medium text-white transition-all duration-200 bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Mark Attendance
            </button>
        </div>

        <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs font-medium tracking-wider text-gray-500 uppercase border-b border-gray-100 bg-gray-50/50">
                            <th class="px-10 py-5">Employee ID</th>
                            <th class="px-10 py-5">Name</th>
                            <th class="px-10 py-5">Check In</th>
                            <th class="px-10 py-5">Check Out</th>
                            <th class="px-10 py-5">Status</th>
                            <th class="px-10 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        <tr class="transition-colors duration-150 hover:bg-gray-50/50">
                            <td class="px-10 py-5 font-medium text-gray-900">EMP-001</td>
                            <td class="px-10 py-5 text-gray-900">John Doe</td>
                            <td class="px-10 py-5 text-gray-600">08:30 AM</td>
                            <td class="px-10 py-5 text-gray-600">05:00 PM</td>
                            <td class="px-10 py-5">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    Present
                                </span>
                            </td>
                            <td class="px-10 py-5 space-x-4 text-right">
                                <button class="text-sm font-medium text-gray-700 hover:text-blue-600">Edit</button>
                                <button class="text-sm font-medium text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection