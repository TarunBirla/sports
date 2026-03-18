@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white shadow-lg p-6 rounded">

    <h2 class="text-xl font-bold mb-4 text-center">
        Vendor Register
    </h2>

    <form method="POST" action="/vendor/register">
        @csrf

        <input type="text" name="name" placeholder="Name"
            class="w-full border p-2 mb-3">

        <input type="email" name="email" placeholder="Email"
            class="w-full border p-2 mb-3">

        <input type="password" name="password" placeholder="Password"
            class="w-full border p-2 mb-3">

        <select name="type" class="w-full border p-2 mb-3">
            <option value="training">Training Vendor</option>
            <option value="course">Course Vendor</option>
        </select>

        <button class="w-full bg-green-500 text-white p-2 rounded">
            Register
        </button>
    </form>

</div>

@endsection