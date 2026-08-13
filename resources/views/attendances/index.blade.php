@extends('layouts.app')

@section('header')

<div class="flex items-center justify-between">

    <div>
        <h2 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
            Employee Management
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Manage employees and daily attendance
        </p>
    </div>

    <span class="items-center hidden gap-2 px-4 py-2 text-xs font-bold text-indigo-600 border border-indigo-100 rounded-full sm:inline-flex bg-indigo-50">

        <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>

        Employee System

    </span>

</div>

@endsection


@section('content')

<style>
    /* =====================================================
       PAGE
    ===================================================== */

    .employee-page {

        min-height: 100vh;

        background:
            radial-gradient(circle at 0% 0%,
                rgba(59, 130, 246, .15),
                transparent 28%),

            radial-gradient(circle at 100% 100%,
                rgba(99, 102, 241, .14),
                transparent 28%),

            linear-gradient(135deg,
                #f8fafc,
                #eef2ff);

    }


    /* =====================================================
       CARDS
    ===================================================== */

    .glass-card {

        background: rgba(255, 255, 255, .96);

        border: 1px solid rgba(226, 232, 240, .9);

        box-shadow:
            0 20px 50px rgba(15, 23, 42, .07);

        backdrop-filter: blur(15px);

    }


    .stat-card {

        transition: all .25s ease;

    }


    .stat-card:hover {

        transform: translateY(-5px);

        box-shadow:
            0 20px 40px rgba(15, 23, 42, .10);

    }


    /* =====================================================
       BUTTONS
    ===================================================== */

    .main-btn {

        transition: all .2s ease;

    }


    .main-btn:hover {

        transform: translateY(-2px);

    }


    .main-btn:active {

        transform: scale(.97);

    }


    /* =====================================================
       INPUT
    ===================================================== */

    .input-box {

        transition: all .2s ease;

    }


    .input-box:focus {

        transform: translateY(-1px);

        box-shadow:
            0 0 0 4px rgba(59, 130, 246, .08);

    }


    /* =====================================================
       TABLE
    ===================================================== */

    .employee-row {

        transition: all .2s ease;

    }


    .employee-row:hover {

        background:
            linear-gradient(90deg,
                rgba(239, 246, 255, .8),
                rgba(238, 242, 255, .4));

    }


    /* =====================================================
       FORM ANIMATION
    ===================================================== */

    .form-animation {

        animation:
            formOpen .3s ease forwards;

    }


    @keyframes formOpen {

        from {

            opacity: 0;

            transform:
                translateY(-10px);

        }

        to {

            opacity: 1;

            transform:
                translateY(0);

        }

    }


    /* =====================================================
       ROW ANIMATION
    ===================================================== */

    .row-animation {

        animation:
            rowIn .35s ease both;

    }


    @keyframes rowIn {

        from {

            opacity: 0;

            transform:
                translateY(8px);

        }

        to {

            opacity: 1;

            transform:
                translateY(0);

        }

    }


    /* =====================================================
       TOAST
    ===================================================== */

    .toast {

        opacity: 0;

        transform:
            translateX(130%);

        transition:
            all .35s ease;

    }


    .toast.show {

        opacity: 1;

        transform:
            translateX(0);

    }


    /* =====================================================
       MOBILE TABLE
    ===================================================== */

    @media(max-width: 640px) {

        .mobile-table thead {

            display: none;

        }


        .mobile-table,
        .mobile-table tbody,
        .mobile-table tr,
        .mobile-table td {

            display: block;

            width: 100%;

        }


        .mobile-table tr {

            padding: 18px;

            border-bottom:
                1px solid #e5e7eb;

        }


        .mobile-table td {

            padding: 9px 0;

        }


        .mobile-table td::before {

            content:
                attr(data-label);

            display: block;

            margin-bottom: 4px;

            color: #94a3b8;

            font-size: 10px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .06em;

        }

    }
</style>


<div class="py-8 employee-page">

    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">


        <!-- =================================================
         ADD EMPLOYEE
    ================================================== -->

        <div class="p-6 mb-6 glass-card rounded-3xl">

            <div class="flex flex-col justify-between gap-5 lg:flex-row lg:items-center">

                <div class="flex items-center gap-4">

                    <div class="flex items-center justify-center text-2xl text-white shadow-lg w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600">

                        👨‍💼

                    </div>


                    <div>

                        <h3 class="text-xl font-extrabold text-gray-900">

                            Add New Employee

                        </h3>

                        <p class="mt-1 text-sm text-gray-500">

                            Register employees and manage attendance

                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    onclick="toggleEmployeeForm()"
                    id="employeeFormBtn"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-white shadow-lg main-btn rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-blue-500/20">

                    <span class="text-xl">+</span>

                    Add Employee

                </button>

            </div>


            <!-- =================================================
             ADD EMPLOYEE FORM
        ================================================== -->

            <div
                id="employeeForm"
                class="hidden pt-6 mt-6 border-t border-gray-100">

                <form id="employeeAddForm">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">


                        <!-- NAME -->

                        <div>

                            <label class="block mb-2 text-xs font-bold text-gray-600">

                                Employee Name

                            </label>

                            <input
                                id="employeeName"
                                type="text"
                                required
                                placeholder="John Doe"
                                class="w-full px-4 py-3 border border-gray-200 outline-none input-box rounded-xl bg-gray-50 focus:bg-white focus:border-blue-500">

                        </div>


                        <!-- PHONE -->

                        <div>

                            <label class="block mb-2 text-xs font-bold text-gray-600">

                                Phone Number

                            </label>

                            <input
                                id="employeePhone"
                                type="text"
                                required
                                placeholder="0771234567"
                                class="w-full px-4 py-3 border border-gray-200 outline-none input-box rounded-xl bg-gray-50 focus:bg-white focus:border-blue-500">

                        </div>


                        <!-- POSITION -->

                        <div>

                            <label class="block mb-2 text-xs font-bold text-gray-600">

                                Position

                            </label>

                            <select
                                id="employeePosition"
                                required
                                class="w-full px-4 py-3 border border-gray-200 outline-none input-box rounded-xl bg-gray-50 focus:bg-white focus:border-blue-500">

                                <option value="">
                                    Select Position
                                </option>

                                <option value="Manager">
                                    Manager
                                </option>

                                <option value="Cashier">
                                    Cashier
                                </option>

                                <option value="Sales Assistant">
                                    Sales Assistant
                                </option>

                                <option value="Store Keeper">
                                    Store Keeper
                                </option>

                                <option value="Delivery">
                                    Delivery
                                </option>

                            </select>

                        </div>


                        <!-- SALARY -->

                        <div>

                            <label class="block mb-2 text-xs font-bold text-gray-600">

                                Monthly Salary

                            </label>

                            <input
                                id="employeeSalary"
                                type="number"
                                required
                                placeholder="50000"
                                class="w-full px-4 py-3 border border-gray-200 outline-none input-box rounded-xl bg-gray-50 focus:bg-white focus:border-blue-500">

                        </div>

                    </div>


                    <div class="flex justify-end gap-3 mt-5">


                        <button
                            type="button"
                            onclick="clearEmployeeForm()"
                            class="px-5 py-2.5 rounded-xl
                               bg-gray-100
                               hover:bg-gray-200
                               text-gray-600
                               text-sm font-bold">

                            Clear

                        </button>


                        <button
                            type="submit"
                            class="main-btn px-7 py-2.5 rounded-xl
                               bg-gradient-to-r
                               from-blue-600 to-indigo-600
                               hover:from-blue-700
                               hover:to-indigo-700
                               text-white
                               text-sm font-bold
                               shadow-lg">

                            ✓ Save Employee

                        </button>

                    </div>

                </form>

            </div>

        </div>


        <!-- =================================================
         STATISTICS
    ================================================== -->

        <div class="grid grid-cols-1 gap-5 mb-6 sm:grid-cols-2 lg:grid-cols-4">


            <!-- TOTAL -->

            <div class="p-5 glass-card stat-card rounded-3xl">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold text-gray-400 uppercase">

                            Total Employees

                        </p>

                        <h3
                            id="totalEmployees"
                            class="mt-2 text-3xl font-black text-gray-900">

                            0

                        </h3>

                    </div>


                    <div class="flex items-center justify-center text-2xl w-14 h-14 rounded-2xl bg-blue-50">

                        👥

                    </div>

                </div>

            </div>


            <!-- PRESENT -->

            <div class="p-5 glass-card stat-card rounded-3xl">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold text-gray-400 uppercase">

                            Present

                        </p>

                        <h3
                            id="presentEmployees"
                            class="mt-2 text-3xl font-black text-emerald-600">

                            0

                        </h3>

                    </div>


                    <div class="flex items-center justify-center text-2xl w-14 h-14 rounded-2xl bg-emerald-50">

                        ✓

                    </div>

                </div>

            </div>


            <!-- ABSENT -->

            <div class="p-5 glass-card stat-card rounded-3xl">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold text-gray-400 uppercase">

                            Absent

                        </p>

                        <h3
                            id="absentEmployees"
                            class="mt-2 text-3xl font-black text-red-600">

                            0

                        </h3>

                    </div>


                    <div class="flex items-center justify-center text-2xl w-14 h-14 rounded-2xl bg-red-50">

                        ✕

                    </div>

                </div>

            </div>


            <!-- LATE -->

            <div class="p-5 glass-card stat-card rounded-3xl">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold text-gray-400 uppercase">

                            Late

                        </p>

                        <h3
                            id="lateEmployees"
                            class="mt-2 text-3xl font-black text-orange-500">

                            0

                        </h3>

                    </div>


                    <div class="flex items-center justify-center text-2xl w-14 h-14 rounded-2xl bg-orange-50">

                        ⏰

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
         ATTENDANCE TABLE
    ================================================== -->

        <div class="overflow-hidden glass-card rounded-3xl">


            <!-- HEADER -->

            <div class="p-6 border-b border-gray-100">

                <div class="flex flex-col justify-between gap-4 lg:flex-row lg:items-center">


                    <div>

                        <h3 class="text-xl font-extrabold text-gray-900">

                            Daily Attendance

                        </h3>

                        <p class="mt-1 text-sm text-gray-500">

                            Track employee check-in,
                            check-out and work status

                        </p>

                    </div>


                    <!-- SEARCH + FILTER -->

                    <div class="flex flex-col gap-3 sm:flex-row">


                        <div class="relative">

                            <span class="absolute text-gray-400 -translate-y-1/2 left-3 top-1/2">

                                🔍

                            </span>

                            <input
                                id="employeeSearch"
                                type="text"
                                placeholder="Search employee..."
                                class="w-full sm:w-64
                                   pl-10 pr-4 py-2.5
                                   rounded-xl
                                   border border-gray-200
                                   outline-none
                                   focus:border-blue-500
                                   text-sm">

                        </div>


                        <select
                            id="attendanceFilter"
                            class="px-4 py-2.5
                               rounded-xl
                               border border-gray-200
                               outline-none
                               focus:border-blue-500
                               text-sm">

                            <option value="all">
                                All Status
                            </option>

                            <option value="Present">
                                Present
                            </option>

                            <option value="Absent">
                                Absent
                            </option>

                            <option value="Late">
                                Late
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            <!-- TABLE -->

            <div class="overflow-x-auto">

                <table class="w-full text-left mobile-table">


                    <thead>

                        <tr class="border-b border-gray-200 bg-gray-50">

                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">

                                Employee ID

                            </th>


                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">

                                Employee

                            </th>


                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">

                                Position

                            </th>


                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">

                                Check In

                            </th>


                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">

                                Check Out

                            </th>


                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">

                                Status

                            </th>


                            <th class="px-6 py-4 text-xs font-bold text-center text-gray-400 uppercase">

                                Actions

                            </th>

                        </tr>

                    </thead>


                    <tbody
                        id="employeeTable"
                        class="divide-y divide-gray-100">

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     TOAST
====================================================== -->

<div
    id="toast"
    class="toast fixed right-5 bottom-5 z-50
           min-w-[280px] max-w-sm
           rounded-2xl shadow-2xl
           px-5 py-4 text-white">

    <div class="flex items-start gap-3">

        <div
            id="toastIcon"
            class="text-xl">

            ✓

        </div>


        <div>

            <div
                id="toastTitle"
                class="text-sm font-bold">

                Success

            </div>


            <div
                id="toastText"
                class="mt-1 text-xs text-white/80">

                Done successfully.

            </div>

        </div>

    </div>

</div>


<script>
    /* =====================================================
       EMPLOYEE DATA
    ===================================================== */

    let employees = [

        {
            id: 1,
            name: "John Doe",
            phone: "0771234567",
            position: "Manager",
            salary: 75000,
            checkIn: "08:30 AM",
            checkOut: "05:00 PM",
            status: "Present"
        },


        {
            id: 2,
            name: "Kasun Perera",
            phone: "0712345678",
            position: "Cashier",
            salary: 55000,
            checkIn: "08:45 AM",
            checkOut: "-",
            status: "Late"
        },


        {
            id: 3,
            name: "Nimal Silva",
            phone: "0761234567",
            position: "Store Keeper",
            salary: 60000,
            checkIn: "-",
            checkOut: "-",
            status: "Absent"
        }

    ];


    let nextEmployeeId = 4;

    let editingEmployeeId = null;


    /* =====================================================
       TOGGLE FORM
    ===================================================== */

    function toggleEmployeeForm() {

        const form =
            document.getElementById("employeeForm");


        const button =
            document.getElementById("employeeFormBtn");


        form.classList.toggle("hidden");


        if (form.classList.contains("hidden")) {

            button.innerHTML =
                '<span class="text-xl">+</span> Add Employee';

        } else {

            button.innerHTML =
                "✕ Close";

            setTimeout(function() {

                document
                    .getElementById("employeeName")
                    .focus();

            }, 200);

        }

    }


    /* =====================================================
       ADD / EDIT EMPLOYEE
    ===================================================== */

    document
        .getElementById("employeeAddForm")
        .addEventListener(
            "submit",
            function(e) {

                e.preventDefault();


                const name =
                    document
                    .getElementById("employeeName")
                    .value
                    .trim();


                const phone =
                    document
                    .getElementById("employeePhone")
                    .value
                    .trim();


                const position =
                    document
                    .getElementById("employeePosition")
                    .value;


                const salary =
                    document
                    .getElementById("employeeSalary")
                    .value;


                if (
                    !name ||
                    !phone ||
                    !position ||
                    !salary
                ) {

                    showToast(
                        "Error",
                        "Please fill all fields.",
                        "error"
                    );

                    return;

                }


                /* EDIT */

                if (editingEmployeeId) {

                    const employee =
                        employees.find(
                            e => e.id === editingEmployeeId
                        );


                    if (employee) {

                        employee.name =
                            name;

                        employee.phone =
                            phone;

                        employee.position =
                            position;

                        employee.salary =
                            salary;

                    }


                    showToast(
                        "Employee Updated",
                        "Employee information updated.",
                        "success"
                    );

                }


                /* ADD */
                else {

                    employees.unshift({

                        id: nextEmployeeId++,

                        name: name,

                        phone: phone,

                        position: position,

                        salary: salary,

                        checkIn: "-",

                        checkOut: "-",

                        status: "Absent"

                    });


                    showToast(
                        "Employee Added",
                        "New employee added successfully.",
                        "success"
                    );

                }


                clearEmployeeForm();

                renderEmployees();

                updateStatistics();

            }
        );


    /* =====================================================
       RENDER EMPLOYEES
    ===================================================== */

    function renderEmployees() {

        const table =
            document.getElementById(
                "employeeTable"
            );


        const search =
            document
            .getElementById(
                "employeeSearch"
            )
            .value
            .toLowerCase()
            .trim();


        const filter =
            document
            .getElementById(
                "attendanceFilter"
            )
            .value;


        const filtered =
            employees.filter(
                function(employee) {

                    const searchMatch =
                        employee.name
                        .toLowerCase()
                        .includes(search)

                        ||

                        employee.phone
                        .toLowerCase()
                        .includes(search);


                    const statusMatch =
                        filter === "all" ||
                        employee.status === filter;


                    return (
                        searchMatch &&
                        statusMatch
                    );

                }
            );


        table.innerHTML = "";


        if (filtered.length === 0) {

            table.innerHTML = `

                <tr>

                    <td
                        colspan="7"
                        class="py-16 text-center">

                        <div class="mb-3 text-5xl">
                            👨‍💼
                        </div>

                        <div class="font-bold text-gray-600">

                            No Employees Found

                        </div>

                        <div class="mt-1 text-sm text-gray-400">

                            Add a new employee
                            or change your search.

                        </div>

                    </td>

                </tr>

            `;

            return;

        }


        filtered.forEach(
            function(employee) {


                let statusClass =
                    "bg-gray-50 text-gray-600 border-gray-200";


                if (
                    employee.status ===
                    "Present"
                ) {

                    statusClass =
                        "bg-emerald-50 text-emerald-700 border-emerald-200";

                }


                if (
                    employee.status ===
                    "Absent"
                ) {

                    statusClass =
                        "bg-red-50 text-red-700 border-red-200";

                }


                if (
                    employee.status ===
                    "Late"
                ) {

                    statusClass =
                        "bg-orange-50 text-orange-700 border-orange-200";

                }


                const initials =
                    employee.name
                    .split(" ")
                    .map(
                        word =>
                        word.charAt(0)
                    )
                    .join("")
                    .substring(0, 2)
                    .toUpperCase();


                table.innerHTML += `

                    <tr class=" employee-row row-animation">


                        <!-- ID -->

                        <td
                            data-label="Employee ID"
                            class="px-6 py-5">

                            <span
                                class="font-mono font-bold text-gray-600">

                                EMP-${String(
                                    employee.id
                                ).padStart(3,"0")}

                            </span>

                        </td>


                        <!-- EMPLOYEE -->

                        <td
                            data-label="Employee"
                            class="px-6 py-5">

                            <div
                                class="flex items-center gap-3">

                                <div
                                    class="flex items-center justify-center font-bold text-white shadow-md w-11 h-11 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600">

                                    ${initials}

                                </div>


                                <div>

                                    <div
                                        class="font-bold text-gray-900">

                                        ${escapeHTML(
                                            employee.name
                                        )}

                                    </div>


                                    <div
                                        class="text-xs text-gray-400">

                                        ${escapeHTML(
                                            employee.phone
                                        )}

                                    </div>

                                </div>

                            </div>

                        </td>


                        <!-- POSITION -->

                        <td
                            data-label="Position"
                            class="px-6 py-5">

                            <span
                                class="font-medium text-gray-700">

                                ${escapeHTML(
                                    employee.position
                                )}

                            </span>

                        </td>


                        <!-- CHECK IN -->

                        <td
                            data-label="Check In"
                            class="px-6 py-5">

                            <span
                                class="font-medium text-gray-600">

                                ${employee.checkIn}

                            </span>

                        </td>


                        <!-- CHECK OUT -->

                        <td
                            data-label="Check Out"
                            class="px-6 py-5">

                            <span
                                class="font-medium text-gray-600">

                                ${employee.checkOut}

                            </span>

                        </td>


                        <!-- STATUS -->

                        <td
                            data-label="Status"
                            class="px-6 py-5">

                            <span
                                class="
                                    inline-flex
                                    items-center
                                    gap-2
                                    px-3
                                    py-1.5
                                    rounded-full
                                    text-xs
                                    font-bold
                                    border
                                    ${statusClass}
                                ">

                                <span
                                    class="w-1.5 h-1.5
                                           rounded-full
                                           bg-current">

                                </span>

                                ${employee.status}

                            </span>

                        </td>


                        <!-- ACTIONS -->

                        <td
                            data-label="Actions"
                            class="px-6 py-5">

                            <div
                                class="flex flex-wrap justify-center gap-2">


                                ${
                                    employee.status !==
                                    "Present"
                                    ?

                                    `

                                    <button
                                        onclick="
                                            checkInEmployee(
                                                ${employee.id}
                                            )
                                        "
                                        class="px-3 py-2 text-xs font-bold transition  rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-100">

                                        ✓ Check In

                                    </button>

                                    `

                                    :

                                    `

                                    <button
                                        onclick="
                                            checkOutEmployee(
                                                ${employee.id}
                                            )
                                        "
                                        class="px-3 py-2 text-xs font-bold text-orange-600 transition  rounded-xl bg-orange-50 hover:bg-orange-100">

                                        ⏱ Check Out

                                    </button>

                                    `
                                }


                                <button
                                    onclick="
                                        editEmployee(
                                            ${employee.id}
                                        )
                                    "
                                    class="px-3 py-2 text-xs font-bold text-blue-600 transition  rounded-xl bg-blue-50 hover:bg-blue-100">

                                    ✏ Edit

                                </button>


                                <button
                                    onclick="
                                        deleteEmployee(
                                            ${employee.id}
                                        )
                                    "
                                    class="px-3 py-2 text-xs font-bold text-red-600 transition  rounded-xl bg-red-50 hover:bg-red-100">

                                    🗑 Delete

                                </button>

                            </div>

                        </td>

                    </tr>

                `;

            }
        );

    }


    /* =====================================================
       CHECK IN
    ===================================================== */

    function checkInEmployee(id) {

        const employee =
            employees.find(
                e => e.id === id
            );


        if (!employee) return;


        const now =
            new Date();


        const time =
            now.toLocaleTimeString(
                "en-US", {
                    hour: "2-digit",

                    minute: "2-digit"
                }
            );


        employee.checkIn =
            time;


        /*
         * Before 08:30 = Present
         * After 08:30 = Late
         */

        const hours =
            now.getHours();

        const minutes =
            now.getMinutes();


        if (
            hours > 8 ||
            (
                hours === 8 &&
                minutes > 30
            )
        ) {

            employee.status =
                "Late";

        } else {

            employee.status =
                "Present";

        }


        renderEmployees();

        updateStatistics();


        showToast(
            "Check In",
            employee.name +
            " checked in successfully.",
            "success"
        );

    }


    /* =====================================================
       CHECK OUT
    ===================================================== */

    function checkOutEmployee(id) {

        const employee =
            employees.find(
                e => e.id === id
            );


        if (!employee) return;


        const now =
            new Date();


        employee.checkOut =
            now.toLocaleTimeString(
                "en-US", {
                    hour: "2-digit",

                    minute: "2-digit"
                }
            );


        renderEmployees();


        showToast(
            "Check Out",
            employee.name +
            " checked out successfully.",
            "info"
        );

    }


    /* =====================================================
       EDIT
    ===================================================== */

    function editEmployee(id) {

        const employee =
            employees.find(
                e => e.id === id
            );


        if (!employee) return;


        editingEmployeeId =
            id;


        document
            .getElementById(
                "employeeName"
            )
            .value =
            employee.name;


        document
            .getElementById(
                "employeePhone"
            )
            .value =
            employee.phone;


        document
            .getElementById(
                "employeePosition"
            )
            .value =
            employee.position;


        document
            .getElementById(
                "employeeSalary"
            )
            .value =
            employee.salary;


        const form =
            document.getElementById(
                "employeeForm"
            );


        form.classList.remove(
            "hidden"
        );


        document
            .getElementById(
                "employeeFormBtn"
            )
            .innerHTML =
            "✕ Close";


        window.scrollTo({

            top: 0,

            behavior: "smooth"

        });


        showToast(
            "Edit Mode",
            "Update employee details.",
            "info"
        );

    }


    /* =====================================================
       DELETE
    ===================================================== */

    function deleteEmployee(id) {

        const employee =
            employees.find(
                e => e.id === id
            );


        if (!employee) return;


        const confirmDelete =
            confirm(
                "Delete " +
                employee.name +
                "?"
            );


        if (!confirmDelete)
            return;


        employees =
            employees.filter(
                e => e.id !== id
            );


        renderEmployees();

        updateStatistics();


        showToast(
            "Employee Deleted",
            "Employee removed successfully.",
            "success"
        );

    }


    /* =====================================================
       CLEAR FORM
    ===================================================== */

    function clearEmployeeForm() {

        document
            .getElementById(
                "employeeAddForm"
            )
            .reset();


        editingEmployeeId =
            null;

    }


    /* =====================================================
       SEARCH
    ===================================================== */

    document
        .getElementById(
            "employeeSearch"
        )
        .addEventListener(
            "input",
            function() {

                renderEmployees();

            }
        );


    /* =====================================================
       FILTER
    ===================================================== */

    document
        .getElementById(
            "attendanceFilter"
        )
        .addEventListener(
            "change",
            function() {

                renderEmployees();

            }
        );


    /* =====================================================
       STATISTICS
    ===================================================== */

    function updateStatistics() {

        const total =
            employees.length;


        const present =
            employees.filter(
                e =>
                e.status ===
                "Present"
            ).length;


        const absent =
            employees.filter(
                e =>
                e.status ===
                "Absent"
            ).length;


        const late =
            employees.filter(
                e =>
                e.status ===
                "Late"
            ).length;


        document
            .getElementById(
                "totalEmployees"
            )
            .textContent =
            total;


        document
            .getElementById(
                "presentEmployees"
            )
            .textContent =
            present;


        document
            .getElementById(
                "absentEmployees"
            )
            .textContent =
            absent;


        document
            .getElementById(
                "lateEmployees"
            )
            .textContent =
            late;

    }


    /* =====================================================
       TOAST
    ===================================================== */

    let toastTimer;


    function showToast(
        title,
        message,
        type = "success"
    ) {

        const toast =
            document.getElementById(
                "toast"
            );


        const titleElement =
            document.getElementById(
                "toastTitle"
            );


        const textElement =
            document.getElementById(
                "toastText"
            );


        const icon =
            document.getElementById(
                "toastIcon"
            );


        titleElement.textContent =
            title;


        textElement.textContent =
            message;


        toast.classList.remove(
            "bg-gray-900",
            "bg-red-600",
            "bg-blue-600",
            "bg-emerald-600"
        );


        if (
            type === "error"
        ) {

            toast.classList.add(
                "bg-red-600"
            );

            icon.textContent =
                "✕";

        } else if (
            type === "info"
        ) {

            toast.classList.add(
                "bg-blue-600"
            );

            icon.textContent =
                "ℹ";

        } else {

            toast.classList.add(
                "bg-emerald-600"
            );

            icon.textContent =
                "✓";

        }


        toast.classList.add(
            "show"
        );


        clearTimeout(
            toastTimer
        );


        toastTimer =
            setTimeout(
                function() {

                    toast.classList.remove(
                        "show"
                    );

                },
                3000
            );

    }


    /* =====================================================
       SECURITY
    ===================================================== */

    function escapeHTML(value) {

        const div =
            document.createElement(
                "div"
            );


        div.textContent =
            value;


        return div.innerHTML;

    }


    /* =====================================================
       INITIALIZE
    ===================================================== */

    renderEmployees();

    updateStatistics();
</script>

@endsection