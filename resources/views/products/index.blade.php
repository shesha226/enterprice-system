@extends('layouts.app')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-lime-500">
            Vegetable Wholesale Management
        </h2>
        <p class="mt-1 text-sm text-slate-500">Products, stock, prices & suppliers</p>
    </div>

    <span class="items-center hidden gap-2 px-4 py-2 text-xs font-bold border rounded-full sm:flex bg-emerald-50 text-emerald-700 border-emerald-100">
        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
        Shop Active
    </span>
</div>
@endsection

@section('content')

<style>
    .page-bg {
        background:
            radial-gradient(circle at 0% 0%, rgba(16, 185, 129, .15), transparent 28%),
            radial-gradient(circle at 100% 100%, rgba(132, 204, 22, .12), transparent 28%),
            #f8fafc;
    }

    .card {
        background: rgba(255, 255, 255, .96);
        border: 1px solid #e2e8f0;
        box-shadow: 0 15px 40px rgba(15, 23, 42, .06);
    }

    .stat {
        transition: .25s;
    }

    .stat:hover {
        transform: translateY(-4px);
    }

    .toast {
        transform: translateX(130%);
        transition: .35s;
    }

    .toast.show {
        transform: translateX(0);
    }

    @media(max-width:640px) {
        .responsive-table thead {
            display: none;
        }

        .responsive-table,
        .responsive-table tbody,
        .responsive-table tr,
        .responsive-table td {
            display: block;
            width: 100%;
        }

        .responsive-table tr {
            padding: 18px;
            border-bottom: 1px solid #e2e8f0;
        }

        .responsive-table td {
            padding: 8px 0;
        }

        .responsive-table td:before {
            content: attr(data-label);
            display: block;
            font-size: 10px;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            margin-bottom: 3px;
        }
    }
</style>

