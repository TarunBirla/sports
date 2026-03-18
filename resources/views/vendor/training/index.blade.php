@extends('vendor.layout')

@section('content')

<h2 class="text-xl mb-4">My Trainings</h2>

<a href="/vendor/training/create" class="bg-green-500 text-white px-3 py-1">
    Add Training
</a>

<table class="w-full mt-4 border">
<tr class="bg-gray-200">
    <th>Title</th>
    <th>Price</th>
    <th>Action</th>
</tr>

@foreach($products as $p)
<tr class="border">
    <td>{{ $p->title }}</td>
    <td>{{ $p->price }}</td>
    <td>
        <a href="/vendor/training/edit/{{ $p->id }}" class="text-blue-500">Edit</a>
        |
        <a href="/vendor/training/delete/{{ $p->id }}" class="text-red-500">Delete</a>
    </td>
</tr>
@endforeach

</table>

@endsection