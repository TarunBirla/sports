@extends('dashboard.layouts.app')

@section('content')
    <!-- MAIN CONTENT -->







    <!-- Title -->

    <h2 class="text-xl font-semibold mb-6">

        📊 Performance

        <span class="text-yellow-500">
            Analytics
        </span>

    </h2>



    <!-- Charts -->

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Batting -->

        <div class="bg-white p-6 rounded-xl shadow">

            <h3 class="font-semibold mb-4">
                Batting Performance
            </h3>

            <canvas id="battingChart"></canvas>

        </div>



        <!-- Bowling -->

        <div class="bg-white p-6 rounded-xl shadow">

            <h3 class="font-semibold mb-4">
                Bowling Performance
            </h3>

            <canvas id="bowlingChart"></canvas>

        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-10">

        <!-- Fitness Tracking -->

        <div class="bg-white p-6 rounded-xl shadow">

            <h3 class="font-semibold text-lg mb-4 flex items-center gap-2">
                📊 Fitness Tracking
            </h3>

            <canvas id="fitnessChart"></canvas>

        </div>
        <!-- Training Attendance -->
        <div class="bg-white p-6 rounded-xl shadow">

            <h3 class="font-semibold text-lg mb-4 flex items-center gap-2">
                📅 Training Attendance
            </h3>

            <canvas id="attendanceChart"></canvas>

        </div>
    </div>

    <!-- Match Statistics -->

    <div class="mt-10">

        <h2 class="text-xl font-semibold mb-6 flex items-center gap-2">
            🏏 Match
            <span class="text-yellow-500">
                Statistics
            </span>
        </h2>


        <div class="grid md:grid-cols-4 gap-6">

            <!-- Card -->

            <div class="bg-white p-6 rounded-xl shadow text-center">

                <div class="text-3xl mb-2">
                    🏏
                </div>

                <h3 class="text-3xl font-bold">
                    {{ $performance->total_matches ?? 0 }}
                </h3>

                <p class="text-gray-500">
                    Matches Played
                </p>

            </div>



            <div class="bg-white p-6 rounded-xl shadow text-center">

                <div class="text-3xl mb-2">
                    🏃
                </div>

                <h3 class="text-3xl font-bold">
                    {{ $performance->runs ?? 0 }}
                </h3>

                <p class="text-gray-500">
                    Runs Scored
                </p>

            </div>



            <div class="bg-white p-6 rounded-xl shadow text-center">

                <div class="text-3xl mb-2">
                    🌟
                </div>

                <h3 class="text-3xl font-bold">
                    {{ $performance->high_score ?? 0 }}
                </h3>

                <p class="text-gray-500">
                    Highest Score
                </p>

            </div>



            <div class="bg-white p-6 rounded-xl shadow text-center">

                <div class="text-3xl mb-2">
                    📊
                </div>

                <h3 class="text-3xl font-bold">
                    {{ $performance->batting_average ?? 0 }}
                </h3>

                <p class="text-gray-500">
                    Batting Avg
                </p>

            </div>



            <div class="bg-white p-6 rounded-xl shadow text-center">

                <div class="text-3xl mb-2">
                    ⚡
                </div>

                <h3 class="text-3xl font-bold">
                    {{ $performance->strike_rate ?? 0 }}
                </h3>

                <p class="text-gray-500">
                    Strike Rate
                </p>

            </div>



            <div class="bg-white p-6 rounded-xl shadow text-center">

                <div class="text-3xl mb-2">
                    💯
                </div>

                <h3 class="text-3xl font-bold">
                    {{ $performance->centuries ?? 0 }}
                </h3>

                <p class="text-gray-500">
                    Centuries
                </p>

            </div>



            <div class="bg-white p-6 rounded-xl shadow text-center">

                <div class="text-3xl mb-2">
                    5️⃣
                </div>

                <h3 class="text-3xl font-bold">
                    {{ $performance->half_centuries ?? 0 }}
                </h3>

                <p class="text-gray-500">
                    Half Centuries
                </p>

            </div>



            <div class="bg-white p-6 rounded-xl shadow text-center">

                <div class="text-3xl mb-2">
                    🎯
                </div>

                <h3 class="text-3xl font-bold">
                    {{ $performance->wickets ?? 0 }}
                </h3>

                <p class="text-gray-500">
                    Wickets Taken
                </p>

            </div>
            



            <div class="bg-white p-6 rounded-xl shadow text-center">

                <div class="text-3xl mb-2">
                    🏆
                </div>

                <h3 class="text-3xl font-bold">
                    {{ $performance->best_bowling ?? 0 }}
                </h3>

                <p class="text-gray-500">
                    Best Bowling
                </p>

            </div>



            <div class="bg-white p-6 rounded-xl shadow text-center">

                <div class="text-3xl mb-2">
                    📉
                </div>

                <h3 class="text-3xl font-bold">
                    {{ $performance->economy ?? 0 }}
                </h3>

                <p class="text-gray-500">
                    Economy Rate
                </p>

            </div>



            <div class="bg-white p-6 rounded-xl shadow text-center">

                <div class="text-3xl mb-2">
                    🙌
                </div>

                <h3 class="text-3xl font-bold">
                    {{ $performance->catches ?? 0 }}
                </h3>

                <p class="text-gray-500">
                    Catches
                </p>

            </div>



            <!-- <div class="bg-white p-6 rounded-xl shadow text-center">

                    <div class="text-3xl mb-2">
                        🏃‍♂️
                    </div>

                    <h3 class="text-3xl font-bold">
                        8
                    </h3>

                    <p class="text-gray-500">
                        Run Outs
                    </p>

                    </div> -->

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        // =====================
        // BATTING GRAPH
        // =====================
        new Chart(document.getElementById("battingChart"), {
            type: "line",
            data: {
                labels: @json($labels),
                datasets: [
                    {
                        label: "Runs",
                        data: @json($runsData),
                        borderColor: "green"
                    },
                    {
                        label: "Strike Rate",
                        data: @json($strikeRateData),
                        borderColor: "orange"
                    }
                ]
            }
        });


        // =====================
        // BOWLING GRAPH
        // =====================
        new Chart(document.getElementById("bowlingChart"), {
            type: "bar",
            data: {
                labels: @json($labels),
                datasets: [
                    {
                        label: "Wickets",
                        data: @json($wicketsData),
                        backgroundColor: "green"
                    },
                    {
                        label: "Economy",
                        data: @json($economyData),
                        backgroundColor: "orange"
                    }
                ]
            }
        });


        // =====================
        // FITNESS GRAPH
        // =====================
        new Chart(document.getElementById("fitnessChart"), {
            type: "radar",
            data: {
                labels: [
                    "Speed", "Stamina", "Strength", "Agility", "Flexibility", "Endurance"
                ],
                datasets: [{
                    label: "Fitness Score",
                    data: @json($fitnessData),
                    backgroundColor: "rgba(34,197,94,0.3)",
                    borderColor: "rgb(34,197,94)",
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });


        // =====================
        // ATTENDANCE GRAPH
        // =====================
        new Chart(document.getElementById("attendanceChart"), {
            type: "bar",
            data: {
                labels: @json($attendanceLabels),
                datasets: [{
                    label: "Attendance",
                    data: @json($attendanceData),
                    backgroundColor: "rgb(34,197,94)"
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

    </script>

@endsection