@extends('layouts.app')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500">
            Employee Management
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            Manage employees, departments and staff details
        </p>
    </div>

    <span class="items-center hidden gap-2 px-4 py-2 text-xs font-bold text-indigo-600 border border-indigo-100 rounded-full sm:inline-flex bg-indigo-50">
        <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
        Employee Directory
    </span>
</div>
@endsection

@section('content')

<style>
    .employee-page {
        min-height: 100vh;
        background:
            radial-gradient(circle at 0% 0%, rgba(99, 102, 241, .14), transparent 28%),
            radial-gradient(circle at 100% 100%, rgba(236, 72, 153, .12), transparent 28%),
            #f8fafc;
    }

    .glass-card {
        background: rgba(255, 255, 255, .94);
        border: 1px solid rgba(226, 232, 240, .8);
        box-shadow: 0 15px 40px rgba(15, 23, 42, .06);
        backdrop-filter: blur(12px);
    }

    .employee-card {
        transition: all .3s ease;
        animation: cardIn .45s ease both;
    }

    .employee-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 25px 50px rgba(15, 23, 42, .12);
    }

    @keyframes cardIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal {
        opacity: 0;
        visibility: hidden;
        transition: .25s ease;
    }

    .modal.show {
        opacity: 1;
        visibility: visible;
    }

    .modal-box {
        transform: scale(.94) translateY(20px);
        transition: .25s ease;
    }

    .modal.show .modal-box {
        transform: scale(1) translateY(0);
    }

    .custom-input {
        transition: .2s ease;
    }

    .custom-input:focus {
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .1);
    }

    .toast {
        transform: translateX(130%);
        transition: .35s ease;
    }

    .toast.show {
        transform: translateX(0);
    }
</style>


<div class="py-8 employee-page">

    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

        <!-- MAIN HEADER -->
        <div class="p-6 glass-card mb-7 rounded-3xl">

            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-4">

                    <div class="flex items-center justify-center text-2xl text-white shadow-lg w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600">
                        👨‍💼
                    </div>

                    <div>
                        <h3 class="text-xl font-extrabold text-gray-900">
                            Employee Directory
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Register and manage your employees
                        </p>
                    </div>

                </div>

                <button
                    type="button"
                    onclick="openEmployeeModal()"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 active:scale-95">

                    <span class="text-xl leading-none">+</span>
                    Register Employee

                </button>

            </div>

        </div>


        <!-- STATISTICS -->
        <div class="grid grid-cols-1 gap-5 mb-7 sm:grid-cols-2 lg:grid-cols-4">

            <div class="p-5 glass-card rounded-3xl">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-bold tracking-wider text-gray-400 uppercase">
                            Total Employees
                        </p>

                        <h3 id="totalEmployees"
                            class="mt-2 text-3xl font-black text-gray-900">
                            0
                        </h3>

                        <p class="mt-1 text-xs text-indigo-500">
                            All employees
                        </p>
                    </div>

                    <div class="flex items-center justify-center w-12 h-12 text-xl bg-indigo-50 rounded-2xl">
                        👥
                    </div>

                </div>
            </div>


            <div class="p-5 glass-card rounded-3xl">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-bold tracking-wider text-gray-400 uppercase">
                            Active
                        </p>

                        <h3 id="activeEmployees"
                            class="mt-2 text-3xl font-black text-emerald-600">
                            0
                        </h3>

                        <p class="mt-1 text-xs text-emerald-500">
                            Currently active
                        </p>
                    </div>

                    <div class="flex items-center justify-center w-12 h-12 text-xl bg-emerald-50 rounded-2xl">
                        ✓
                    </div>

                </div>
            </div>


            <div class="p-5 glass-card rounded-3xl">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-bold tracking-wider text-gray-400 uppercase">
                            Inactive
                        </p>

                        <h3 id="inactiveEmployees"
                            class="mt-2 text-3xl font-black text-red-500">
                            0
                        </h3>

                        <p class="mt-1 text-xs text-red-500">
                            Currently inactive
                        </p>
                    </div>

                    <div class="flex items-center justify-center w-12 h-12 text-xl bg-red-50 rounded-2xl">
                        ×
                    </div>

                </div>
            </div>


            <div class="p-5 glass-card rounded-3xl">
                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-xs font-bold tracking-wider text-gray-400 uppercase">
                            Departments
                        </p>

                        <h3 id="departmentCount"
                            class="mt-2 text-3xl font-black text-purple-600">
                            0
                        </h3>

                        <p class="mt-1 text-xs text-purple-500">
                            Total departments
                        </p>
                    </div>

                    <div class="flex items-center justify-center w-12 h-12 text-xl bg-purple-50 rounded-2xl">
                        🏢
                    </div>

                </div>
            </div>

        </div>


        <!-- SEARCH AREA -->
        <div class="p-5 glass-card mb-7 rounded-3xl">

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div>
                    <h3 class="font-extrabold text-gray-900">
                        All Employees
                    </h3>

                    <p class="mt-1 text-xs text-gray-400">
                        Search and manage employee records
                    </p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">

                    <div class="relative">

                        <span class="absolute text-gray-400 -translate-y-1/2 left-3 top-1/2">
                            🔍
                        </span>

                        <input
                            id="searchEmployee"
                            type="text"
                            placeholder="Search employee..."
                            class="w-full py-3 pl-10 pr-4 text-sm border border-gray-200 outline-none custom-input bg-gray-50 rounded-xl sm:w-64 focus:bg-white focus:border-indigo-500">

                    </div>


                    <select
                        id="statusFilter"
                        class="px-4 py-3 text-sm border border-gray-200 outline-none custom-input bg-gray-50 rounded-xl focus:bg-white focus:border-indigo-500">

                        <option value="all">All Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>

                    </select>

                </div>

            </div>

        </div>


        <!-- EMPLOYEE LIST -->
        <div
            id="employeeGrid"
            class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        </div>

    </div>

