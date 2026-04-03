<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Player Profile</title>

<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 mb-10">

    @php
    $userId = auth()->id();

    //  LATEST PERFORMANCE
    $performance = \App\Models\StudentPerformance::where('user_id', $userId)
        ->latest()
        ->first();
    @endphp
<!-- HEADER -->
<div class="h-64 w-full bg-gradient-to-r from-slate-900 to-green-900">
    <div class="max-w-6xl mx-auto pt-6 px-4">
        <a href="/dashboard" class="text-white">← Back</a>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 -mt-32">
<div class="grid md:grid-cols-3 gap-8">

<!-- LEFT -->
<div class="space-y-6">

<div class="bg-white p-2 rounded-xl shadow">
    <img src="{{ asset('assets/player-batting.jpg') }}" class="rounded-lg h-80 w-full">
</div>

<div class="bg-white p-6 rounded-xl shadow">
    <h2 class="text-xl font-semibold">{{ auth()->user()->name }}</h2>
    <p class="text-green-600">{{ auth()->user()->email }}</p>

    <div class="mt-4 space-y-2 text-sm">

        <div class="flex justify-between">
            <span>Age</span>
            <span>{{ auth()->user()->age ?? '-' }}</span>
        </div>

        <div class="flex justify-between">
            <span>Batting</span>
            <span>{{ auth()->user()->batting ?? '-' }}</span>
        </div>

        <div class="flex justify-between">
            <span>Bowling</span>
            <span>{{ auth()->user()->bowling ?? '-' }}</span>
        </div>

        <div class="flex justify-between">
            <span>Academy</span>
            <span>{{ auth()->user()->academy ?? '-' }}</span>
        </div>

    </div>

    <!-- FIXED BUTTON -->
    {{-- <button onclick="openModal()" 
        class="mt-6 w-full border py-2 rounded hover:bg-gray-100">
        Edit Profile
    </button> --}}

</div>
</div>

<!-- RIGHT -->
<div class="md:col-span-2 space-y-8">

    <!-- STATS -->
    <div>
        <h2 class="text-xl font-semibold mb-4 text-gray-800">
        Career <span class="text-yellow-500">Statistics</span>
        </h2>

        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-xl shadow text-center">
                🏏
                <h3 class="text-2xl font-bold">{{ $performance->total_matches ?? 0 }}</h3>
                <p class="text-gray-500 text-sm">Matches</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow text-center">
                🏃
                <h3 class="text-2xl font-bold">{{ $performance->runs ?? 0 }}</h3>
                <p class="text-gray-500 text-sm">Runs</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow text-center">
                🎯
                <h3 class="text-2xl font-bold">{{ $performance->wickets ?? 0 }}</h3>
                <p class="text-gray-500 text-sm">Wickets</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow text-center">
                ⚡
                <h3 class="text-2xl font-bold">{{ $performance->strike_rate ?? 0 }}</h3>
                <p class="text-gray-500 text-sm">Strike Rate</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow text-center">
                📊
                <h3 class="text-2xl font-bold">{{ $performance->batting_average ?? 0 }}</h3>
                <p class="text-gray-500 text-sm">Average</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow text-center">
                ⭐
                <h3 class="text-2xl font-bold">{{ $performance->high_score ?? 0 }}</h3>
                <p class="text-gray-500 text-sm">Highest</p>
            </div>

        </div>
    </div>

    <!-- Match Highlights -->

      <div>

        <h2 class="text-xl font-semibold mb-4">
            🎬 Match <span class="text-yellow-500">Highlights</span>
        </h2>

        <div class="grid md:grid-cols-2 gap-6">

            @foreach($matches as $match)
            <div class="bg-white p-4 rounded-xl shadow flex gap-4 items-center">

                <!-- Play Button -->
                <div class="bg-blue-100 p-3 rounded-lg cursor-pointer"
                    onclick="openVideoModal('{{ Str::startsWith($match->video_url, 'http') ? $match->video_url : asset($match->video_url) }}')">
                    ▶
                </div>

                <div>
                    <!-- Title -->
                    <h4 class="font-medium">
                        vs {{ $match->opponent_team }} - {{ $match->match_type }}
                    </h4>

                    <!-- Label -->
                    <p class="text-sm text-gray-500">
                        Video Highlight
                    </p>
                </div>

            </div>
            @endforeach

        </div>

    </div>

</div>
</div>
</div>

<!-- VIDEO MODAL -->
<!-- VIDEO MODAL -->
<div id="videoModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">

    <div class="relative w-full max-w-3xl bg-black rounded-lg overflow-hidden">

        <!-- Close -->
        <button onclick="closeVideoModal()" 
            class="absolute top-2 right-2 text-white text-xl z-10">
            ✕
        </button>

        <!-- Video -->
        <video id="videoPlayer" controls class="w-full h-[400px]">
            <source id="videoSource" src="" type="video/mp4">
        </video>

    </div>
</div>

<script>
function openVideoModal(videoUrl) {
    let modal = document.getElementById('videoModal');
    let video = document.getElementById('videoPlayer');
    let source = document.getElementById('videoSource');

    source.src = videoUrl;
    video.load();
    video.play();

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeVideoModal() {
    let modal = document.getElementById('videoModal');
    let video = document.getElementById('videoPlayer');

    video.pause();
    video.currentTime = 0;

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

<!-- MODAL -->
<div id="profileModal"
class="fixed inset-0 bg-black bg-opacity-50 hidden items-start justify-center z-50">

<div class="bg-white w-full max-w-3xl mt-20 rounded-xl p-6">

<div class="flex justify-between mb-4">
    <h2 class="text-lg font-bold">Update Profile</h2>
    <button onclick="closeModal()">✕</button>
</div>

<form method="POST" action="/update-profile">
@csrf

<div class="grid md:grid-cols-2 gap-4">

<input name="age" value="{{ auth()->user()->age }}" placeholder="Age" class="border p-2 rounded">

<input name="academy" value="{{ auth()->user()->academy }}" placeholder="Academy" class="border p-2 rounded">

<input name="batting" value="{{ auth()->user()->batting }}" placeholder="Batting" class="border p-2 rounded">

<input name="bowling" value="{{ auth()->user()->bowling }}" placeholder="Bowling" class="border p-2 rounded">

<input name="total_matches" value="{{ auth()->user()->total_matches }}" placeholder="Matches" class="border p-2 rounded">

<input name="runs" value="{{ auth()->user()->runs }}" placeholder="Runs" class="border p-2 rounded">

<input name="wickets" value="{{ auth()->user()->wickets }}" placeholder="Wickets" class="border p-2 rounded">

<input name="strike_rate" value="{{ auth()->user()->strike_rate }}" placeholder="Strike Rate" class="border p-2 rounded">

<input name="batting_average" value="{{ auth()->user()->batting_average }}" placeholder="Average" class="border p-2 rounded">

<input name="high_score" value="{{ auth()->user()->high_score }}" placeholder="High Score" class="border p-2 rounded">

</div>

<div class="flex gap-3 mt-6">
<button class="bg-blue-600 text-white px-4 py-2 rounded w-full">Update</button>
<button type="button" onclick="closeModal()" class="border px-4 py-2 rounded w-full">Cancel</button>
</div>

</form>
</div>
</div>

<script>
function openModal(){
    document.getElementById('profileModal').classList.remove('hidden');
    document.getElementById('profileModal').classList.add('flex');
}

function closeModal(){
    document.getElementById('profileModal').classList.add('hidden');
}
</script>

</body>
</html>