@extends('vendor.layout')

@section('page_title', 'Orders')

@section('content')

<div style="max-width:900px">

    <h2 style="margin-bottom:1.5rem">Product Orders</h2>

    @if($orders->count() == 0)

        <div style="padding:2rem;background:#fff;border-radius:12px">
            No orders yet 😢
        </div>

    @else

        <div style="display:flex;flex-direction:column;gap:12px">

            @foreach($orders as $o)
           

            @php
                $product = \App\Models\Product::find($o->item_id);
            @endphp

            <div style="background:#fff;padding:1rem;border-radius:12px;display:flex;justify-content:space-between">

                <!-- LEFT -->
                <div>

                    <div style="font-weight:600">
                        {{ $product->title ?? 'Product' }}
                    </div>

                    <div style="font-size:0.85rem;color:#666">
                        👤 User: {{ $o->order->user->name ?? 'Guest' }}
                    </div>

                    <div style="font-size:0.85rem;color:#666">
                        📧 {{ $o->order->user->email ?? '-' }}
                    </div>

                    <div style="font-size:0.85rem;color:#666">
                        Qty: {{ $o->qty }}
                    </div>

                </div>

                <!-- RIGHT -->
                <div style="text-align:right">

                    <div style="font-weight:600;color:#16a34a">
                        £{{ $o->price * $o->qty }}
                    </div>

                    <div style="font-size:0.8rem;color:#888">
                        Order #{{ $o->order_id }}
                    </div>

                </div>

            </div>

            @endforeach

        </div>

    @endif

</div>

@endsection