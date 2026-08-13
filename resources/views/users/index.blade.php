@extends('layouts.app')

@section('header')
<div class="flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
            Users Management
        </h2>
        <p class="mt-1 text-sm text-gray-500">Manage users, roles and system access</p>
    </div>

    <span class="items-center hidden gap-2 px-4 py-2 text-xs font-bold text-indigo-600 border border-indigo-100 rounded-full sm:inline-flex bg-indigo-50">
        <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
        System Users
    </span>
</div>
@endsection

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    .users-page {
        min-height: 100vh;
        background:
            radial-gradient(circle at 0% 0%, rgba(59, 130, 246, .15), transparent 28%),
            radial-gradient(circle at 100% 100%, rgba(99, 102, 241, .13), transparent 28%),
            linear-gradient(135deg, #f8fafc, #eef2ff);
    }

    .glass-card {
        background: rgba(255, 255, 255, .96);
        border: 1px solid rgba(226, 232, 240, .9);
        box-shadow: 0 20px 50px rgba(15, 23, 42, .07);
        backdrop-filter: blur(15px);
    }

    .add-card {
        position: relative;
        overflow: hidden;
    }

    .add-card::before {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        right: -70px;
        top: -80px;
        border-radius: 50%;
        background: linear-gradient(135deg,
                rgba(59, 130, 246, .12),
                rgba(99, 102, 241, .04));
    }

    .stat-card {
        transition: all .25s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(15, 23, 42, .1);
    }

    .input-box {
        transition: all .2s ease;
    }

    .input-box:focus {
        transform: translateY(-1px);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .08);
    }

    .user-row {
        transition: all .2s ease;
    }

    .user-row:hover {
        background: linear-gradient(90deg,
                rgba(239, 246, 255, .8),
                rgba(238, 242, 255, .4));
    }

    .btn-main {
        transition: all .2s ease;
    }

    .btn-main:hover {
        transform: translateY(-1px);
    }

    .btn-main:active {
        transform: scale(.97);
    }

    .toast {
        transform: translateX(130%);
        opacity: 0;
        transition: all .35s ease;
    }

    .toast.show {
        transform: translateX(0);
        opacity: 1;
    }

    .fade-row {
        animation: rowIn .35s ease both;
    }

    @keyframes rowIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

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
            border-bottom: 1px solid #e5e7eb;
        }

        .mobile-table td {
            padding: 9px 0;
        }

        .mobile-table td::before {
            content: attr(data-label);
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


<div class="py-8 users-page">

    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

        <!-- =====================================================
         ADD USER SECTION
    ====================================================== -->

        <div class="p-6 mb-6 glass-card add-card rounded-3xl">

            <div class="relative flex flex-col justify-between gap-5 lg:flex-row lg:items-center">

                <div class="flex items-center gap-4">

                    <div class="flex items-center justify-center text-2xl text-white shadow-lg w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600">

                        👤

                    </div>

                    <div>

                        <h3 class="text-xl font-extrabold text-gray-900">
                            Add New User
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Create a new user and assign system permissions
                        </p>

                    </div>

                </div>


                <button
                    type="button"
                    onclick="toggleUserForm()"
                    id="userFormBtn"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-white shadow-lg btn-main rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-blue-500/20">

                    <span class="text-xl">+</span>
                    Add User

                </button>

            </div>


            <!-- ADD USER FORM -->

            <div id="userForm" class="pt-6 mt-6 border-t border-gray-100">

                <form id="addUserForm">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                        <!-- NAME -->

                        <div>

                            <label class="block mb-2 text-xs font-bold text-gray-600">
                                Full Name
                            </label>

                            <input
                                id="userName"
                                type="text"
                                required
                                placeholder="John Doe"
                                class="w-full px-4 py-3 border border-gray-200 outline-none input-box rounded-xl bg-gray-50 focus:bg-white focus:border-blue-500">

                        </div>


                        <!-- EMAIL -->

                        <div>

                            <label class="block mb-2 text-xs font-bold text-gray-600">
                                Email Address
                            </label>

                            <input
                                id="userEmail"
                                type="email"
                                required
                                placeholder="john@example.com"
                                class="w-full px-4 py-3 border border-gray-200 outline-none input-box rounded-xl bg-gray-50 focus:bg-white focus:border-blue-500">

                        </div>


                        <!-- ROLE -->

                        <div>

                            <label class="block mb-2 text-xs font-bold text-gray-600">
                                User Role
                            </label>

                            <select
                                id="userRole"
                                required
                                class="w-full px-4 py-3 border border-gray-200 outline-none input-box rounded-xl bg-gray-50 focus:bg-white focus:border-blue-500">

                                <option value="">Select Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Manager">Manager</option>
                                <option value="Cashier">Cashier</option>
                                <option value="Store Keeper">Store Keeper</option>

                            </select>

                        </div>


                        <!-- PASSWORD -->

                        <div>

                            <label class="block mb-2 text-xs font-bold text-gray-600">
                                Password
                            </label>

                            <input
                                id="userPassword"
                                type="password"
                                required
                                placeholder="••••••••"
                                class="w-full px-4 py-3 border border-gray-200 outline-none input-box rounded-xl bg-gray-50 focus:bg-white focus:border-blue-500">

                        </div>

                    </div>


                    <div class="flex justify-end gap-3 mt-5">

                        <button
                            type="button"
                            onclick="clearUserForm()"
                            class="px-5 py-2.5 rounded-xl
                               bg-gray-100 hover:bg-gray-200
                               text-gray-600 text-sm font-bold">

                            Clear

                        </button>


                        <button
                            type="submit"
                            class="btn-main px-7 py-2.5 rounded-xl
                               bg-gradient-to-r from-blue-600 to-indigo-600
                               hover:from-blue-700 hover:to-indigo-700
                               text-white text-sm font-bold shadow-lg">

                            ✓ Save User

                        </button>

                    </div>

                </form>

            </div>

        </div>


        <!-- =====================================================
         STATISTICS
    ====================================================== -->

        <div class="grid grid-cols-1 gap-5 mb-6 sm:grid-cols-3">

            <!-- TOTAL -->

            <div class="p-5 glass-card stat-card rounded-3xl">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold text-gray-400 uppercase">
                            Total Users
                        </p>

                        <h3
                            id="totalUsers"
                            class="mt-2 text-3xl font-black text-gray-900">

                            0

                        </h3>

                        <p class="mt-1 text-xs text-gray-400">
                            Registered users
                        </p>

                    </div>

                    <div class="flex items-center justify-center text-2xl w-14 h-14 rounded-2xl bg-blue-50">

                        👥

                    </div>

                </div>

            </div>


            <!-- ADMINS -->

            <div class="p-5 glass-card stat-card rounded-3xl">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold text-gray-400 uppercase">
                            Admin Users
                        </p>

                        <h3
                            id="adminUsers"
                            class="mt-2 text-3xl font-black text-indigo-600">

                            0

                        </h3>

                        <p class="mt-1 text-xs text-gray-400">
                            Full access
                        </p>

                    </div>

                    <div class="flex items-center justify-center text-2xl w-14 h-14 rounded-2xl bg-indigo-50">

                        🛡️

                    </div>

                </div>

            </div>


            <!-- STAFF -->

            <div class="p-5 glass-card stat-card rounded-3xl">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-bold text-gray-400 uppercase">
                            Staff Users
                        </p>

                        <h3
                            id="staffUsers"
                            class="mt-2 text-3xl font-black text-emerald-600">

                            0

                        </h3>

                        <p class="mt-1 text-xs text-gray-400">
                            Employees
                        </p>

                    </div>

                    <div class="flex items-center justify-center text-2xl w-14 h-14 rounded-2xl bg-emerald-50">

                        💼

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
         USERS TABLE
    ====================================================== -->

        <div class="overflow-hidden glass-card rounded-3xl">

            <!-- TABLE HEADER -->

            <div class="p-6 border-b border-gray-100">

                <div class="flex flex-col justify-between gap-4 lg:flex-row lg:items-center">

                    <div>

                        <h3 class="text-xl font-extrabold text-gray-900">
                            All System Users
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Manage registered users and their roles
                        </p>

                    </div>


                    <div class="flex flex-col gap-3 sm:flex-row">

                        <!-- SEARCH -->

                        <div class="relative">

                            <span class="absolute text-gray-400 -translate-y-1/2 left-3 top-1/2">
                                🔍
                            </span>

                            <input
                                id="userSearch"
                                type="text"
                                placeholder="Search user..."
                                class="w-full sm:w-64 pl-10 pr-4 py-2.5
                                   rounded-xl border border-gray-200
                                   outline-none focus:border-blue-500
                                   text-sm">

                        </div>


                        <!-- FILTER -->

                        <select
                            id="roleFilter"
                            class="px-4 py-2.5 rounded-xl
                               border border-gray-200
                               outline-none focus:border-blue-500
                               text-sm">

                            <option value="all">
                                All Roles
                            </option>

                            <option value="Admin">
                                Admin
                            </option>

                            <option value="Manager">
                                Manager
                            </option>

                            <option value="Cashier">
                                Cashier
                            </option>

                            <option value="Store Keeper">
                                Store Keeper
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

                            <th class="px-6 py-4 text-xs font-bold tracking-wider text-gray-400 uppercase">
                                User ID
                            </th>

                            <th class="px-6 py-4 text-xs font-bold tracking-wider text-gray-400 uppercase">
                                User
                            </th>

                            <th class="px-6 py-4 text-xs font-bold tracking-wider text-gray-400 uppercase">
                                Email
                            </th>

                            <th class="px-6 py-4 text-xs font-bold tracking-wider text-gray-400 uppercase">
                                Role
                            </th>

                            <th class="px-6 py-4 text-xs font-bold tracking-wider text-center text-gray-400 uppercase">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody
                        id="usersTable"
                        class="divide-y divide-gray-100">

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     TOAST NOTIFICATION
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
       USERS DATA
    ====================================================== */

    let users = [

        {
            id: 1,
            name: "John Doe",
            email: "john@example.com",
            role: "Admin"
        },

        {
            id: 2,
            name: "Kasun Perera",
            email: "kasun@example.com",
            role: "Manager"
        },

        {
            id: 3,
            name: "Nimal Silva",
            email: "nimal@example.com",
            role: "Cashier"
        }

    ];


    let nextUserId = 4;

    let editingUserId = null;


    /* =====================================================
       TOGGLE FORM
    ====================================================== */

    function toggleUserForm() {

        const form =
            document.getElementById("userForm");

        const button =
            document.getElementById("userFormBtn");


        form.classList.toggle("hidden");


        if (form.classList.contains("hidden")) {

            button.innerHTML =
                '<span class="text-xl">+</span> Add User';

        } else {

            button.innerHTML = "✕ Close";

            setTimeout(function() {

                document
                    .getElementById("userName")
                    .focus();

            }, 200);
        }

    }


    /* =====================================================
       ADD / UPDATE USER
    ====================================================== */

    document
        .getElementById("addUserForm")
        .addEventListener("submit", function(e) {

            e.preventDefault();


            const name =
                document
                .getElementById("userName")
                .value
                .trim();


            const email =
                document
                .getElementById("userEmail")
                .value
                .trim();


            const role =
                document
                .getElementById("userRole")
                .value;


            const password =
                document
                .getElementById("userPassword")
                .value;


            if (
                !name ||
                !email ||
                !role ||
                (!editingUserId && !password)
            ) {

                showToast(
                    "Error",
                    "Please fill all required fields.",
                    "error"
                );

                return;
            }


            /* EDIT */

            if (editingUserId) {

                const user =
                    users.find(
                        u => u.id === editingUserId
                    );


                if (user) {

                    user.name = name;
                    user.email = email;
                    user.role = role;

                }


                showToast(
                    "User Updated",
                    "User details updated successfully.",
                    "success"
                );

            }


            /* ADD */
            else {

                users.unshift({

                    id: nextUserId++,

                    name: name,

                    email: email,

                    role: role

                });


                showToast(
                    "User Added",
                    "New user added successfully.",
                    "success"
                );

            }


            clearUserForm();

            renderUsers();

            updateStats();

        });


    /* =====================================================
       RENDER USERS
    ====================================================== */

    function renderUsers() {

        const table =
            document.getElementById("usersTable");


        const search =
            document
            .getElementById("userSearch")
            .value
            .toLowerCase()
            .trim();


        const roleFilter =
            document
            .getElementById("roleFilter")
            .value;


        const filteredUsers =
            users.filter(function(user) {

                const searchMatch =
                    user.name
                    .toLowerCase()
                    .includes(search)

                    ||

                    user.email
                    .toLowerCase()
                    .includes(search);


                const roleMatch =
                    roleFilter === "all" ||
                    user.role === roleFilter;


                return searchMatch && roleMatch;

            });


        table.innerHTML = "";


        /* EMPTY */

        if (filteredUsers.length === 0) {

            table.innerHTML = `

                <tr>

                    <td colspan="5"
                        class="py-16 text-center">

                        <div class="mb-4 text-5xl">
                            👤
                        </div>

                        <div class="font-bold text-gray-600">
                            No Users Found
                        </div>

                        <div class="mt-1 text-sm text-gray-400">
                            Try another search or add a new user.
                        </div>

                    </td>

                </tr>

            `;

            return;
        }


        /* USERS */

        filteredUsers.forEach(function(user) {


            let roleClass =
                "bg-blue-50 text-blue-700 border-blue-200";


            if (user.role === "Admin") {

                roleClass =
                    "bg-purple-50 text-purple-700 border-purple-200";

            }


            if (user.role === "Manager") {

                roleClass =
                    "bg-indigo-50 text-indigo-700 border-indigo-200";

            }


            if (user.role === "Cashier") {

                roleClass =
                    "bg-emerald-50 text-emerald-700 border-emerald-200";

            }


            if (user.role === "Store Keeper") {

                roleClass =
                    "bg-orange-50 text-orange-700 border-orange-200";

            }


            const initials =
                user.name
                .split(" ")
                .map(function(word) {
                    return word.charAt(0);
                })
                .join("")
                .substring(0, 2)
                .toUpperCase();


            table.innerHTML += `

                <tr class="user-row fade-row">

                    <!-- ID -->

                    <td
                        data-label="User ID"
                        class="px-6 py-4">

                        <span class="font-mono font-bold text-gray-600">

                            USR-${String(user.id).padStart(3, "0")}

                        </span>

                    </td>


                    <!-- USER -->

                    <td
                        data-label="User"
                        class="px-6 py-4">

                        <div class="flex items-center gap-3">

                            <div class="flex items-center justify-center text-sm font-bold text-white shadow-md w-11 h-11 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600">

                                ${initials}

                            </div>


                            <div>

                                <div class="font-bold text-gray-900">

                                    ${escapeHTML(user.name)}

                                </div>

                                <div class="text-xs text-gray-400">

                                    System User

                                </div>

                            </div>

                        </div>

                    </td>


                    <!-- EMAIL -->

                    <td
                        data-label="Email"
                        class="px-6 py-4">

                        <span class="font-medium text-gray-500">

                            ${escapeHTML(user.email)}

                        </span>

                    </td>


                    <!-- ROLE -->

                    <td
                        data-label="Role"
                        class="px-6 py-4">

                        <span
                            class="inline-flex items-center gap-2
                                   px-3 py-1.5 rounded-full
                                   text-xs font-bold border
                                   ${roleClass}">

                            <span
                                class="w-1.5 h-1.5 rounded-full bg-current">
                            </span>

                            ${escapeHTML(user.role)}

                        </span>

                    </td>


                    <!-- ACTIONS -->

                    <td
                        data-label="Actions"
                        class="px-6 py-4">

                        <div class="flex justify-center gap-2">

                            <button
                                onclick="editUser(${user.id})"
                                class="px-3.5 py-2 rounded-xl
                                       bg-blue-50
                                       text-blue-600
                                       hover:bg-blue-100
                                       font-bold text-xs
                                       transition">

                                ✏ Edit

                            </button>


                            <button
                                onclick="deleteUser(${user.id})"
                                class="px-3.5 py-2 rounded-xl
                                       bg-red-50
                                       text-red-600
                                       hover:bg-red-100
                                       font-bold text-xs
                                       transition">

                                🗑 Delete

                            </button>

                        </div>

                    </td>

                </tr>

            `;

        });

    }


    /* =====================================================
       EDIT USER
    ====================================================== */

    function editUser(id) {

        const user =
            users.find(
                u => u.id === id
            );


        if (!user) return;


        editingUserId = id;


        document
            .getElementById("userName")
            .value = user.name;


        document
            .getElementById("userEmail")
            .value = user.email;


        document
            .getElementById("userRole")
            .value = user.role;


        const password =
            document.getElementById("userPassword");


        password.value = "";

        password.required = false;


        const form =
            document.getElementById("userForm");


        form.classList.remove("hidden");


        document
            .getElementById("userFormBtn")
            .innerHTML = "✕ Close";


        window.scrollTo({

            top: 0,

            behavior: "smooth"

        });


        showToast(
            "Edit Mode",
            "Update the user information and save.",
            "info"
        );

    }


    /* =====================================================
       DELETE USER
    ====================================================== */

    function deleteUser(id) {

        const user =
            users.find(
                u => u.id === id
            );


        if (!user) return;


        const confirmed =
            confirm(
                "Are you sure you want to delete " +
                user.name +
                "?"
            );


        if (!confirmed) return;


        users =
            users.filter(
                u => u.id !== id
            );


        renderUsers();

        updateStats();


        showToast(
            "User Deleted",
            "User deleted successfully.",
            "success"
        );

    }


    /* =====================================================
       CLEAR FORM
    ====================================================== */

    function clearUserForm() {

        document
            .getElementById("addUserForm")
            .reset();


        document
            .getElementById("userPassword")
            .required = true;


        editingUserId = null;

    }


    /* =====================================================
       SEARCH
    ====================================================== */

    document
        .getElementById("userSearch")
        .addEventListener(
            "input",
            function() {

                renderUsers();

            }
        );


    /* =====================================================
       ROLE FILTER
    ====================================================== */

    document
        .getElementById("roleFilter")
        .addEventListener(
            "change",
            function() {

                renderUsers();

            }
        );


    /* =====================================================
       STATISTICS
    ====================================================== */

    function updateStats() {

        const total =
            users.length;


        const admins =
            users.filter(
                user => user.role === "Admin"
            ).length;


        const staff =
            users.filter(
                user => user.role !== "Admin"
            ).length;


        document
            .getElementById("totalUsers")
            .textContent = total;


        document
            .getElementById("adminUsers")
            .textContent = admins;


        document
            .getElementById("staffUsers")
            .textContent = staff;

    }


    /* =====================================================
       TOAST
    ====================================================== */

    let toastTimer;


    function showToast(
        title,
        message,
        type = "success"
    ) {

        const toast =
            document.getElementById("toast");


        const titleElement =
            document.getElementById("toastTitle");


        const textElement =
            document.getElementById("toastText");


        const icon =
            document.getElementById("toastIcon");


        titleElement.textContent = title;

        textElement.textContent = message;


        toast.classList.remove(
            "bg-gray-900",
            "bg-red-600",
            "bg-blue-600",
            "bg-emerald-600"
        );


        if (type === "error") {

            toast.classList.add("bg-red-600");

            icon.textContent = "✕";

        } else if (type === "info") {

            toast.classList.add("bg-blue-600");

            icon.textContent = "ℹ";

        } else {

            toast.classList.add("bg-emerald-600");

            icon.textContent = "✓";

        }


        toast.classList.add("show");


        clearTimeout(toastTimer);


        toastTimer =
            setTimeout(function() {

                toast.classList.remove("show");

            }, 3000);

    }


    /* =====================================================
       HTML SECURITY
    ====================================================== */

    function escapeHTML(value) {

        const div =
            document.createElement("div");


        div.textContent = value;


        return div.innerHTML;

    }


    /* =====================================================
       INITIALIZE
    ====================================================== */

    renderUsers();

    updateStats();
</script>

@endsection