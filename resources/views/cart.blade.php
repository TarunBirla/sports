@extends('layouts.app')

@section('content')

<h2 class="text-xl mb-4">My Cart</h2>

@foreach($cart as $c)
    <div class="border p-3 mb-2">
        {{ $c->type }} - ID: {{ $c->item_id }}
    </div>
@endforeach

<a href="/place-order" class="bg-green-500 text-white p-2">Place Order</a>

@endsection