@extends('vendor.layout')

@section('content')

<h2 class="text-xl mb-4">Add Training</h2>

<form method="POST" action="/vendor/training/store">
@csrf

<input name="title" placeholder="Title" class="border p-2 w-full mb-2">
<input name="price" placeholder="Price" class="border p-2 w-full mb-2">
<textarea name="description" placeholder="Description" class="border p-2 w-full mb-2"></textarea>

<button class="bg-green-500 text-white p-2">Save</button>

</form>

@endsection