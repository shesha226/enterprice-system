@extends('layouts.app')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-lime-500">
            Today's Vegetable Sales
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Wholesale sales management
        </p>
    </div>

    <span class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 text-xs font-bold">
        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
        Today
    </span>
</div>
@endsection


@section('content')

<style>
    .sales-page {
        background:
            radial-gradient(circle at top left, rgba(16, 185, 129, .10), transparent 30%),
            radial-gradient(circle at bottom right, rgba(132, 204, 22, .08), transparent 30%),
            #f8fafc;
    }

    .card {
        background: rgba(255, 255, 255, .94);
        border: 1px solid #e2e8f0;
        backdrop-filter: blur(15px);
    }

    .stat {
        transition: .25s ease;
    }

    .stat:hover {
        transform: translateY(-4px);
    }

    .modal {
        opacity: 0;
        visibility: hidden;
        transition: .25s ease;
    }

    .modal.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-box {
        transform: translateY(20px) scale(.96);
        transition: .25s ease;
    }

    .modal.active .modal-box {
        transform: translateY(0) scale(1);
    }

    .toast {
        transform: translateX(120%);
        transition: .35s ease;
    }

    .toast.show {
        transform: translateX(0);
    }

    @media(max-width:640px) {
        .sales-table thead {
            display: none;
        }

        .sales-table,
        .sales-table tbody,
        .sales-table tr,
        .sales-table td {
            display: block;
            width: 100%;
        }

        .sales-table tr {
            padding: 18px;
            border-bottom: 1px solid #e2e8f0;
        }

        .sales-table td {
            padding: 7px 0;
        }

        .sales-table td[data-label]::before {
            content: attr(data-label);
            display: block;
            font-size: 10px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            margin-bottom: 3px;
        }
    }
</style>


<div class="min-h-screen py-8 sales-page">

    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

        {{-- =========================
         SALES HEADER
    ========================== --}}

        <div class="flex flex-col items-start justify-between gap-4 p-6 mb-8 bg-white border shadow-xl sm:flex-row sm:items-center border-slate-100 shadow-slate-200/50 rounded-2xl">
            <!-- Title & Subtitle -->
            <div>
                <h3 class="text-2xl font-extrabold tracking-tight text-slate-900">Today's Sales</h3>
                <p class="mt-1 text-sm font-medium text-slate-500">All vegetable wholesale sales made today</p>
            </div>

            <!-- Action Button -->
            <button
                onclick="openSaleModal()"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-white transition-all shadow-lg cursor-pointer rounded-xl bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 shadow-emerald-500/20 active:scale-95">

                <span class="text-xl font-bold leading-none">+</span>
                <span>Add Sale</span>
            </button>
        </div>
        {{-- =========================
         TODAY SUMMARY
    ========================== --}}

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-7">

            <div class="p-5 shadow-sm stat card rounded-3xl">
                <p class="text-xs font-bold uppercase text-slate-400">
                    Today's Sales
                </p>

                <div class="flex items-center justify-between mt-2">
                    <h3 id="totalSales"
                        class="text-2xl font-extrabold text-slate-900">
                        Rs. 0.00
                    </h3>

                    <div class="flex items-center justify-center w-12 h-12 text-2xl rounded-2xl bg-emerald-50">
                        💰
                    </div>
                </div>
            </div>


            <div class="p-5 shadow-sm stat card rounded-3xl">
                <p class="text-xs font-bold uppercase text-slate-400">
                    Total Orders
                </p>

                <div class="flex items-center justify-between mt-2">
                    <h3 id="totalOrders"
                        class="text-2xl font-extrabold text-slate-900">
                        0
                    </h3>

                    <div class="flex items-center justify-center w-12 h-12 text-2xl rounded-2xl bg-blue-50">
                        🧾
                    </div>
                </div>
            </div>


            <div class="p-5 shadow-sm stat card rounded-3xl">
                <p class="text-xs font-bold uppercase text-slate-400">
                    Total KG Sold
                </p>

                <div class="flex items-center justify-between mt-2">
                    <h3 id="totalKg"
                        class="text-2xl font-extrabold text-slate-900">
                        0 KG
                    </h3>

                    <div class="flex items-center justify-center w-12 h-12 text-2xl rounded-2xl bg-lime-50">
                        ⚖️
                    </div>
                </div>
            </div>


            <div class="p-5 shadow-sm stat card rounded-3xl">
                <p class="text-xs font-bold uppercase text-slate-400">
                    Credit Sales
                </p>

                <div class="flex items-center justify-between mt-2">
                    <h3 id="creditSales"
                        class="text-2xl font-extrabold text-slate-900">
                        Rs. 0.00
                    </h3>

                    <div class="flex items-center justify-center w-12 h-12 text-2xl rounded-2xl bg-orange-50">
                        💳
                    </div>
                </div>
            </div>

        </div>





        {{-- =========================
         SALES TABLE
    ========================== --}}

        <div class="overflow-hidden shadow-xl card rounded-3xl shadow-slate-200/40">

            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/70">

                <div class="relative max-w-sm">

                    <span class="absolute -translate-y-1/2 left-3 top-1/2">
                        🔍
                    </span>

                    <input
                        id="searchSale"
                        type="text"
                        placeholder="Search customer or vegetable..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-white text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">

                </div>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left sales-table">

                    <thead>

                        <tr class="border-b bg-slate-50 border-slate-200">

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Invoice
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Customer
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Vegetable
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Quantity
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Price / KG
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Total
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Payment
                            </th>

                            <th class="px-6 py-4 text-xs font-bold text-center uppercase text-slate-400">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody id="salesBody"
                        class="text-sm divide-y divide-slate-100">

                        {{-- SALES WILL BE ADDED HERE --}}

                    </tbody>

                </table>


                <div id="emptySales"
                    class="py-16 text-center">

                    <div class="mb-4 text-5xl">
                        🥕
                    </div>

                    <h3 class="font-bold text-slate-700">
                        No sales today
                    </h3>

                    <p class="mt-1 text-sm text-slate-400">
                        Click "Add Sale" to create your first sale.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================
     ADD SALE MODAL