<div class="min-h-screen py-8 page-bg">

    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

        {{-- ADD PRODUCT SECTION - PAGE TOP --}}
        <div class="p-6 mb-6 card rounded-3xl">

            <div class="flex flex-col justify-between gap-5 lg:flex-row lg:items-center">

                <div>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-12 h-12 text-2xl shadow-lg rounded-2xl bg-gradient-to-br from-emerald-500 to-lime-500">
                            🥬
                        </div>

                        <div>
                            <h3 class="text-xl font-extrabold text-slate-900">
                                Add New Vegetable
                            </h3>

                            <p class="text-sm text-slate-500">
                                Add your wholesale product to inventory
                            </p>
                        </div>
                    </div>
                </div>

                <button onclick="toggleAddForm()"
                    id="addBtn"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-white transition shadow-lg rounded-xl bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 shadow-emerald-500/20 active:scale-95">

                    <span class="text-xl">+</span>
                    Add Product

                </button>

            </div>

            {{-- ADD PRODUCT FORM --}}
            <div id="addForm"
                class="hidden pt-6 mt-6 border-t border-slate-100">

                <form id="productForm">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5">

                        <div>
                            <label class="block mb-2 text-xs font-bold text-slate-600">
                                Vegetable
                            </label>

                            <select id="name"
                                required
                                class="w-full px-4 py-3 bg-white border outline-none rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10">

                                <option value="">Select Product</option>
                                <option value="🥕 Carrot">🥕 Carrot</option>
                                <option value="🥔 Potato">🥔 Potato</option>
                                <option value="🍅 Tomato">🍅 Tomato</option>
                                <option value="🥬 Cabbage">🥬 Cabbage</option>
                                <option value="🫛 Beans">🫛 Beans</option>
                                <option value="🍆 Brinjal">🍆 Brinjal</option>
                                <option value="🎃 Pumpkin">🎃 Pumpkin</option>
                                <option value="🥒 Cucumber">🥒 Cucumber</option>
                                <option value="🌶️ Green Chilli">🌶️ Green Chilli</option>
                                <option value="🥬 Leeks">🥬 Leeks</option>
                                <option value="🧅 Big Onion">🧅 Big Onion</option>
                                <option value="🧄 Garlic">🧄 Garlic</option>

                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-xs font-bold text-slate-600">
                                Stock KG
                            </label>

                            <input id="stock"
                                type="number"
                                min="0"
                                step="0.01"
                                required
                                placeholder="500"
                                class="w-full px-4 py-3 border outline-none rounded-xl border-slate-200 focus:border-emerald-500">
                        </div>

                        <div>
                            <label class="block mb-2 text-xs font-bold text-slate-600">
                                Buy Price / KG
                            </label>

                            <input id="buy"
                                type="number"
                                min="0"
                                required
                                placeholder="150"
                                class="w-full px-4 py-3 border outline-none rounded-xl border-slate-200 focus:border-emerald-500">
                        </div>

                        <div>
                            <label class="block mb-2 text-xs font-bold text-slate-600">
                                Sell Price / KG
                            </label>

                            <input id="sell"
                                type="number"
                                min="0"
                                required
                                placeholder="190"
                                class="w-full px-4 py-3 border outline-none rounded-xl border-slate-200 focus:border-emerald-500">
                        </div>

                        <div>
                            <label class="block mb-2 text-xs font-bold text-slate-600">
                                Supplier
                            </label>

                            <input id="supplier"
                                type="text"
                                required
                                placeholder="Dambulla Supplier"
                                class="w-full px-4 py-3 border outline-none rounded-xl border-slate-200 focus:border-emerald-500">
                        </div>

                    </div>

                    <div class="flex justify-end gap-3 mt-5">

                        <button type="button"
                            onclick="clearForm()"
                            class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-bold">
                            Clear
                        </button>

                        <button type="submit"
                            class="px-7 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold shadow-lg">
                            ✓ Save Product
                        </button>

                    </div>

                </form>
            </div>
        </div>


        {{-- SUMMARY --}}
        <div class="grid grid-cols-1 gap-5 mb-6 sm:grid-cols-2 lg:grid-cols-4">

            <div class="p-5 card stat rounded-3xl">
                <p class="text-xs font-bold uppercase text-slate-400">
                    Products
                </p>

                <div class="flex items-center justify-between mt-3">

                    <h3 id="totalProducts"
                        class="text-3xl font-black text-slate-900">
                        0
                    </h3>

                    <div class="flex items-center justify-center w-12 h-12 text-2xl rounded-2xl bg-emerald-50">
                        🥦
                    </div>

                </div>
            </div>

            <div class="p-5 card stat rounded-3xl">
                <p class="text-xs font-bold uppercase text-slate-400">
                    Total Stock
                </p>

                <div class="flex items-center justify-between mt-3">

                    <h3 id="totalStock"
                        class="text-3xl font-black text-slate-900">
                        0 KG
                    </h3>

                    <div class="flex items-center justify-center w-12 h-12 text-2xl rounded-2xl bg-blue-50">
                        ⚖️
                    </div>

                </div>
            </div>

            <div class="p-5 card stat rounded-3xl">
                <p class="text-xs font-bold uppercase text-slate-400">
                    Low Stock
                </p>

                <div class="flex items-center justify-between mt-3">

                    <h3 id="lowStock"
                        class="text-3xl font-black text-orange-500">
                        0
                    </h3>

                    <div class="flex items-center justify-center w-12 h-12 text-2xl rounded-2xl bg-orange-50">
                        ⚠️
                    </div>

                </div>
            </div>

            <div class="p-5 card stat rounded-3xl">
                <p class="text-xs font-bold uppercase text-slate-400">
                    Inventory Value
                </p>

                <div class="flex items-center justify-between mt-3">

                    <h3 id="stockValue"
                        class="text-2xl font-black text-slate-900">
                        Rs. 0
                    </h3>

                    <div class="flex items-center justify-center w-12 h-12 text-2xl rounded-2xl bg-lime-50">
                        💰
                    </div>

                </div>
            </div>

        </div>


        {{-- PRODUCT LIST --}}
        <div class="overflow-hidden card rounded-3xl">

            <div class="p-6 border-b border-slate-100">

                <div class="flex flex-col justify-between gap-4 lg:flex-row lg:items-center">

                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900">
                            All Vegetable Products
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            Current inventory and wholesale pricing
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">

                        <input id="search"
                            type="text"
                            placeholder="🔍 Search product..."
                            class="px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-emerald-500 text-sm">

                        <select id="filter"
                            class="px-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-emerald-500 text-sm">

                            <option value="all">All Products</option>
                            <option value="available">Available</option>
                            <option value="low">Low Stock</option>
                            <option value="out">Out of Stock</option>

                        </select>

                    </div>

                </div>
            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-left responsive-table">

                    <thead>
                        <tr class="border-b bg-slate-50 border-slate-200">

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Product
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Stock
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Buy Price
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Sell Price
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase text-slate-400">
                                Supplier
                            </th>

                            <th class="px-6 py-4 text-xs font-bold text-center uppercase text-slate-400">
                                Actions
                            </th>

                        </tr>
                    </thead>

                    <tbody id="productTable"
                        class="divide-y divide-slate-100">
                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>


