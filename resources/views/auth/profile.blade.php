@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 shadow">
    <h2 class="text-xl font-bold">Profile</h2>

    <p>Name: {{ auth()->user()->name }}</p>
    <p>Email: {{ auth()->user()->email }}</p>

    <a href="/logout" class="text-red-500">Logout</a>
</div>

@endsection