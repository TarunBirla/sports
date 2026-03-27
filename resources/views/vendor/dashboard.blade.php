@extends('vendor.layout')

@section('page_title', 'Add Category')

@section('content')
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- ===================== -->
<!-- CONTAINER -->
<!-- ===================== -->
<div class="p-6">

    <h2 class="text-2xl font-bold mb-6">🏏 Vendor Dashboard</h2>

    <!-- ===================== -->
    <!-- STATS CARDS -->
    <!-- ===================== -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Total Orders</p>
            <h3 class="text-3xl font-bold text-blue-600 mt-2">120</h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Total Products</p>
            <h3 class="text-3xl font-bold text-purple-600 mt-2">45</h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Total Earnings (£)</p>
            <h3 class="text-3xl font-bold text-green-600 mt-2">£ 8,450.00</h3>
        </div>

    </div>

    <!-- ===================== -->
    <!-- CHARTS -->
    <!-- ===================== -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="font-semibold mb-4">📦 Orders Overview</h3>
            <canvas id="ordersChart"></canvas>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="font-semibold mb-4">💰 Earnings Overview</h3>
            <canvas id="earningsChart"></canvas>
        </div>

    </div>

    <!-- ===================== -->
    <!-- RECENT ORDERS -->
    <!-- ===================== -->
    <div class="bg-white p-6 rounded-xl shadow mt-10">

        <h3 class="text-lg font-semibold mb-4">🧾 Recent Orders</h3>

        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b bg-gray-100">
                    <th class="py-2 px-2">Order ID</th>
                    <th class="px-2">Total</th>
                    <th class="px-2">Date</th>
                    <th class="px-2">Status</th>
                </tr>
            </thead>

            <tbody>

                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-2">#1001</td>
                    <td class="px-2">£120</td>
                    <td class="px-2">12 Mar 2026</td>
                    <td class="px-2 text-green-600 font-medium">Completed</td>
                </tr>

                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-2">#1002</td>
                    <td class="px-2">£250</td>
                    <td class="px-2">15 Mar 2026</td>
                    <td class="px-2 text-yellow-600 font-medium">Pending</td>
                </tr>

                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-2">#1003</td>
                    <td class="px-2">£90</td>
                    <td class="px-2">18 Mar 2026</td>
                    <td class="px-2 text-red-600 font-medium">Cancelled</td>
                </tr>

                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-2">#1004</td>
                    <td class="px-2">£310</td>
                    <td class="px-2">20 Mar 2026</td>
                    <td class="px-2 text-green-600 font-medium">Completed</td>
                </tr>

            </tbody>
        </table>

    </div>

</div>

<!-- ===================== -->
<!-- CHART SCRIPT -->
<!-- ===================== -->
<script>

// Orders Chart
new Chart(document.getElementById('ordersChart'), {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun'],
        datasets: [{
            label: 'Orders',
            data: [12, 19, 10, 15, 22, 18],
            backgroundColor: 'rgba(37, 99, 235, 0.6)'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        }
    }
});

// Earnings Chart
new Chart(document.getElementById('earningsChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun'],
        datasets: [{
            label: 'Earnings (£)',
            data: [500, 800, 650, 900, 1200, 1000],
            borderColor: 'green',
            backgroundColor: 'rgba(34,197,94,0.2)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true
    }
});

</script>

@endsection