@extends('layouts.app')

@section('content')

@php
    $total = 0;
@endphp

<div style="margin:3rem auto;padding:0 1.5rem 6rem">

    <!-- HEADER -->
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:2rem;border-bottom:1.5px solid #d0e2f7;padding-bottom:1.2rem">
        <div style="width:46px;height:46px;border-radius:12px;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-size:1.4rem">🛒</div>
        <div>
            <div style="font-size:1.8rem;font-weight:700">My Cart</div>
            <div style="font-size:0.85rem;color:#8aaac8">{{ count($cart) }} item(s)</div>
        </div>
    </div>

    @if(count($cart) == 0)

        <!-- EMPTY -->
        <div style="text-align:center;padding:4rem;background:#fff;border-radius:16px">
            <h2>Cart is empty 😢</h2>
            <a href="/" style="margin-top:10px;display:inline-block;background:#1a6fd4;color:#fff;padding:10px 20px;border-radius:8px">
                Go Shopping
            </a>
        </div>

    @else

        <!-- CART ITEMS -->
        <div style="display:flex;flex-direction:column;gap:14px">

            @foreach($cart as $c)

            @php
                $item = $c->type === 'training' ? $c->training : $c->course;
                $price = $item->sale_price ?? $item->price ?? 0;
                $qty = $c->qty ?? 1;
                $subtotal = $price * $qty;
                $total += $subtotal;
            @endphp

            <div style="background:#fff;border-radius:14px;padding:1rem 1.2rem;display:flex;justify-content:space-between;align-items:center">

                <!-- LEFT -->
                <div style="display:flex;gap:14px;align-items:center">

                    <!-- IMAGE -->
                    @if($item && $item->image)
                        <img src="{{ asset('products/'.$item->image) }}"
                             style="width:70px;height:70px;border-radius:10px;object-fit:cover">
                    @else
                        <div style="width:70px;height:70px;background:#eee;border-radius:10px"></div>
                    @endif
                    

                    <!-- DETAILS -->
                    <div>
                        <div style="font-weight:600;font-size:1rem">
                            {{ $item->title ?? 'Item #'.$c->item_id }}
                        </div>

                        <div style="font-size:0.8rem;color:#888;margin-top:3px">
                            {{ \Illuminate\Support\Str::limit($item->description ?? '', 60) }}
                        </div>

                        <div style="margin-top:6px;font-size:0.9rem;color:#16a34a;font-weight:600">
                            £{{ $price }} × {{ $qty }}
                        </div>
                    </div>
                </div>

                <!-- RIGHT -->
                <div style="text-align:right">

                    <!-- SUBTOTAL -->
                    <div style="font-size:1rem;font-weight:700;color:#0d1f3c">
                        £{{ $subtotal }}
                    </div>

                    <!-- REMOVE -->
                    <a href="/cart/remove/{{ $c->id }}"
                       style="margin-top:6px;display:inline-block;color:red;font-size:0.8rem">
                        Remove
                    </a>

                </div>

            </div>

            @endforeach

        </div>

        <!-- SUMMARY -->
        <div style="margin-top:2rem;background:#f0f6ff;padding:1.5rem;border-radius:16px">

            <div style="display:flex;justify-content:space-between;margin-bottom:10px">
                <span>Total Items:</span>
                <strong>{{ count($cart) }}</strong>
            </div>

            <div style="display:flex;justify-content:space-between;font-size:1.2rem">
                <span>Total Amount:</span>
                <strong style="color:#16a34a">£{{ $total }}</strong>
            </div>

        </div>

        <!-- BUTTON -->
        <a href="/place-order"
           style="margin-top:1.5rem;display:block;text-align:center;background:#16a34a;color:#fff;padding:14px;border-radius:12px;font-weight:600">
            Place Order
        </a>

    @endif

</div>

@endsection