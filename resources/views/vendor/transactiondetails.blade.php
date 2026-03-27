@extends('vendor.layout')

@section('page_title', 'My Transactions')

@section('content')

<div class="space-y-6">

    <!-- TOP CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Total Earnings</p>
            <h2 class="text-2xl font-bold mt-1 text-green-600">£12,450</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">This Month</p>
            <h2 class="text-2xl font-bold mt-1 text-blue-600">£2,180</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Pending</p>
            <h2 class="text-2xl font-bold mt-1 text-yellow-600">£540</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Completed</p>
            <h2 class="text-2xl font-bold mt-1">324</h2>
        </div>

    </div>


    <!-- FILTER BAR -->
    <div class="bg-white p-4 rounded-xl border shadow-sm flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

        <input type="text" placeholder="Search by user or ID..."
            class="border rounded-lg px-4 py-2 w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        <div class="flex gap-3">
            <select class="border rounded-lg px-4 py-2">
                <option>All Types</option>
                <option>Product</option>
                <option>Training</option>
            </select>

            <select class="border rounded-lg px-4 py-2">
                <option>All Status</option>
                <option>Completed</option>
                <option>Pending</option>
                <option>Failed</option>
            </select>
        </div>

    </div>


    <!-- TRANSACTION TABLE -->
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 text-left">Transaction ID</th>
                    <th class="p-4 text-left">User</th>
                    <th class="p-4 text-left">Type</th>
                    <th class="p-4 text-left">Amount</th>
                    <th class="p-4 text-left">Date</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                <!-- ROW 1 -->
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-semibold">#TXN12345</td>
                    <td class="p-4">Tarun Sharma</td>
                    <td class="p-4">Product</td>
                    <td class="p-4 text-green-600 font-semibold">£120</td>
                    <td class="p-4">26 Mar 2026</td>
                    <td class="p-4">
                        <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded">
                            Completed
                        </span>
                    </td>
                    <td class="p-4">
                        <button class="text-blue-600 text-sm">View</button>
                    </td>
                </tr>

                <!-- ROW 2 -->
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-semibold">#TXN12346</td>
                    <td class="p-4">Aman Verma</td>
                    <td class="p-4">Training</td>
                    <td class="p-4 text-blue-600 font-semibold">£80</td>
                    <td class="p-4">25 Mar 2026</td>
                    <td class="p-4">
                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-600 rounded">
                            Pending
                        </span>
                    </td>
                    <td class="p-4">
                        <button class="text-blue-600 text-sm">View</button>
                    </td>
                </tr>

                <!-- ROW 3 -->
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-semibold">#TXN12347</td>
                    <td class="p-4">Rohit Singh</td>
                    <td class="p-4">Product</td>
                    <td class="p-4 text-red-600 font-semibold">£150</td>
                    <td class="p-4">24 Mar 2026</td>
                    <td class="p-4">
                        <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded">
                            Failed
                        </span>
                    </td>
                    <td class="p-4">
                        <button class="text-blue-600 text-sm">View</button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>


    <!-- SUMMARY -->
    <div class="bg-blue-50 p-5 rounded-xl border flex justify-between items-center">

        <div>
            <p class="text-sm text-gray-500">Total Transactions</p>
            <h3 class="text-xl font-bold">327</h3>
        </div>

        <div>
            <p class="text-sm text-gray-500">Net Revenue</p>
            <h3 class="text-xl font-bold text-green-600">£12,450</h3>
        </div>

    </div>


    <!-- PAGINATION -->
    <div class="flex justify-between items-center text-sm text-gray-600">

        <span>Showing 1 to 3 of 327 transactions</span>

        <div class="flex gap-2">
            <button class="px-3 py-1 border rounded">Prev</button>
            <button class="px-3 py-1 bg-blue-600 text-white rounded">1</button>
            <button class="px-3 py-1 border rounded">2</button>
            <button class="px-3 py-1 border rounded">Next</button>
        </div>

    </div>

</div>

@endsection