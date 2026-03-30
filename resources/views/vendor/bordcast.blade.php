@extends('vendor.layout')

@section('page_title', 'Broadcast Message')

@section('content')

<div class="space-y-6">

    <!-- INFO -->
    <div class="bg-blue-50 border p-4 rounded-xl">
        <p class="text-sm text-blue-700">
            📢 Send Email, SMS, WhatsApp or Notification to users
        </p>
    </div>

    <!-- FORM -->
    <div class="bg-white p-6 rounded-xl border shadow-sm">

        <h3 class="font-semibold mb-4">📨 Send Broadcast</h3>

        <!-- USER TYPE -->
        {{-- <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Select Users</label>

            <select id="userType" class="w-full border rounded-lg px-4 py-2">
                <option value="all">All Users</option>
                <option value="single">Single User</option>
                <option value="multiple">Multiple Users</option>
            </select>
        </div> --}}

        <!-- USER SELECTION -->
        <div id="userSelectBox" class="mb-4 hidden">

            <!-- SELECT ALL -->
            <div class="flex items-center justify-between mb-2">
                <label class="text-sm font-medium">Choose Users</label>

                <div class="flex gap-3 text-sm">
                    <label class="flex items-center gap-1 cursor-pointer">
                        <input type="checkbox" id="selectAllUsers">
                        All
                    </label>
                </div>
            </div>

            <!-- USER LIST -->
            <div class="border rounded-lg p-3 max-h-40 overflow-y-auto bg-gray-50 space-y-2">

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="userCheckbox" value="1">
                    Tarun Sharma
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="userCheckbox" value="2">
                    Aman Verma
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="userCheckbox" value="3">
                    Rohit Singh
                </label>

                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="userCheckbox" value="4">
                    Virat Kohli
                </label>

            </div>

        </div>

        <!-- SEND VIA -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Send Via</label>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

                <label class="flex items-center gap-2 bg-gray-100 p-2 rounded cursor-pointer">
                    <input type="checkbox" class="channel" value="email">
                    📧 Email
                </label>

                <label class="flex items-center gap-2 bg-gray-100 p-2 rounded cursor-pointer">
                    <input type="checkbox" class="channel" value="sms">
                    📱 SMS
                </label>

                <label class="flex items-center gap-2 bg-gray-100 p-2 rounded cursor-pointer">
                    <input type="checkbox" class="channel" value="whatsapp">
                    💬 WhatsApp
                </label>

                <label class="flex items-center gap-2 bg-gray-100 p-2 rounded cursor-pointer">
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
                placeholder="Write message..."></textarea>
        </div>

        <!-- BUTTON -->
        <button onclick="sendBroadcast()" 
            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
            🚀 Send Broadcast
        </button>

    </div>

    <!-- RECENT -->
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">

        <div class="p-4 border-b font-semibold">
            📋 Recent Broadcasts
        </div>

        <table class="w-full text-sm">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 text-left">Title</th>
                    <th class="p-4 text-left">Users</th>
                    <th class="p-4 text-left">Type</th>
                    <th class="p-4 text-left">Status</th>
                </tr>
            </thead>

           <tbody class="divide-y">

                @forelse($messages as $msg)
                <tr>
                    <!-- Title -->
                    <td class="p-4 font-semibold">
                        {{ $msg->subject ?? 'No Subject' }}
                    </td>

                    <!-- Users (static for now) -->
                    <td class="p-4">
                        All
                    </td>

                    <!-- Type (static for now) -->
                    <td class="p-4">
                        Message
                    </td>

                    <!-- Status -->
                    <td class="p-4 
                        @if($msg->status == 'sent') text-green-600
                        @elseif($msg->status == 'pending') text-yellow-500
                        @else text-red-600
                        @endif">
                        
                        {{ ucfirst($msg->status) }}
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">
                        No broadcasts found
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- SCRIPT -->
<script>

const userType = document.getElementById('userType');
const userBox = document.getElementById('userSelectBox');
const selectAll = document.getElementById('selectAllUsers');

// SHOW / HIDE
userType.addEventListener('change', function () {
    if (this.value === 'single' || this.value === 'multiple') {
        userBox.classList.remove('hidden');
    } else {
        userBox.classList.add('hidden');
    }
});

// SELECT ALL
selectAll.addEventListener('change', function () {
    document.querySelectorAll('.userCheckbox').forEach(cb => {
        cb.checked = this.checked;
    });
});

// INDIVIDUAL CHECK
document.querySelectorAll('.userCheckbox').forEach(cb => {
    cb.addEventListener('change', function () {

        let all = true;

        document.querySelectorAll('.userCheckbox').forEach(c => {
            if (!c.checked) all = false;
        });

        selectAll.checked = all;
    });
});

// FINAL SUBMIT
/*function sendBroadcast() {

    let users = [];
    let channels = [];

    // users
    document.querySelectorAll('.userCheckbox:checked').forEach(cb => {
        users.push(cb.value);
    });

    // channels
    document.querySelectorAll('.channel:checked').forEach(c => {
        channels.push(c.value);
    });

    let data = {
        userType: userType.value,
        users: users,
        channels: channels,
        subject: document.getElementById('subject').value,
        message: document.getElementById('message').value
    };

    console.log(data);

    alert("✅ Broadcast Ready!\nCheck console for data");
}*/

function sendBroadcast() {

    let data = {
        subject: document.getElementById('subject').value,
        message: document.getElementById('message').value
    };

    // validation
    if (!data.message) {
        alert("❌ Message is required");
        return;
    }

    fetch("{{ url('/vendor/bordcast') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            alert("✅ Broadcast Sent Successfully!");

            // clear form
            document.getElementById('subject').value = '';
            document.getElementById('message').value = '';

            // optional: reload page
            location.reload();
        } else {
            alert("❌ Something went wrong");
        }
    })
    .catch(err => {
        console.error(err);
        alert("❌ Server Error");
    });
}

</script>

@endsection