{{-- TOAST --}}
<div id="toast"
    class="fixed z-50 px-5 py-4 text-white shadow-2xl toast right-5 bottom-5 bg-slate-900 rounded-2xl">

    <div id="toastTitle"
        class="text-sm font-bold">
        Success
    </div>

    <div id="toastText"
        class="mt-1 text-xs text-slate-300">
        Product saved.
    </div>

</div>


<script>
    let products = [{
            id: 1,
            name: '🥕 Carrot',
            stock: 450,
            buy: 140,
            sell: 180,
            supplier: 'Dambulla Suppliers'
        },
        {
            id: 2,
            name: '🥔 Potato',
            stock: 850,
            buy: 175,
            sell: 220,
            supplier: 'Nuwara Eliya Traders'
        },
        {
            id: 3,
            name: '🍅 Tomato',
            stock: 120,
            buy: 120,
            sell: 160,
            supplier: 'Kandy Vegetable Centre'
        },
        {
            id: 4,
            name: '🥬 Cabbage',
            stock: 65,
            buy: 100,
            sell: 135,
            supplier: 'Nuwara Eliya Suppliers'
        }
    ];

    let nextId = 5;
    let editingId = null;

    function toggleAddForm() {

        const form = document.getElementById('addForm');
        const btn = document.getElementById('addBtn');

        form.classList.toggle('hidden');

        if (form.classList.contains('hidden')) {
            btn.innerHTML = '<span class="text-xl">+</span> Add Product';
        } else {
            btn.innerHTML = '✕ Close';
        }
    }

    document.getElementById('productForm').addEventListener('submit', function(e) {

        e.preventDefault();

        const name = document.getElementById('name').value;
        const stock = Number(document.getElementById('stock').value);
        const buy = Number(document.getElementById('buy').value);
        const sell = Number(document.getElementById('sell').value);
        const supplier = document.getElementById('supplier').value.trim();

        if (!name || stock < 0 || buy <= 0 || sell <= 0 || !supplier) {

            showToast(
                'Error',
                'Please fill all product details.'
            );

            return;
        }

        if (editingId) {

            const product = products.find(p => p.id === editingId);

            product.name = name;
            product.stock = stock;
            product.buy = buy;
            product.sell = sell;
            product.supplier = supplier;

            showToast(
                'Updated',
                'Product updated successfully.'
            );

            editingId = null;

        } else {

            products.unshift({
                id: nextId++,
                name: name,
                stock: stock,
                buy: buy,
                sell: sell,
                supplier: supplier
            });

            showToast(
                'Product Added',
                'New vegetable added successfully.'
            );
        }

        clearForm();
        renderProducts();
        updateSummary();

    });


    function renderProducts() {

        const table = document.getElementById('productTable');

        const search =
            document.getElementById('search')
            .value
            .toLowerCase();

        const filter =
            document.getElementById('filter')
            .value;

        const filtered = products.filter(product => {

            const matchesSearch =
                product.name.toLowerCase().includes(search) ||
                product.supplier.toLowerCase().includes(search);

            let matchesFilter = true;

            if (filter === 'available') {
                matchesFilter = product.stock > 100;
            }

            if (filter === 'low') {
                matchesFilter =
                    product.stock > 0 &&
                    product.stock <= 100;
            }

            if (filter === 'out') {
                matchesFilter = product.stock === 0;
            }

            return matchesSearch && matchesFilter;
        });

        table.innerHTML = '';

        if (filtered.length === 0) {

            table.innerHTML = `
            <tr>
                <td colspan="6"
                    class="py-16 text-center text-slate-400">

                    <div class="mb-3 text-5xl">
                        🥕
                    </div>

                    No products found.

                </td>
            </tr>
        `;

            return;
        }

        filtered.forEach(product => {

            let status = '';
            let statusClass = '';

            if (product.stock === 0) {

                status = 'Out of Stock';
                statusClass =
                    'bg-red-50 text-red-600 border-red-200';

            } else if (product.stock <= 100) {

                status = 'Low Stock';
                statusClass =
                    'bg-orange-50 text-orange-600 border-orange-200';

            } else {

                status = 'Available';
                statusClass =
                    'bg-emerald-50 text-emerald-600 border-emerald-200';
            }

            const emoji =
                product.name.split(' ')[0];

            const name =
                product.name.substring(
                    product.name.indexOf(' ') + 1
                );

            table.innerHTML += `

            <tr class="transition hover:bg-emerald-50/30">

                <td data-label="Product"
                    class="px-6 py-4">

                    <div class="flex items-center gap-3">

                        <div class="flex items-center justify-center text-2xl w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-50 to-lime-50">
                            ${emoji}
                        </div>

                        <div>

                            <div class="font-bold text-slate-800">
                                ${name}
                            </div>

                            <div class="font-mono text-xs text-slate-400">
                                VEG-${String(product.id).padStart(3,'0')}
                            </div>

                        </div>

                    </div>

                </td>


                <td data-label="Stock"
                    class="px-6 py-4">

                    <span class="inline-flex px-3 py-1.5 rounded-full border text-xs font-bold ${statusClass}">
                        ${product.stock.toLocaleString()} KG
                    </span>

                    <div class="text-[10px] text-slate-400 mt-1">
                        ${status}
                    </div>

                </td>


                <td data-label="Buy Price"
                    class="px-6 py-4">

                    <span class="font-semibold text-slate-600">
                        Rs. ${product.buy.toLocaleString()}
                    </span>

                    <div class="text-xs text-slate-400">
                        Per KG
                    </div>

                </td>


                <td data-label="Sell Price"
                    class="px-6 py-4">

                    <span class="font-bold text-emerald-600">
                        Rs. ${product.sell.toLocaleString()}
                    </span>

                    <div class="text-xs text-slate-400">
                        Per KG
                    </div>

                </td>


                <td data-label="Supplier"
                    class="px-6 py-4">

                    <div class="font-medium text-slate-700">
                        ${product.supplier}
                    </div>

                    <div class="text-xs text-slate-400">
                        Wholesale Supplier
                    </div>

                </td>


                <td data-label="Actions"
                    class="px-6 py-4">

                    <div class="flex justify-center gap-2">

                        <button
                            onclick="editProduct(${product.id})"
                            class="px-3 py-2 text-xs font-bold text-blue-600 rounded-xl bg-blue-50 hover:bg-blue-100">
                            Edit
                        </button>

                        <button
                            onclick="deleteProduct(${product.id})"
                            class="px-3 py-2 text-xs font-bold text-red-600 rounded-xl bg-red-50 hover:bg-red-100">
                            Delete
                        </button>

                    </div>

                </td>

            </tr>
        `;
        });
    }


    function editProduct(id) {

        const product =
            products.find(p => p.id === id);

        if (!product) return;

        editingId = id;

        document.getElementById('name').value =
            product.name;

        document.getElementById('stock').value =
            product.stock;

        document.getElementById('buy').value =
            product.buy;

        document.getElementById('sell').value =
            product.sell;

        document.getElementById('supplier').value =
            product.supplier;

        const form =
            document.getElementById('addForm');

        form.classList.remove('hidden');

        document.getElementById('addBtn').innerHTML =
            '✕ Close';

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

        showToast(
            'Edit Mode',
            'Update the product details and save.'
        );
    }


    function deleteProduct(id) {

        const product =
            products.find(p => p.id === id);

        if (!product) return;

        if (!confirm(
                `Are you sure you want to delete ${product.name}?`
            )) return;

        products =
            products.filter(p => p.id !== id);

        renderProducts();
        updateSummary();

        showToast(
            'Deleted',
            'Product removed successfully.'
        );
    }


    function clearForm() {

        document.getElementById('productForm').reset();

        editingId = null;
    }


    function updateSummary() {

        const totalProducts =
            products.length;

        const totalStock =
            products.reduce(
                (sum, p) => sum + p.stock,
                0
            );

        const lowStock =
            products.filter(
                p => p.stock > 0 && p.stock <= 100
            ).length;

        const value =
            products.reduce(
                (sum, p) => sum + (p.stock * p.buy),
                0
            );

        document.getElementById('totalProducts')
            .textContent = totalProducts;

        document.getElementById('totalStock')
            .textContent =
            totalStock.toLocaleString() + ' KG';

        document.getElementById('lowStock')
            .textContent = lowStock;

        document.getElementById('stockValue')
            .textContent =
            'Rs. ' + value.toLocaleString();
    }


    let toastTimer;

    function showToast(title, message) {

        const toast =
            document.getElementById('toast');

        document.getElementById('toastTitle')
            .textContent = title;

        document.getElementById('toastText')
            .textContent = message;

        toast.classList.add('show');

        clearTimeout(toastTimer);

        toastTimer = setTimeout(() => {

            toast.classList.remove('show');

        }, 3000);
    }


    document.getElementById('search')
        .addEventListener(
            'input',
            renderProducts
        );

    document.getElementById('filter')
        .addEventListener(
            'change',
            renderProducts
        );


    renderProducts();
    updateSummary();
</script>

@endsection