@extends('vendor.layout')

@section('content')

<h2 class="text-2xl font-bold mb-4">Dashboard</h2>

<div class="grid grid-cols-3 gap-4">

    <div class="bg-white p-4 shadow">
        <h3>Total Trainings</h3>
        <p class="text-xl font-bold">10</p>
    </div>

    <div class="bg-white p-4 shadow">
        <h3>Total Sales</h3>
        <p class="text-xl font-bold">₹5000</p>
    </div>

</div>

@endsection