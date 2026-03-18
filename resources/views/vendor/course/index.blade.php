@extends('vendor.layout')

@section('content')

<h2 class="text-xl mb-4">My Courses</h2>

<a href="/vendor/course/create" class="bg-blue-500 text-white px-3 py-1">
    Add Course
</a>

<table class="w-full mt-4 border">
<tr class="bg-gray-200">
    <th>Title</th>
    <th>Price</th>
    <th>Action</th>
</tr>

@foreach($courses as $c)
<tr class="border">
    <td>{{ $c->title }}</td>
    <td>{{ $c->price }}</td>
    <td>
        <a href="/vendor/course/edit/{{ $c->id }}" class="text-blue-500">Edit</a>
        |
        <a href="/vendor/course/delete/{{ $c->id }}" class="text-red-500">Delete</a>
    </td>
</tr>
@endforeach

</table>

@endsection