@extends('vendor.layout')

@section('page_title', 'My Performance')

@section('content')

<div class="space-y-6">

    <!-- TOP STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Total Matches</p>
            <h2 class="text-2xl font-bold mt-1">48</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Total Runs</p>
            <h2 class="text-2xl font-bold mt-1 text-green-600">2,340</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Wickets</p>
            <h2 class="text-2xl font-bold mt-1 text-blue-600">86</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Batting Avg</p>
            <h2 class="text-2xl font-bold mt-1">48.6</h2>
        </div>

    </div>


    <!-- MAIN CHART -->
    <div class="bg-white p-6 rounded-xl border shadow-sm">
        <h3 class="font-semibold mb-4">📈 Monthly Performance</h3>
        <canvas id="monthlyChart"></canvas>
    </div>


    <!-- 2 CHARTS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-xl border shadow-sm">
            <h3 class="font-semibold mb-4">🏏 Batting Performance</h3>
            <canvas id="battingChart"></canvas>
        </div>

        <div class="bg-white p-6 rounded-xl border shadow-sm">
            <h3 class="font-semibold mb-4">🎯 Bowling Performance</h3>
            <canvas id="bowlingChart"></canvas>
        </div>

    </div>


    <!-- EXTRA STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-green-50 p-5 rounded-xl border">
            <p class="text-sm text-gray-500">Highest Score</p>
            <h3 class="text-xl font-bold text-green-600">142 Runs</h3>
        </div>

        <div class="bg-blue-50 p-5 rounded-xl border">
            <p class="text-sm text-gray-500">Best Bowling</p>
            <h3 class="text-xl font-bold text-blue-600">5/24</h3>
        </div>

        <div class="bg-yellow-50 p-5 rounded-xl border">
            <p class="text-sm text-gray-500">Strike Rate</p>
            <h3 class="text-xl font-bold text-yellow-600">132.5</h3>
        </div>

    </div>

</div>


<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

// Monthly Performance
new Chart(document.getElementById('monthlyChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun'],
        datasets: [{
            label: 'Runs',
            data: [200, 350, 280, 400, 500, 610],
            borderColor: '#16a34a',
            backgroundColor: 'rgba(22,163,74,0.1)',
            fill: true,
            tension: 0.4
        }]
    }
});

// Batting Chart
new Chart(document.getElementById('battingChart'), {
    type: 'bar',
    data: {
        labels: ['Match 1','Match 2','Match 3','Match 4'],
        datasets: [{
            label: 'Runs',
            data: [45, 78, 120, 65],
            backgroundColor: ['#22c55e','#16a34a','#15803d','#4ade80']
        }]
    }
});

// Bowling Chart
new Chart(document.getElementById('bowlingChart'), {
    type: 'bar',
    data: {
        labels: ['Match 1','Match 2','Match 3','Match 4'],
        datasets: [{
            label: 'Wickets',
            data: [2, 4, 1, 3],
            backgroundColor: ['#3b82f6','#2563eb','#1d4ed8','#60a5fa']
        }]
    }
});

</script>

@endsection