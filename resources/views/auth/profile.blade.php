@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 py-10">

    <div class="max-w-4xl mx-auto px-4">

        <!-- CARD -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <!-- HEADER -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-32 relative">
                <div class="absolute -bottom-12 left-6">
                    <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center shadow-lg text-3xl">
                        👤
                    </div>
                </div>
            </div>

            <!-- BODY -->
            <div class="pt-16 pb-6 px-6">

                <!-- NAME + EMAIL -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ auth()->user()->name }}
                    </h2>
                    <p class="text-gray-500 text-sm">
                        {{ auth()->user()->email }}
                    </p>
                </div>

                <!-- INFO GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500">Full Name</p>
                        <p class="font-semibold text-gray-800">
                            {{ auth()->user()->name }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500">Email Address</p>
                        <p class="font-semibold text-gray-800">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500">Account Type</p>
                        <p class="font-semibold text-gray-800">
                            User
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-xs text-gray-500">Joined</p>
                        <p class="font-semibold text-gray-800">
                            {{ auth()->user()->created_at->format('d M Y') }}
                        </p>
                    </div>

                </div>

                <!-- ACTION BUTTONS -->
                <div class="flex items-center gap-3">

                    <a href="#"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">
                        Edit Profile
                    </a>

                    <a href="/logout"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm hover:bg-red-600 transition">
                        Logout
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection