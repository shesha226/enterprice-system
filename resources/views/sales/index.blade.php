<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Point of Sale (POS)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Sales Form -->
                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <h3 class="mb-4 text-lg font-bold">New Transaction</h3>
                    <form>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Select Product</label>
                            <select class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                <option>Wireless Mouse ($15.00)</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Total Amount ($)</label>
                            <input type="number" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" placeholder="0.00">
                        </div>
                        <button type="button" class="w-full py-2 font-bold text-white bg-blue-600 rounded-md">Process Sale</button>
                    </form>
                </div>

                <!-- Recent Sales List -->
                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <h3 class="mb-4 text-lg font-bold">Recent Sales</h3>
                    <div class="flex items-center justify-between py-2 border-b">
                        <div>
                            <p class="font-bold">Sale #SALE-001</p>
                            <p class="text-xs text-gray-500">2026-08-04</p>
                        </div>
                        <span class="px-3 py-1 font-bold text-blue-800 bg-blue-100 rounded-full">$15.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>