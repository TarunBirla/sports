@extends('layouts.app')

@section('content')

<!-- Trainings -->
<h2 class="text-2xl font-bold mb-6 text-gray-800">
    🏋️ Trainings
</h2>

<div class="grid md:grid-cols-3 gap-6">

@foreach($products as $p)
<div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">

    <div class="h-40 bg-gray-200 rounded mb-4 flex items-center justify-center">
        <span class="text-gray-400">Image</span>
    </div>

    <h3 class="text-lg font-semibold text-gray-800">
        {{ $p->title }}
    </h3>

    <p class="text-gray-500 text-sm mt-1">
        {{ $p->description }}
    </p>

    <div class="flex justify-between items-center mt-4">

        <span class="text-xl font-bold text-green-600">
            ₹{{ $p->price }}
        </span>

        <a href="/cart/add/training/{{ $p->id }}"
           class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
            Add
        </a>

    </div>
</div>
@endforeach

</div>


<!-- Courses -->
<h2 class="text-2xl font-bold mt-10 mb-6 text-gray-800">
    📚 Courses
</h2>

<div class="grid md:grid-cols-3 gap-6">

@foreach($courses as $c)
<div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">

    <div class="h-40 bg-gray-200 rounded mb-4 flex items-center justify-center">
        <span class="text-gray-400">Image</span>
    </div>

    <h3 class="text-lg font-semibold text-gray-800">
        {{ $c->title }}
    </h3>

    <p class="text-gray-500 text-sm mt-1">
        {{ $c->description }}
    </p>

    <div class="flex justify-between items-center mt-4">

        <span class="text-xl font-bold text-blue-600">
            ₹{{ $c->price }}
        </span>

        <a href="/cart/add/course/{{ $c->id }}"
           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
            Add
        </a>

    </div>
</div>
@endforeach

</div>

@endsection