@extends('dashboard.layouts.app')

@section('content')

<div class="max-w-5xl mx-auto py-6 space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-blue-600 to-green-500 text-white p-5 rounded-xl">
        <h2 class="text-xl font-bold">📢 Broadcast Messages</h2>
        {{-- <p class="text-sm opacity-90">Send message to Admin, Coach or Support Team</p> --}}
    </div>

    <!-- FORM -->
    {{-- <div class="bg-white p-6 rounded-xl border shadow-sm">

        <h3 class="font-semibold mb-4">📨 Send Message</h3>

        <!-- SELECT RECEIVER -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Send To</label>

            <select id="receiverType" class="w-full border rounded-lg px-4 py-2">
                <option value="admin">Admin</option>
                <option value="coach">Coach</option>
                <option value="support">Support Team</option>
            </select>
        </div>

        <!-- SELECT COACH -->
        <div id="coachBox" class="mb-4 hidden">
            <label class="block text-sm font-medium mb-1">Select Coach</label>

            <div class="border rounded-lg p-3 bg-gray-50 space-y-2">

                <label class="flex items-center gap-2">
                    <input type="radio" name="coach" value="1">
                    Rahul Sir (Batting)
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="coach" value="2">
                    Amit Sir (Bowling)
                </label>

                <label class="flex items-center gap-2">
                    <input type="radio" name="coach" value="3">
                    Suresh Sir (Fitness)
                </label>

            </div>
        </div>

        <!-- SEND VIA -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Send Via</label>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">

                <label class="flex items-center gap-2 bg-gray-100 p-2 rounded">
                    <input type="checkbox" class="channel" value="email">
                    📧 Email
                </label>

                <label class="flex items-center gap-2 bg-gray-100 p-2 rounded">
                    <input type="checkbox" class="channel" value="whatsapp">
                    💬 WhatsApp
                </label>

                <label class="flex items-center gap-2 bg-gray-100 p-2 rounded">
                    <input type="checkbox" class="channel" value="notification">
                    🔔 Notification
                </label>

            </div>
        </div>

        <!-- SUBJECT -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Subject</label>
            <input id="subject" type="text" class="w-full border rounded-lg px-4 py-2"
                placeholder="Enter subject">
        </div>

        <!-- MESSAGE -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Message</label>
            <textarea id="message" rows="4" class="w-full border rounded-lg px-4 py-2"
                placeholder="Write your message..."></textarea>
        </div>

        <!-- BUTTON -->
        <button onclick="sendUserMessage()" 
            class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
            🚀 Send Message
        </button>

    </div> --}}

    <!-- RECENT MESSAGES -->
    <div class="bg-white rounded-xl border shadow-sm">

        <div class="p-4 border-b font-semibold">
            📋 Recent Messages
        </div>

        <table class="w-full text-sm">

            {{-- <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 text-left">To</th>
                    <th class="p-4 text-left">Subject</th>
                    <th class="p-4 text-left">Type</th>
                    <th class="p-4 text-left">Status</th>
                </tr>
            </thead> --}}

            <tbody class="divide-y">

            @forelse($messages as $msg)
            <tr>
                <td class="p-4">{{ $msg->subject ?? 'No Subject' }}</td>
                
                <td class="p-4">
                    {{ $msg->message ?? 'No message' }}
                </td>

                <td class="p-4">
                    Message
                </td>
                
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">
                    No messages found
                </td>
            </tr>
            @endforelse

</tbody>

        </table>

    </div>

</div>

<!-- SCRIPT -->
<script>

// SHOW COACH LIST
document.getElementById('receiverType').addEventListener('change', function () {

    let coachBox = document.getElementById('coachBox');

    if (this.value === 'coach') {
        coachBox.classList.remove('hidden');
    } else {
        coachBox.classList.add('hidden');
    }
});

// SEND FUNCTION
function sendUserMessage() {

    let channels = [];
    let coach = document.querySelector('input[name="coach"]:checked');

    document.querySelectorAll('.channel:checked').forEach(c => {
        channels.push(c.value);
    });

    let data = {
        receiver: document.getElementById('receiverType').value,
        coach_id: coach ? coach.value : null,
        channels: channels,
        subject: document.getElementById('subject').value,
        message: document.getElementById('message').value
    };

    console.log(data);

    alert("✅ Message Sent (Demo)\nCheck console");
}

</script>

@endsection