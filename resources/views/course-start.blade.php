@extends('layouts.app')

@section('content')

<div class="bg-gray-100">

    <div class="max-w-7xl mx-auto px-4 py-12 mb-10">

        <div class="grid md:grid-cols-4 gap-6">

            <!-- LEFT MENU -->
            <div class="bg-white rounded-xl shadow p-4">
                <ul class="space-y-2 text-sm">
                    <li><a href="/profile?tab=dashboard" class="block px-4 py-2 rounded-lg hover:bg-gray-100">📊 Dashboard</a></li>
                    <li><a href="/profile?tab=profile" class="block px-4 py-2 rounded-lg hover:bg-gray-100">👤 Profile</a></li>
                    <li><a href="/profile?tab=orders" class="block px-4 py-2 rounded-lg hover:bg-gray-100">📦 Orders</a></li>
                    <li><a href="/profile?tab=downloads" class="block px-4 py-2 rounded-lg hover:bg-gray-100">⬇ Downloads</a></li>
                    <li><a href="/profile?tab=address" class="block px-4 py-2 rounded-lg hover:bg-gray-100">📍 Addresses</a></li>
                    <li><a href="/profile?tab=payment" class="block px-4 py-2 rounded-lg hover:bg-gray-100">⚙ Packages</a></li>
                    <li><a href="/profile?tab=account" class="block px-4 py-2 rounded-lg hover:bg-gray-100">⚙ Account</a></li>
                    <li><a href="/logout" class="block px-4 py-2 rounded-lg text-red-500 hover:bg-red-50">🚪 Logout</a></li>
                </ul>
            </div>

            <!-- MAIN -->
            <div class="md:col-span-3">

                <!-- HEADER -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-2xl font-semibold">{{ $course->title }}</h1>
                        <p class="text-gray-500">{{ $course->description }}</p>
                    </div>
                    <div class="text-green-600 font-medium">📈 Performance Dashboard</div>
                </div>

                <!-- 🔥 DYNAMIC PERFORMANCE GRAPH -->
                <div class="bg-white p-6 rounded-xl shadow mb-8">
                    <h3 class="font-semibold mb-4">📊 Performance Overview</h3>
                    <canvas id="dynamicChart"></canvas>
                </div>

                <!-- FITNESS + ATTENDANCE -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <!-- FITNESS -->
                    <div class="bg-white p-6 rounded-xl shadow">
                        <h3 class="font-semibold mb-4">💪 Fitness Tracking</h3>
                        <canvas id="fitnessChart"></canvas>
                    </div>

                    <!-- ATTENDANCE -->
                    <div class="bg-white p-6 rounded-xl shadow">
                        <h3 class="font-semibold mb-4">📅 Attendance</h3>
                        <canvas id="attendanceChart"></canvas>
                    </div>

                </div>

                <!-- 🔥 DYNAMIC STATS CARDS -->
                <div class="mt-10">
                    <h2 class="text-xl font-semibold mb-6">
                        📊 {{ $category->name }} Statistics
                    </h2>

                    <div class="grid md:grid-cols-4 gap-6">
                        @foreach($fields as $field)
                            <div class="bg-white p-6 rounded-xl shadow text-center">
                                <h3 class="text-2xl font-bold">
                                    {{ $values[$field->id] ?? 0 }}
                                </h3>
                                <p class="text-gray-500">{{ $field->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- ===================== SCRIPTS ===================== --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = @json($chartLabels);
    const data = @json($chartData);
    const fitness = @json($fitness);
    const attendance = @json($attendance);

    // 🔥 PERFORMANCE GRAPH (DYNAMIC)
    const colors = [];
for(let i = 0; i < data.length; i++){
    colors.push(i % 2 === 0 ? "rgba(37, 99, 235, 0.6)" : "rgba(234, 179, 8, 0.6)");
}
    new Chart(document.getElementById("dynamicChart"), {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Performance",
                data: data,
                backgroundColor: colors
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

    // 💪 FITNESS GRAPH
    new Chart(document.getElementById("fitnessChart"), {
        type: "radar",
        data: {
            labels: ["Speed","Stamina","Strength","Agility","Flexibility","Endurance"],
            datasets: [{
                label: "Fitness",
                data: [
                    fitness?.speed ?? 0,
                    fitness?.stamina ?? 0,
                    fitness?.strength ?? 0,
                    fitness?.agility ?? 0,
                    fitness?.flexibility ?? 0,
                    fitness?.endurance ?? 0
                ],
                backgroundColor: "rgba(34,197,94,0.3)",
                borderColor: "rgb(34,197,94)"
            }]
        },
        options: {
            scales: {
                r: { beginAtZero: true, max: 100 }
            }
        }
    });

    // 📅 ATTENDANCE GRAPH
    const attendanceData = {
        W1:0,W2:0,W3:0,W4:0,W5:0,W6:0,W7:0,W8:0
    };

    attendance.forEach(item => {
        attendanceData[item.week] = item.attendance_count ?? item.attendance ?? 0;
    });

    new Chart(document.getElementById("attendanceChart"), {
        type: "bar",
        data: {
            labels: ["M1","M2","M3","M4","M5","M6","M7","M8"],
            datasets: [{
                label: "Attendance",
                data: [
                    attendanceData.W1,
                    attendanceData.W2,
                    attendanceData.W3,
                    attendanceData.W4,
                    attendanceData.W5,
                    attendanceData.W6,
                    attendanceData.W7,
                    attendanceData.W8
                ],
                backgroundColor: "rgb(34,197,94)"
            }]
        }
    });
</script>

@endsection