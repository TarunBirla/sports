@extends('vendor.layout')

@section('page_title', 'My Coaches')

@section('content')

<div class="space-y-6">

    <!-- TOP STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Total Coaches</p>
            <h2 class="text-2xl font-bold mt-1">12</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Active Coaches</p>
            <h2 class="text-2xl font-bold mt-1 text-green-600">10</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Top Rated</p>
            <h2 class="text-2xl font-bold mt-1 text-yellow-600">4.8 ⭐</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Academies</p>
            <h2 class="text-2xl font-bold mt-1 text-blue-600">3</h2>
        </div>

    </div>


    <!-- BEST COACH GRAPH -->
    <div class="bg-white p-6 rounded-xl border shadow-sm">
        <h3 class="font-semibold mb-4">🏆 Top Coach Performance</h3>
        <canvas id="coachChart"></canvas>
    </div>


    <!-- COACH LIST -->
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">

        <div class="p-4 border-b font-semibold">
            👨‍🏫 Coach List
        </div>

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 text-left">Coach</th>
                    <th class="p-4 text-left">Speciality</th>
                    <th class="p-4 text-left">Experience</th>
                    <th class="p-4 text-left">Rating</th>
                    <th class="p-4 text-left">Academy</th>
                    <th class="p-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                <!-- COACH 1 -->
                <tr class="hover:bg-gray-50">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-bold">
                            R
                        </div>
                        <div>
                            <div class="font-semibold">Rahul Sir</div>
                            <div class="text-xs text-gray-500">Head Coach</div>
                        </div>
                    </td>
                    <td class="p-4">Batting</td>
                    <td class="p-4">12 Years</td>
                    <td class="p-4 text-yellow-500">4.9 ⭐</td>
                    <td class="p-4">Adnan Academy</td>
                    <td class="p-4">
                        <button class="text-blue-600 text-sm">View</button>
                    </td>
                </tr>

                <!-- COACH 2 -->
                <tr class="hover:bg-gray-50">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center font-bold">
                            A
                        </div>
                        <div>
                            <div class="font-semibold">Amit Sir</div>
                            <div class="text-xs text-gray-500">Assistant Coach</div>
                        </div>
                    </td>
                    <td class="p-4">Bowling</td>
                    <td class="p-4">8 Years</td>
                    <td class="p-4 text-yellow-500">4.7 ⭐</td>
                    <td class="p-4">Elite Cricket Hub</td>
                    <td class="p-4">
                        <button class="text-blue-600 text-sm">View</button>
                    </td>
                </tr>

                <!-- COACH 3 -->
                <tr class="hover:bg-gray-50">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center font-bold">
                            S
                        </div>
                        <div>
                            <div class="font-semibold">Suresh Sir</div>
                            <div class="text-xs text-gray-500">Fitness Coach</div>
                        </div>
                    </td>
                    <td class="p-4">Fitness</td>
                    <td class="p-4">10 Years</td>
                    <td class="p-4 text-yellow-500">4.6 ⭐</td>
                    <td class="p-4">PowerPlay Academy</td>
                    <td class="p-4">
                        <button class="text-blue-600 text-sm">View</button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>


    <!-- ACADEMY CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-blue-50 p-5 rounded-xl border">
            <h3 class="font-semibold mb-2">🏟 Adnan Academy</h3>
            <p class="text-sm text-gray-600">Main training ground with 5 pitches</p>
        </div>

        <div class="bg-green-50 p-5 rounded-xl border">
            <h3 class="font-semibold mb-2">🏟 Elite Cricket Hub</h3>
            <p class="text-sm text-gray-600">Advanced bowling machines & nets</p>
        </div>

        <div class="bg-yellow-50 p-5 rounded-xl border">
            <h3 class="font-semibold mb-2">🏟 PowerPlay Academy</h3>
            <p class="text-sm text-gray-600">Fitness & strength training center</p>
        </div>

    </div>

</div>


<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('coachChart'), {
    type: 'bar',
    data: {
        labels: ['Rahul', 'Amit', 'Suresh'],
        datasets: [{
            label: 'Performance Score',
            data: [95, 88, 82],
            backgroundColor: ['#22c55e','#3b82f6','#f59e0b']
        }]
    }
});
</script>

@endsection