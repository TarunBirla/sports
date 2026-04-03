@extends('vendor.layout')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">📅 Upcoming Matches</h2>
        <a href="{{ route('vendor.matches.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            + Add Match
        </a>
    </div>

    @foreach($matches as $match)
    <div class="bg-white shadow rounded-xl p-5 mb-4 flex justify-between items-center">

        <div>
            <p class="text-green-600 font-semibold">
                {{ \Carbon\Carbon::parse($match->match_date)->format('M d') }}
            </p>

            <h3 class="text-lg font-semibold">
                vs {{ $match->opponent_team }}
            </h3>

            <p class="text-gray-500 text-sm">
                {{ $match->venue }}
            </p>
        </div>

        <div class="flex items-center gap-3">
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                {{ $match->match_type }}
            </span>

            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                {{ $match->status }}
            </span>

            <a href="{{ route('vendor.matches.edit', $match->id) }}"
                class="text-blue-600 text-sm font-semibold">
                Edit
            </a>
            <button 
                onclick="openStatusModal({{ $match->id }})"
                class="bg-purple-600 text-white px-3 py-1 rounded text-sm">
                Update Status
            </button>
        </div>
    </div>
    @endforeach

</div>


<!-- STATUS MODAL -->
<div id="statusModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-md rounded-xl p-6 relative">

        <!-- Close -->
        <button onclick="closeStatusModal()" class="absolute top-2 right-3 text-xl">✕</button>

        <h3 class="text-lg font-semibold mb-4">Update Match Status</h3>

        <form id="statusForm" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Status -->
            <select name="status" class="border p-2 w-full mb-3">
                <option value="upcoming">Upcoming</option>
                <option value="complete">Complete</option>
            </select>

            <!-- Video URL -->
            <input type="text" name="video_url" placeholder="Enter video URL"
                class="border p-2 w-full mb-3">

            <!-- File Upload -->
            <input type="file" name="video_file" class="border p-2 w-full mb-4">

            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                Update
            </button>
        </form>

    </div>
</div>

<script>
    function openStatusModal(matchId) {
        let modal = document.getElementById('statusModal');
        let form = document.getElementById('statusForm');

        form.action = `/vendor/matches/${matchId}/update-status`; // dynamic route
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeStatusModal() {
        let modal = document.getElementById('statusModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

@endsection