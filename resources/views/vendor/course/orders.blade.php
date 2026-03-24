@extends('vendor.layout')

@section('page_title', 'Training Orders')

@section('content')

    <div style="max-width:900px">

        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
            <h2>📚 My Orders</h2>
            <span style="color:#8aaac8;font-size:0.85rem">
                {{ $orders->count() }} order(s)
            </span>
        </div>

        @if($orders->count() == 0)

            <div style="padding:2rem;background:#fff;border-radius:12px">
                No course orders yet 😢
            </div>

        @else

            <div style="display:flex;flex-direction:column;gap:12px">

                @foreach($orders as $o)

                    <div
                        style="background:#fff;padding:1rem;border-radius:12px;display:flex;justify-content:space-between;align-items:center">

                        <!-- LEFT -->
                        <div>

                            <!-- COURSE NAME -->
                            <div style="font-weight:600;font-size:1rem">
                                {{ $o->course->title ?? 'Course' }}
                            </div>

                            <!-- USER -->
                            <div style="font-size:0.85rem;color:#666;margin-top:4px">
                                👤 {{ $o->order->user->name ?? 'Guest' }}
                            </div>

                            <div style="font-size:0.8rem;color:#8aaac8">
                                📧 {{ $o->order->user->email ?? '-' }}
                            </div>

                            <!-- QTY -->
                            <div style="font-size:0.8rem;color:#666;margin-top:4px">
                                Qty: {{ $o->qty }}
                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div style="text-align:right">

                            <!-- PRICE -->
                            <div style="font-weight:600;color:#2563eb;font-size:1rem">
                                £{{ $o->price * $o->qty }}
                            </div>

                            <!-- ORDER ID -->
                            <div style="font-size:0.75rem;color:#888">
                                Order #{{ $o->order_id }}
                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

@endsection