</div>


<!-- REGISTER / EDIT MODAL -->
<div
    id="employeeModal"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 modal bg-slate-950/60 backdrop-blur-sm">

    <div class="w-full max-w-xl bg-white shadow-2xl modal-box p-7 rounded-3xl">

        <div class="flex items-center justify-between pb-5 mb-6 border-b border-gray-100">

            <div>
                <h3
                    id="modalTitle"
                    class="text-xl font-extrabold text-gray-900">
                    Register Employee
                </h3>

                <p class="mt-1 text-xs text-gray-400">
                    Enter employee information below
                </p>
            </div>

            <button
                type="button"
                onclick="closeEmployeeModal()"
                class="flex items-center justify-center w-10 h-10 text-gray-500 transition bg-gray-100 rounded-xl hover:bg-gray-200">

                ✕

            </button>

        </div>


        <form id="employeeForm">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                <div class="sm:col-span-2">

                    <label class="block mb-2 text-xs font-bold text-gray-600">
                        Full Name
                    </label>

                    <input
                        id="employeeName"
                        type="text"
                        required
                        placeholder="John Doe"
                        class="w-full px-4 py-3 text-sm border border-gray-200 outline-none custom-input bg-gray-50 rounded-xl focus:bg-white focus:border-indigo-500">

                </div>


                <div>

                    <label class="block mb-2 text-xs font-bold text-gray-600">
                        Age
                    </label>

                    <input
                        id="employeeAge"
                        type="number"
                        min="18"
                        max="70"
                        required
                        placeholder="28"
                        class="w-full px-4 py-3 text-sm border border-gray-200 outline-none custom-input bg-gray-50 rounded-xl focus:bg-white focus:border-indigo-500">

                </div>


                <div>

                    <label class="block mb-2 text-xs font-bold text-gray-600">
                        Phone
                    </label>

                    <input
                        id="employeePhone"
                        type="text"
                        required
                        placeholder="0771234567"
                        class="w-full px-4 py-3 text-sm border border-gray-200 outline-none custom-input bg-gray-50 rounded-xl focus:bg-white focus:border-indigo-500">

                </div>


                <div>

                    <label class="block mb-2 text-xs font-bold text-gray-600">
                        Location
                    </label>

                    <input
                        id="employeeLocation"
                        type="text"
                        required
                        placeholder="Colombo"
                        class="w-full px-4 py-3 text-sm border border-gray-200 outline-none custom-input bg-gray-50 rounded-xl focus:bg-white focus:border-indigo-500">

                </div>


                <div>

                    <label class="block mb-2 text-xs font-bold text-gray-600">
                        Department
                    </label>

                    <select
                        id="employeeDepartment"
                        required
                        class="w-full px-4 py-3 text-sm border border-gray-200 outline-none custom-input bg-gray-50 rounded-xl focus:bg-white focus:border-indigo-500">

                        <option value="">Select Department</option>
                        <option>Management</option>
                        <option>Sales</option>
                        <option>Accounts</option>
                        <option>Warehouse</option>
                        <option>Delivery</option>

                    </select>

                </div>


                <div>

                    <label class="block mb-2 text-xs font-bold text-gray-600">
                        Salary
                    </label>

                    <input
                        id="employeeSalary"
                        type="number"
                        required
                        placeholder="75000"
                        class="w-full px-4 py-3 text-sm border border-gray-200 outline-none custom-input bg-gray-50 rounded-xl focus:bg-white focus:border-indigo-500">

                </div>


                <div>

                    <label class="block mb-2 text-xs font-bold text-gray-600">
                        Status
                    </label>

                    <select
                        id="employeeStatus"
                        class="w-full px-4 py-3 text-sm border border-gray-200 outline-none custom-input bg-gray-50 rounded-xl focus:bg-white focus:border-indigo-500">

                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>

                    </select>

                </div>

            </div>


            <div class="flex justify-end gap-3 mt-7">

                <button
                    type="button"
                    onclick="closeEmployeeModal()"
                    class="px-5 py-3 text-sm font-bold text-gray-600 transition bg-gray-100 rounded-xl hover:bg-gray-200">

                    Cancel

                </button>

                <button
                    id="saveButton"
                    type="submit"
                    class="px-6 py-3 text-sm font-bold text-white transition shadow-lg rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700">

                    Save Employee

                </button>

            </div>

        </form>

    </div>

