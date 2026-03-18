@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 shadow">
    <h2 class="text-xl font-bold mb-4">User Login</h2>

    @if(session('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input name="email" placeholder="Email" class="w-full border p-2 mb-2">
        <input name="password" type="password" placeholder="Password" class="w-full border p-2 mb-2">

        <button class="bg-blue-500 text-white w-full p-2">Login</button>
    </form>
</div>

@endsection