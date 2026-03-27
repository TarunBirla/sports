@extends('vendor.layout')

@section('page_title', 'User List')

@section('content')

<div class="space-y-6">

    <!-- TOP STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Total Users</p>
            <h2 class="text-2xl font-bold mt-1">1,245</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Active Users</p>
            <h2 class="text-2xl font-bold mt-1 text-green-600">1,032</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">New This Month</p>
            <h2 class="text-2xl font-bold mt-1 text-blue-600">+86</h2>
        </div>

    </div>


    <!-- SEARCH + FILTER -->
    <div class="bg-white p-4 rounded-xl border shadow-sm flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

        <input type="text" placeholder="Search users..."
            class="border rounded-lg px-4 py-2 w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        <select class="border rounded-lg px-4 py-2">
            <option>All Users</option>
            <option>Active</option>
            <option>Inactive</option>
        </select>

    </div>


    <!-- USER TABLE -->
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 text-left">User</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Phone</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Joined</th>
                    <th class="p-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                <!-- USER 1 -->
                <tr class="hover:bg-gray-50">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-bold">
                            T
                        </div>
                        <div>
                            <div class="font-semibold">Tarun Sharma</div>
                            <div class="text-xs text-gray-500">Cricket Player</div>
                        </div>
                    </td>
                    <td class="p-4">tarun@gmail.com</td>
                    <td class="p-4">+91 9876543210</td>
                    <td class="p-4">
                        <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded">
                            Active
                        </span>
                    </td>
                    <td class="p-4">12 Mar 2026</td>
                    <td class="p-4">
                        <button class="text-blue-600 text-sm">View</button>
                    </td>
                </tr>

                <!-- USER 2 -->
                <tr class="hover:bg-gray-50">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center font-bold">
                            A
                        </div>
                        <div>
                            <div class="font-semibold">Aman Verma</div>
                            <div class="text-xs text-gray-500">All Rounder</div>
                        </div>
                    </td>
                    <td class="p-4">aman@gmail.com</td>
                    <td class="p-4">+91 9123456780</td>
                    <td class="p-4">
                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-600 rounded">
                            Pending
                        </span>
                    </td>
                    <td class="p-4">10 Mar 2026</td>
                    <td class="p-4">
                        <button class="text-blue-600 text-sm">View</button>
                    </td>
                </tr>

                <!-- USER 3 -->
                <tr class="hover:bg-gray-50">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center font-bold">
                            R
                        </div>
                        <div>
                            <div class="font-semibold">Rohit Singh</div>
                            <div class="text-xs text-gray-500">Bowler</div>
                        </div>
                    </td>
                    <td class="p-4">rohit@gmail.com</td>
                    <td class="p-4">+91 9988776655</td>
                    <td class="p-4">
                        <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded">
                            Blocked
                        </span>
                    </td>
                    <td class="p-4">05 Mar 2026</td>
                    <td class="p-4">
                        <button class="text-blue-600 text-sm">View</button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>


    <!-- PAGINATION -->
    <div class="flex justify-between items-center text-sm text-gray-600">

        <span>Showing 1 to 3 of 1,245 users</span>

        <div class="flex gap-2">
            <button class="px-3 py-1 border rounded">Prev</button>
            <button class="px-3 py-1 bg-blue-600 text-white rounded">1</button>
            <button class="px-3 py-1 border rounded">2</button>
            <button class="px-3 py-1 border rounded">Next</button>
        </div>

    </div>

</div>

@endsection