</div>


<!-- TOAST -->
<div
    id="toast"
    class="toast fixed right-5 bottom-5 z-[60] min-w-[300px] p-4 text-white bg-gray-900 shadow-2xl rounded-2xl">

    <div class="flex items-center gap-3">

        <div class="flex items-center justify-center w-10 h-10 bg-emerald-500 rounded-xl">
            ✓
        </div>

        <div>
            <p
                id="toastTitle"
                class="text-sm font-bold">
                Success
            </p>

            <p
                id="toastMessage"
                class="mt-1 text-xs text-gray-300">
                Done successfully.
            </p>
        </div>

    </div>

</div>


<script>
    let employees = [

        {
            id: 101,
            name: "John Doe",
            age: 28,
            phone: "0771234567",
            location: "Colombo, LK",
            department: "Management",
            salary: 120000,
            status: "Active"
        },

        {
            id: 102,
            name: "Kasun Perera",
            age: 31,
            phone: "0712345678",
            location: "Gampaha, LK",
            department: "Sales",
            salary: 85000,
            status: "Active"
        },

        {
            id: 103,
            name: "Nimal Silva",
            age: 26,
            phone: "0761234567",
            location: "Negombo, LK",
            department: "Warehouse",
            salary: 70000,
            status: "Inactive"
        }

    ];

    let editId = null;


    function renderEmployees() {

        const grid =
            document.getElementById("employeeGrid");

        const search =
            document
            .getElementById("searchEmployee")
            .value
            .toLowerCase()
            .trim();

        const filter =
            document
            .getElementById("statusFilter")
            .value;


        const filtered =
            employees.filter(employee => {

                const matchesSearch =
                    employee.name.toLowerCase().includes(search) ||
                    employee.phone.toLowerCase().includes(search) ||
                    employee.location.toLowerCase().includes(search) ||
                    employee.department.toLowerCase().includes(search);

                const matchesStatus =
                    filter === "all" ||
                    employee.status === filter;

                return matchesSearch && matchesStatus;

            });


        grid.innerHTML = "";


        if (!filtered.length) {

            grid.innerHTML = `

            <div class="p-12 text-center bg-white border border-gray-100 shadow-sm rounded-3xl sm:col-span-2 lg:col-span-3">

                <div class="mb-4 text-6xl">
                    👨‍💼
                </div>

                <h3 class="font-bold text-gray-700">
                    No Employees Found
                </h3>

                <p class="mt-1 text-sm text-gray-400">
                    Try another search or register a new employee.
                </p>

            </div>

        `;

            return;

        }


        filtered.forEach((employee, index) => {

            const initials =
                employee.name
                .split(" ")
                .map(word => word[0])
                .join("")
                .substring(0, 2)
                .toUpperCase();


            const active =
                employee.status === "Active";


            grid.innerHTML += `

            <div
                class="p-6 bg-white border border-gray-100 shadow-lg employee-card rounded-3xl"
                style="animation-delay:${index * 80}ms">

                <div class="flex items-center justify-between">

                    <div
                        class="flex items-center justify-center text-lg font-black text-white shadow-lg w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600">

                        ${initials}

                    </div>


                    <span
                        class="px-3 py-1.5 text-xs font-bold border rounded-full
                        ${
                            active
                            ? "text-emerald-700 bg-emerald-50 border-emerald-200"
                            : "text-red-700 bg-red-50 border-red-200"
                        }">

                        ${employee.status}

                    </span>

                </div>


                <h4 class="mt-5 text-xl font-extrabold text-gray-900">
                    ${escapeHTML(employee.name)}
                </h4>


                <p class="mt-1 font-mono text-xs text-gray-400">
                    EMP-${employee.id}
                </p>


                <div class="pt-5 mt-5 space-y-3 text-sm border-t border-gray-100">

                    <div class="flex justify-between gap-4">
                        <span class="text-gray-400">Age</span>
                        <span class="font-semibold text-gray-800">
                            ${employee.age}
                        </span>
                    </div>


                    <div class="flex justify-between gap-4">
                        <span class="text-gray-400">Phone</span>
                        <span class="font-semibold text-gray-800">
                            ${escapeHTML(employee.phone)}
                        </span>
                    </div>


                    <div class="flex justify-between gap-4">
                        <span class="text-gray-400">Location</span>
                        <span class="font-semibold text-gray-800">
                            ${escapeHTML(employee.location)}
                        </span>
                    </div>


                    <div class="flex justify-between gap-4">
                        <span class="text-gray-400">Department</span>
                        <span class="font-semibold text-indigo-600">
                            ${escapeHTML(employee.department)}
                        </span>
                    </div>


                    <div class="flex justify-between gap-4 pt-3 border-t border-gray-100">

                        <span class="text-gray-400">
                            Salary
                        </span>

                        <span class="font-black text-gray-900">
                            Rs. ${Number(employee.salary).toLocaleString()}
                        </span>

                    </div>

                </div>


                <div class="flex gap-2 mt-6">

                    <button
                        onclick="editEmployee(${employee.id})"
                        class="flex-1 px-3 py-2.5 text-xs font-bold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition active:scale-95">

                        ✏ Edit

                    </button>


                    <button
                        onclick="deleteEmployee(${employee.id})"
                        class="flex-1 px-3 py-2.5 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition active:scale-95">

                        🗑 Delete

                    </button>

                </div>

            </div>

        `;

        });


        updateStats();

    }


    function updateStats() {

        document.getElementById("totalEmployees").textContent =
            employees.length;


        document.getElementById("activeEmployees").textContent =
            employees.filter(e => e.status === "Active").length;


        document.getElementById("inactiveEmployees").textContent =
            employees.filter(e => e.status === "Inactive").length;


        document.getElementById("departmentCount").textContent =
            new Set(
                employees.map(e => e.department)
            ).size;

    }


    function openEmployeeModal() {

        document
            .getElementById("employeeModal")
            .classList.add("show");

        document.body.style.overflow = "hidden";

    }


    function closeEmployeeModal() {

        document
            .getElementById("employeeModal")
            .classList.remove("show");

        document
            .getElementById("employeeForm")
            .reset();

        editId = null;


        document.getElementById("modalTitle").textContent =
            "Register Employee";


        document.getElementById("saveButton").textContent =
            "Save Employee";


        document.body.style.overflow = "";

    }


    document
        .getElementById("employeeForm")
        .addEventListener("submit", function(event) {

            event.preventDefault();


            const data = {

                name: document
                    .getElementById("employeeName")
                    .value
                    .trim(),

                age: document
                    .getElementById("employeeAge")
                    .value,

                phone: document
                    .getElementById("employeePhone")
                    .value
                    .trim(),

                location: document
                    .getElementById("employeeLocation")
                    .value
                    .trim(),

                department: document
                    .getElementById("employeeDepartment")
                    .value,

                salary: document
                    .getElementById("employeeSalary")
                    .value,

                status: document
                    .getElementById("employeeStatus")
                    .value

            };


            if (editId) {

                const employee =
                    employees.find(
                        employee => employee.id === editId
                    );

                Object.assign(employee, data);

                showToast(
                    "Employee Updated",
                    "Employee details updated successfully."
                );

            } else {

                const newId =
                    employees.length ?
                    Math.max(...employees.map(e => e.id)) + 1 :
                    101;


                employees.unshift({

                    id: newId,

                    ...data

                });


                showToast(
                    "Employee Added",
                    "New employee registered successfully."
                );

            }


            renderEmployees();

            closeEmployeeModal();

        });


    function editEmployee(id) {

        const employee =
            employees.find(
                employee => employee.id === id
            );


        if (!employee) return;


        editId = id;


        document.getElementById("employeeName").value =
            employee.name;

        document.getElementById("employeeAge").value =
            employee.age;

        document.getElementById("employeePhone").value =
            employee.phone;

        document.getElementById("employeeLocation").value =
            employee.location;

        document.getElementById("employeeDepartment").value =
            employee.department;

        document.getElementById("employeeSalary").value =
            employee.salary;

        document.getElementById("employeeStatus").value =
            employee.status;


        document.getElementById("modalTitle").textContent =
            "Edit Employee";


        document.getElementById("saveButton").textContent =
            "Update Employee";


        openEmployeeModal();

    }


    function deleteEmployee(id) {

        const employee =
            employees.find(
                employee => employee.id === id
            );


        if (!employee) return;


        if (
            !confirm(
                `Are you sure you want to delete ${employee.name}?`
            )
        ) {

            return;

        }


        employees =
            employees.filter(
                employee => employee.id !== id
            );


        renderEmployees();


        showToast(
            "Employee Deleted",
            "Employee removed successfully."
        );

    }


    function showToast(title, message) {

        const toast =
            document.getElementById("toast");


        document.getElementById("toastTitle")
            .textContent = title;


        document.getElementById("toastMessage")
            .textContent = message;


        toast.classList.add("show");


        setTimeout(() => {

            toast.classList.remove("show");

        }, 3000);

    }


    function escapeHTML(value) {

        const div =
            document.createElement("div");

        div.textContent = value;

        return div.innerHTML;

    }


    document
        .getElementById("searchEmployee")
        .addEventListener(
            "input",
            renderEmployees
        );


    document
        .getElementById("statusFilter")
        .addEventListener(
            "change",
            renderEmployees
        );


    document
        .getElementById("employeeModal")
        .addEventListener(
            "click",
            function(event) {

                if (event.target === this) {

                    closeEmployeeModal();

                }

            }
        );


    document.addEventListener(
        "keydown",
        function(event) {

            if (event.key === "Escape") {

                closeEmployeeModal();

            }

        }
    );


    renderEmployees();
</script>

@endsection