========================== --}}

<div id="saleModal"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 modal bg-slate-950/50 backdrop-blur-sm">

    <div class="w-full max-w-lg overflow-hidden bg-white shadow-2xl modal-box rounded-3xl">


        <div class="flex items-center justify-between p-6 border-b border-slate-100">

            <div>
                <h3 class="text-lg font-bold text-slate-900">
                    Add New Sale
                </h3>

                <p class="mt-1 text-xs text-slate-400">
                    Add today's vegetable wholesale sale
                </p>
            </div>

            <button
                onclick="closeSaleModal()"
                class="text-xl w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-500">
                &times;
            </button>

        </div>


        <form id="saleForm"
            class="p-6 space-y-5">


            {{-- CUSTOMER --}}

            <div>

                <label class="block mb-2 text-xs font-bold text-slate-600">
                    Customer / Shop
                </label>

                <input
                    id="customer"
                    type="text"
                    required
                    placeholder="Ex: Sunil Traders"
                    class="w-full px-4 py-3 border outline-none rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">

            </div>


            {{-- VEGETABLE --}}

            <div>

                <label class="block mb-2 text-xs font-bold text-slate-600">
                    Vegetable
                </label>

                <select
                    id="vegetable"
                    required
                    class="w-full px-4 py-3 border outline-none rounded-xl border-slate-200 focus:border-emerald-500">

                    <option value="">
                        Select Vegetable
                    </option>

                    <option>🥕 Carrot</option>
                    <option>🥔 Potato</option>
                    <option>🍅 Tomato</option>
                    <option>🥬 Cabbage</option>
                    <option>🫛 Beans</option>
                    <option>🍆 Brinjal</option>
                    <option>🎃 Pumpkin</option>
                    <option>🥒 Cucumber</option>
                    <option>🌶️ Green Chilli</option>
                    <option>🥬 Leeks</option>
                    <option>🧅 Big Onion</option>
                    <option>🧄 Garlic</option>

                </select>

            </div>


            {{-- QUANTITY / PRICE --}}

            <div class="grid grid-cols-2 gap-4">

                <div>

                    <label class="block mb-2 text-xs font-bold text-slate-600">
                        Quantity
                    </label>

                    <div class="flex">

                        <input
                            id="quantity"
                            type="number"
                            min="0.01"
                            step="0.01"
                            required
                            placeholder="0"
                            class="w-full px-4 py-3 border outline-none rounded-l-xl border-slate-200 focus:border-emerald-500">

                        <span class="flex items-center px-4 text-sm font-bold border border-l-0 bg-slate-100 border-slate-200 rounded-r-xl text-slate-500">
                            KG
                        </span>

                    </div>

                </div>


                <div>

                    <label class="block mb-2 text-xs font-bold text-slate-600">
                        Price / KG
                    </label>

                    <input
                        id="price"
                        type="number"
                        min="0"
                        step="0.01"
                        required
                        placeholder="Rs. 0"
                        class="w-full px-4 py-3 border outline-none rounded-xl border-slate-200 focus:border-emerald-500">

                </div>

            </div>


            {{-- TOTAL --}}

            <div class="p-5 border rounded-2xl bg-gradient-to-r from-emerald-50 to-lime-50 border-emerald-100">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold uppercase text-slate-400">
                            Sale Total
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            Quantity × Price
                        </p>

                    </div>

                    <strong
                        id="modalTotal"
                        class="text-2xl text-emerald-600">
                        Rs. 0.00
                    </strong>

                </div>

            </div>


            {{-- PAYMENT --}}

            <div>

                <label class="block mb-2 text-xs font-bold text-slate-600">
                    Payment Method
                </label>

                <select
                    id="payment"
                    class="w-full px-4 py-3 border outline-none rounded-xl border-slate-200 focus:border-emerald-500">

                    <option value="Cash">
                        💵 Cash
                    </option>

                    <option value="Credit">
                        💳 Credit
                    </option>

                    <option value="Bank">
                        🏦 Bank Transfer
                    </option>

                </select>

            </div>


            {{-- BUTTONS --}}

            <div class="flex justify-end gap-3 pt-2">

                <button
                    type="button"
                    onclick="closeSaleModal()"
                    class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-600 font-semibold text-sm hover:bg-slate-200">
                    Cancel
                </button>

                <button
                    type="submit"
                    class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-green-600 text-white font-bold text-sm shadow-lg active:scale-95">
                    Save Sale
                </button>

            </div>

        </form>

    </div>

