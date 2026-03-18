@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 shadow">
    <h2 class="text-xl font-bold mb-4">Vendor Login</h2>

    <form method="POST" action="/vendor/login">
        @csrf

        <input type="email" name="email" placeholder="Email"
            class="w-full border p-2 mb-3">

        <input type="password" name="password" placeholder="Password"
            class="w-full border p-2 mb-3">

        <button class="bg-blue-500 text-white w-full p-2">
            Login
        </button>
    </form>

</div>

@endsection