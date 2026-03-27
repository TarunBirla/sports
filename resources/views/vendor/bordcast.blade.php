@extends('vendor.layout')

@section('page_title', 'Broadcast Message')

@section('content')

<div class="space-y-6">

    <!-- INFO BOX -->
    <div class="bg-blue-50 border p-4 rounded-xl">
        <p class="text-sm text-blue-700">
            📢 Broadcast allows you to send messages (Email, SMS, Notification) to all users or selected users.
        </p>
    </div>


    <!-- FORM -->
    <div class="bg-white p-6 rounded-xl border shadow-sm">

        <h3 class="font-semibold mb-4">📨 Send Broadcast</h3>

        <!-- SELECT TYPE -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Select Users</label>
            <select id="userType" class="w-full border rounded-lg px-4 py-2">
                <option value="all">All Users</option>
                <option value="single">Single User</option>
                <option value="multiple">Multiple Users</option>
            </select>
        </div>

        <!-- USER LIST -->
        <div id="userSelectBox" class="mb-4 hidden">
            <label class="block text-sm font-medium mb-1">Choose Users</label>

            <select multiple class="w-full border rounded-lg px-4 py-2 h-32">
                <option>Tarun Sharma</option>
                <option>Aman Verma</option>
                <option>Rohit Singh</option>
                <option>Virat Kohli</option>
            </select>
        </div>

        <!-- MESSAGE TYPE -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Send Via</label>

            <div class="flex gap-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox"> Email
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox"> SMS
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox"> Notification
                </label>
            </div>
        </div>

        <!-- SUBJECT -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Subject</label>
            <input type="text" placeholder="Enter subject"
                class="w-full border rounded-lg px-4 py-2">
        </div>

        <!-- MESSAGE -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Message</label>
            <textarea rows="5" placeholder="Write your message..."
                class="w-full border rounded-lg px-4 py-2"></textarea>
        </div>

        <!-- BUTTON -->
        <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
            🚀 Send Broadcast
        </button>

    </div>


    <!-- RECENT BROADCASTS -->
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">

        <div class="p-4 border-b font-semibold">
            📋 Recent Broadcasts
        </div>

        <table class="w-full text-sm">

            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 text-left">Title</th>
                    <th class="p-4 text-left">Sent To</th>
                    <th class="p-4 text-left">Type</th>
                    <th class="p-4 text-left">Date</th>
                    <th class="p-4 text-left">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-semibold">New Training Batch</td>
                    <td class="p-4">All Users</td>
                    <td class="p-4">Email</td>
                    <td class="p-4">26 Mar 2026</td>
                    <td class="p-4">
                        <span class="bg-green-100 text-green-600 px-2 py-1 text-xs rounded">
                            Sent
                        </span>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-semibold">Match Schedule</td>
                    <td class="p-4">Selected Users</td>
                    <td class="p-4">SMS</td>
                    <td class="p-4">25 Mar 2026</td>
                    <td class="p-4">
                        <span class="bg-yellow-100 text-yellow-600 px-2 py-1 text-xs rounded">
                            Pending
                        </span>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>


<!-- SCRIPT -->
<script>
document.getElementById('userType').addEventListener('change', function() {
    let box = document.getElementById('userSelectBox');
    if (this.value === 'single' || this.value === 'multiple') {
        box.classList.remove('hidden');
    } else {
        box.classList.add('hidden');
    }
});
</script>

@endsection