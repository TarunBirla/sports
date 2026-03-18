@extends('vendor.layout')

@section('content')

<h2 class="text-xl mb-4">Edit Training</h2>

<form method="POST" action="/vendor/training/update/{{ $product->id }}">
@csrf

<input name="title" value="{{ $product->title }}" class="border p-2 w-full mb-2">
<input name="price" value="{{ $product->price }}" class="border p-2 w-full mb-2">
<textarea name="description" class="border p-2 w-full mb-2">
{{ $product->description }}
</textarea>

<button class="bg-blue-500 text-white p-2">Update</button>

</form>

@endsection