</div>


{{-- =========================
     TOAST
========================== --}}

<div id="toast"
    class="toast fixed right-5 bottom-5 z-[70] bg-slate-900 text-white rounded-2xl shadow-2xl px-5 py-4">

    <div class="text-sm font-bold"
        id="toastTitle">
        Sale Added
    </div>

    <div class="mt-1 text-xs text-slate-300"
        id="toastMessage">
        Sale saved successfully.
    </div>

</div>


<script>
    /* =========================
       DATA
    ========================== */

    let sales = [];

    let invoiceNumber = 1001;


    /* =========================
       ELEMENTS
    ========================== */

    const modal =
        document.getElementById('saleModal');

    const form =
        document.getElementById('saleForm');

    const quantity =
        document.getElementById('quantity');

    const price =
        document.getElementById('price');

    const modalTotal =
        document.getElementById('modalTotal');


    /* =========================
       MODAL
    ========================== */

    function openSaleModal() {

        modal.classList.add('active');

        document.body.classList.add('overflow-hidden');

        setTimeout(() => {
            document.getElementById('customer').focus();
        }, 200);
    }


    function closeSaleModal() {

        modal.classList.remove('active');

        document.body.classList.remove('overflow-hidden');

        form.reset();

        modalTotal.textContent = 'Rs. 0.00';
    }


    modal.addEventListener('click', function(e) {

        if (e.target === modal) {
            closeSaleModal();
        }

    });


    document.addEventListener('keydown', function(e) {

        if (
            e.key === 'Escape' &&
            modal.classList.contains('active')
        ) {
            closeSaleModal();
        }

    });


    /* =========================
       CALCULATE TOTAL
    ========================== */

    function calculateTotal() {

        const kg =
            Number(quantity.value) || 0;

        const rate =
            Number(price.value) || 0;

        const total =
            kg * rate;

        modalTotal.textContent =
            'Rs. ' +
            total.toLocaleString('en-LK', {
                minimumFractionDigits: 2
            });
    }


    quantity.addEventListener(
        'input',
        calculateTotal
    );

    price.addEventListener(
        'input',
        calculateTotal
    );


    /* =========================
       ADD SALE
    ========================== */

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        const customer =
            document.getElementById('customer')
            .value.trim();

        const vegetable =
            document.getElementById('vegetable')
            .value;

        const kg =
            Number(quantity.value);

        const rate =
            Number(price.value);

        const payment =
            document.getElementById('payment')
            .value;

        if (
            !customer ||
            !vegetable ||
            !kg ||
            !rate
        ) {

            showToast(
                'Error',
                'Please fill all fields.'
            );

            return;
        }


        const total =
            kg * rate;


        const sale = {

            id: invoiceNumber++,

            customer: customer,

            vegetable: vegetable,

            kg: kg,

            rate: rate,

            total: total,

            payment: payment,

            time: new Date().toLocaleTimeString(
                'en-LK', {
                    hour: '2-digit',
                    minute: '2-digit'
                }
            )

        };


        sales.unshift(sale);


        renderSales();

        updateSummary();

        closeSaleModal();


        showToast(
            'Sale Added',
            `${vegetable} sale added successfully.`
        );

    });


    /* =========================
       RENDER TABLE
    ========================== */

    function renderSales() {

        const tbody =
            document.getElementById('salesBody');

        const empty =
            document.getElementById('emptySales');


        tbody.innerHTML = '';


        if (sales.length === 0) {

            empty.classList.remove('hidden');

            return;

        }


        empty.classList.add('hidden');


        sales.forEach((sale, index) => {

            const row =
                document.createElement('tr');

            row.className =
                'hover:bg-emerald-50/50 transition';


            row.innerHTML = `

                <td data-label="Invoice"
                    class="px-6 py-4">

                    <div class="font-bold text-emerald-600">
                        #VS-${sale.id}
                    </div>

                    <div class="mt-1 text-xs text-slate-400">
                        ${sale.time}
                    </div>

                </td>


                <td data-label="Customer"
                    class="px-6 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex items-center justify-center w-10 h-10 font-bold text-white rounded-xl bg-gradient-to-br from-emerald-500 to-green-600">

                            ${getInitials(sale.customer)}

                        </div>

                        <div>

                            <div class="font-semibold text-slate-800">
                                ${sale.customer}
                            </div>

                            <div class="text-xs text-slate-400">
                                Wholesale Customer
                            </div>

                        </div>

                    </div>

                </td>


                <td data-label="Vegetable"
                    class="px-6 py-4">

                    <span class="font-semibold text-slate-700">
                        ${sale.vegetable}
                    </span>

                </td>


                <td data-label="Quantity"
                    class="px-6 py-4">

                    <span class="font-bold text-slate-800">
                        ${sale.kg.toLocaleString()} KG
                    </span>

                </td>


                <td data-label="Price / KG"
                    class="px-6 py-4">

                    <span class="text-slate-600">
                        Rs. ${sale.rate.toLocaleString()}
                    </span>

                </td>


                <td data-label="Total"
                    class="px-6 py-4">

                    <span class="font-extrabold text-slate-900">
                        Rs. ${sale.total.toLocaleString('en-LK', {
                            minimumFractionDigits: 2
                        })}
                    </span>

                </td>


                <td data-label="Payment"
                    class="px-6 py-4">

                    <span class="
                        inline-flex px-3 py-1.5
                        rounded-full text-xs font-bold
                        ${sale.payment === 'Credit'
                            ? 'bg-orange-50 text-orange-600'
                            : sale.payment === 'Bank'
                                ? 'bg-blue-50 text-blue-600'
                                : 'bg-emerald-50 text-emerald-600'
                        }
                    ">

                        ${sale.payment}

                    </span>

                </td>


                <td data-label="Action"
                    class="px-6 py-4">

                    <div class="flex justify-center gap-2">

                        <button
                            onclick="deleteSale(${index})"
                            class="px-3 py-2 text-xs font-bold text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl">

                            Delete

                        </button>

                    </div>

                </td>
            `;


            tbody.appendChild(row);

        });

    }


    /* =========================
       SUMMARY
    ========================== */

    function updateSummary() {

        const total =
            sales.reduce(
                (sum, sale) =>
                sum + sale.total,
                0
            );


        const kg =
            sales.reduce(
                (sum, sale) =>
                sum + sale.kg,
                0
            );


        const credit =
            sales
            .filter(
                sale =>
                sale.payment === 'Credit'
            )
            .reduce(
                (sum, sale) =>
                sum + sale.total,
                0
            );


        document.getElementById(
                'totalSales'
            ).textContent =
            'Rs. ' +
            total.toLocaleString(
                'en-LK', {
                    minimumFractionDigits: 2
                }
            );


        document.getElementById(
                'totalOrders'
            ).textContent =
            sales.length;


        document.getElementById(
                'totalKg'
            ).textContent =
            kg.toLocaleString() + ' KG';


        document.getElementById(
                'creditSales'
            ).textContent =
            'Rs. ' +
            credit.toLocaleString(
                'en-LK', {
                    minimumFractionDigits: 2
                }
            );

    }


    /* =========================
       DELETE
    ========================== */

    function deleteSale(index) {

        if (
            !confirm(
                'Are you sure you want to delete this sale?'
            )
        ) {
            return;
        }


        sales.splice(index, 1);


        renderSales();

        updateSummary();


        showToast(
            'Sale Deleted',
            'Sale removed successfully.'
        );

    }


    /* =========================
       SEARCH
    ========================== */

    document.getElementById(
        'searchSale'
    ).addEventListener(
        'input',
        function() {

            const search =
                this.value.toLowerCase().trim();


            const rows =
                document.querySelectorAll(
                    '#salesBody tr'
                );


            rows.forEach(row => {

                row.style.display =
                    row.innerText
                    .toLowerCase()
                    .includes(search) ?
                    '' :
                    'none';

            });

        }
    );


    /* =========================
       INITIALS
    ========================== */

    function getInitials(name) {

        return name
            .split(' ')
            .slice(0, 2)
            .map(word => word.charAt(0))
            .join('')
            .toUpperCase();

    }


    /* =========================
       TOAST
    ========================== */

    let toastTimer;


    function showToast(title, message) {

        const toast =
            document.getElementById('toast');


        document.getElementById(
            'toastTitle'
        ).textContent = title;


        document.getElementById(
            'toastMessage'
        ).textContent = message;


        toast.classList.add('show');


        clearTimeout(toastTimer);


        toastTimer =
            setTimeout(() => {

                toast.classList.remove('show');

            }, 3000);

    }


    /* =========================
       DEMO SALES
    ========================== */

    sales = [

        {
            id: 1003,
            customer: 'Sunil Traders',
            vegetable: '🥕 Carrot',
            kg: 250,
            rate: 180,
            total: 45000,
            payment: 'Cash',
            time: '08:45 AM'
        },

        {
            id: 1002,
            customer: 'Kandy Wholesale',
            vegetable: '🥔 Potato',
            kg: 500,
            rate: 220,
            total: 110000,
            payment: 'Credit',
            time: '09:20 AM'
        },

        {
            id: 1001,
            customer: 'City Vegetable Shop',
            vegetable: '🍅 Tomato',
            kg: 150,
            rate: 160,
            total: 24000,
            payment: 'Bank',
            time: '10:05 AM'
        }

    ];


    invoiceNumber = 1004;


    renderSales();

    updateSummary();
</script>

@endsection