@extends('vendor.layout')

@section('page_title', 'User List')

@section('content')

<div class="space-y-6">

    <!-- TOP STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Total Users</p>
            <h2 class="text-2xl font-bold mt-1">1,245</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">Active Users</p>
            <h2 class="text-2xl font-bold mt-1 text-green-600">1,032</h2>
        </div>

        <div class="bg-white p-5 rounded-xl border shadow-sm">
            <p class="text-sm text-gray-500">New This Month</p>
            <h2 class="text-2xl font-bold mt-1 text-blue-600">+86</h2>
        </div>

    </div>


    <!-- SEARCH + FILTER -->
    <div class="bg-white p-4 rounded-xl border shadow-sm flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

        <input type="text" placeholder="Search users..."
            class="border rounded-lg px-4 py-2 w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-400">

        <select class="border rounded-lg px-4 py-2">
            <option>All Users</option>
            <option>Active</option>
            <option>Inactive</option>
        </select>

    </div>


    <!-- USER TABLE -->
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-4 text-left">User</th>
                    <th class="p-4 text-left">Email</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Joined</th>
                    <th class="p-4 text-left">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                <!-- USER 1 -->
                @foreach ($allusers as $user)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-bold">
                            A
                        </div>
                          <div>
                            <div class="font-semibold"> {{ $user->name }} </div>
                            <div class="text-xs text-gray-500">Cricket Player</div>
                        </div>
                    </td>
                    <td class="p-4"> {{ $user->email }} </td>
                    <td class="p-4">Active</td>
                    <td class="p-4"> {{ date('M j, Y', strtotime($user->created_at)) }}  </td>
                    <td class="p-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ url('/student-stats/'.$user->id) }}" class="btn btn-primary">Enter Stats</a>
                            <a href="{{ url('/student-stats/list/'.$user->id) }}" class="btn btn-secondary">Stats List</a>      
                        </div>

                    </td>

                @endforeach
            </tbody>
        </table>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('form[action*="trainer.stats.store"]');

    if (!form) {
        console.log('Form not found');
        return;
    }

    form.addEventListener('submit', function (e) {

        console.log('FORM SUBMIT TRIGGERED'); // 🔥 DEBUG

        const inputs = this.querySelectorAll('input[type="number"]');
        let hasValues = false;

        inputs.forEach(input => {
            if (input.value !== '') {
                hasValues = true;
            }
        });

        if (!hasValues) {
            e.preventDefault();
            alert('Please enter at least one value before submitting.');
        }
    });

});
    </script>
      

@endsection