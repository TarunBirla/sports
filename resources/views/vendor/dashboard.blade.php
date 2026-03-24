@extends('vendor.layout')

@section('page_title', 'Dashboard')

@section('content')

    <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @if($type == 'training')

            <!-- TOTAL PRODUCTS -->
            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Total Products</p>
                <h2 class="text-2xl font-bold text-green-600">
                    {{ $totalProducts }}
                </h2>
            </div>

            <!-- TOTAL ORDERS -->
            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Total Orders</p>
                <h2 class="text-2xl font-bold text-blue-600">
                    {{ $totalOrders }}
                </h2>
            </div>

            <!-- CATEGORY -->
            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Categories</p>
                <h2 class="text-2xl font-bold text-yellow-600">
                    {{ $totalCategories }}
                </h2>
            </div>

        @endif


        @if($type == 'course')

            <!-- TOTAL COURSES -->
            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Total Trainings</p>
                <h2 class="text-2xl font-bold text-green-600">
                    {{ $totalCourses }}
                </h2>
            </div>

            <!-- TOTAL ORDERS -->
            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Total Orders</p>
                <h2 class="text-2xl font-bold text-blue-600">
                    {{ $totalOrders }}
                </h2>
            </div>

            <!-- CATEGORY -->
            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Categories</p>
                <h2 class="text-2xl font-bold text-yellow-600">
                    {{ $totalCategories }}
                </h2>
            </div>

        @endif

    </div>

@endsection