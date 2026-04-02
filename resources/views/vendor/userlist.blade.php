@extends('vendor.layout')

@section('page_title', 'User List')

@section('content')

    <div class="space-y-6">
        <div
            class="bg-white p-4 rounded-xl border shadow-sm flex flex-col md:flex-row gap-4 md:items-center md:justify-between">

            <form method="GET" class="mb-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..."
                    class="border rounded-lg px-4 py-2 w-full ">
            </form>

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
                        <th class="p-4 text-left">Phone</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-left">Joined</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-semibold">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500">Customer</div>
                                </div>
                            </td>

                            <td class="p-4">{{ $user->email }}</td>

                            <td class="p-4">N/A</td>

                            <td class="p-4">
                                <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded">
                                    Active
                                </span>
                            </td>

                            <td class="p-4">
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>


        <!-- PAGINATION -->
        <div class="flex justify-between items-center text-sm text-gray-600">

            <span>Showing 1 to 3 of 1,245 users</span>

            <div class="flex gap-2">
                <button class="px-3 py-1 border rounded">Prev</button>
                <button class="px-3 py-1 bg-blue-600 text-white rounded">1</button>
                <button class="px-3 py-1 border rounded">2</button>
                <button class="px-3 py-1 border rounded">Next</button>
            </div>

        </div>

    </div>

@endsection