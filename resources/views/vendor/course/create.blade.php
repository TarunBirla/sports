@extends('vendor.layout')

@section('content')

<h2 class="text-xl mb-4">Add Course</h2>

<form method="POST" action="/vendor/course/store">
@csrf

<input name="title" placeholder="Title" class="border p-2 w-full mb-2">
<input name="price" placeholder="Price" class="border p-2 w-full mb-2">
<textarea name="description" placeholder="Description" class="border p-2 w-full mb-2"></textarea>

<button class="bg-blue-500 text-white p-2">Save</button>

</form>

@endsection