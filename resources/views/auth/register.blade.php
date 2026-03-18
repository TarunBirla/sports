@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 shadow">
    <h2 class="text-xl font-bold mb-4">User Register</h2>

    <form method="POST" action="/register">
        @csrf

        <input name="name" placeholder="Name" class="w-full border p-2 mb-2">
        <input name="email" placeholder="Email" class="w-full border p-2 mb-2">
        <input name="password" type="password" placeholder="Password" class="w-full border p-2 mb-2">

        <button class="bg-green-500 text-white w-full p-2">Register</button>
    </form>
</div>

@endsection