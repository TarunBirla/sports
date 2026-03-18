@extends('layouts.app')

@section('content')

<h2 class="text-xl mb-4">My Orders</h2>

@foreach($orders as $o)
    <div class="border p-3 mb-2">
        Order ID: {{ $o->id }} <br>
        Total: ₹{{ $o->total }}
    </div>
@endforeach

@endsection