@extends('layouts.app')

@section('content')

<div style="margin:3rem auto;padding:0 1.5rem">

    <!-- HEADER -->
    <div style="margin-bottom:2rem">
        <h2>Order #{{ $order->id }}</h2>
        <p style="color:#666">
            Placed on {{ $order->created_at->format('d M Y') }}
        </p>
    </div>

    <!-- STATUS -->
    <div style="margin-bottom:1rem">
        Status:
        <strong style="color:green">
            {{ ucfirst($order->status ?? 'pending') }}
        </strong>
    </div>

    <!-- ITEMS -->
    <div style="display:flex;flex-direction:column;gap:12px">

        @php $total = 0; @endphp

        @foreach($order->items as $item)

        @php
            $product = $item->type === 'training' ? $item->product : $item->course;
            $subtotal = $item->price * $item->qty;
            $total += $subtotal;
        @endphp

        <div style="display:flex;justify-content:space-between;align-items:center;background:#fff;padding:1rem;border-radius:10px">

            <!-- LEFT -->
            <div style="display:flex;gap:12px;align-items:center">

                <!-- IMAGE -->
                @if($product && $product->image)
                    <img src="{{ asset('products/'.$product->image) }}"
                         style="width:60px;height:60px;border-radius:8px">
                @endif

                <div>
                    <div style="font-weight:600">
                        {{ $product->title ?? 'Item #'.$item->item_id }}
                    </div>

                    <div style="font-size:0.85rem;color:#666">
                        £{{ $item->price }} × {{ $item->qty }}
                    </div>
                </div>

            </div>

            <!-- RIGHT -->
            <div style="font-weight:600">
                £{{ $subtotal }}
            </div>

        </div>

        @endforeach

    </div>

    <!-- TOTAL -->
    <div style="margin-top:2rem;padding:1.5rem;background:#f0f6ff;border-radius:12px">

        <div style="display:flex;justify-content:space-between">
            <span>Total</span>
            <strong style="color:green;font-size:1.2rem">
                £{{ $total }}
            </strong>
        </div>

    </div>

    <!-- BACK -->
    <a href="/my-orders"
       style="display:inline-block;margin-top:20px;color:#1a6fd4">
       ← Back to Orders
    </a>

</div>

@endsection