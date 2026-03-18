@extends('vendor.layout')

@section('content')

<h2 class="text-xl mb-4">Edit Course</h2>

<form method="POST" action="/vendor/course/update/{{ $course->id }}">
@csrf

<input name="title" value="{{ $course->title }}" class="border p-2 w-full mb-2">
<input name="price" value="{{ $course->price }}" class="border p-2 w-full mb-2">
<textarea name="description" class="border p-2 w-full mb-2">
{{ $course->description }}
</textarea>

<button class="bg-blue-500 text-white p-2">Update</button>

</form>

@endsection