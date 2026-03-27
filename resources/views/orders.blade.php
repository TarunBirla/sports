@extends('layouts.app')

@section('content')

<div style="max-width:760px;margin:3rem auto;padding:0 1.5rem 6rem">

    {{-- Page title --}}
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:2rem;padding-bottom:1.25rem;border-bottom:1.5px solid #d0e2f7">
        <div style="width:44px;height:44px;border-radius:10px;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-size:1.25rem">📦</div>
        <div>
            <div style="font-family:'Bebas Neue',sans-serif;font-size:1.9rem;letter-spacing:0.05em;color:#0d1f3c">My Orders</div>
            <div style="font-size:0.8rem;color:#8aaac8;font-weight:500">{{ count($orders) }} order(s) placed</div>
        </div>
    </div>

    @if(count($orders) === 0)

        {{-- Empty state --}}
        <div style="text-align:center;padding:4rem 2rem;background:#fff;border:1px solid #d0e2f7;border-radius:16px">
            <div style="font-size:3rem;margin-bottom:1rem">🧾</div>
            <div style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:0.05em;color:#0d1f3c;margin-bottom:0.5rem">No orders yet</div>
            <p style="color:#8aaac8;font-size:0.9rem;margin-bottom:1.5rem">Once you place an order it will appear here.</p>
            <a href="/"
               style="display:inline-flex;align-items:center;gap:6px;padding:10px 24px;border-radius:10px;background:#1a6fd4;color:#fff;font-size:0.9rem;font-weight:600;text-decoration:none"
            >Explore Programs →</a>
        </div>

    @else

        <div style="display:flex;flex-direction:column;gap:12px">
        @foreach($orders as $o)

        <div style="background:#fff;border:1px solid #d0e2f7;border-radius:16px;overflow:hidden;transition:box-shadow 0.18s"
             onmouseover="this.style.boxShadow='0 4px 16px rgba(26,111,212,0.10)'"
             onmouseout="this.style.boxShadow='none'">

            {{-- Order header --}}
            <div style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid #e8f1fd;background:#f8fbff">

                <div style="display:flex;align-items:center;gap:12px">
                    <div style="width:40px;height:40px;border-radius:10px;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-size:1.1rem">🧾</div>
                    <div>
                        <div style="font-size:0.75rem;color:#8aaac8;font-weight:600;letter-spacing:0.05em;text-transform:uppercase">Order ID</div>
                        <div style="font-family:'Bebas Neue',sans-serif;font-size:1.2rem;letter-spacing:0.05em;color:#0d1f3c">#{{ str_pad($o->id, 5, '0', STR_PAD_LEFT) }}</div>
                    </div>
                </div>

                {{-- Status badge --}}
                @php $status = $o->status ?? 'pending'; @endphp
                <span style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;padding:4px 12px;border-radius:20px;
                    @if($status === 'completed') background:#dcfce7;color:#16a34a;border:1px solid #86efac
                    @elseif($status === 'cancelled') background:#fee2e2;color:#dc2626;border:1px solid #fca5a5
                    @else background:#fef3c7;color:#b45309;border:1px solid #fcd34d
                    @endif">
                    @if($status === 'completed') ✓ Completed
                    @elseif($status === 'cancelled') ✕ Cancelled
                    @else ⏳ Pending
                    @endif
                </span>

            </div>

            {{-- Order body --}}
            <div style="padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">

                <div style="display:flex;gap:2rem;flex-wrap:wrap">
                    <div>
                        <div style="font-size:0.75rem;color:#8aaac8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px">Total Amount</div>
                        <div style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:0.03em;color:#16a34a">£{{ number_format($o->total, 2) }}</div>
                    </div>
                    <div>
                        <div style="font-size:0.75rem;color:#8aaac8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px">Placed On</div>
                        <div style="font-size:0.9rem;font-weight:500;color:#0d1f3c">{{ $o->created_at ? $o->created_at->format('d M Y') : '—' }}</div>
                    </div>
                    @if($o->items_count ?? false)
                    <div>
                        <div style="font-size:0.75rem;color:#8aaac8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px">Items</div>
                        <div style="font-size:0.9rem;font-weight:500;color:#0d1f3c">{{ $o->items_count }}</div>
                    </div>
                    @endif
                </div>

               @php
    $hasCourse = $o->items->where('type',  'course')->count();
@endphp

@if($hasCourse > 0)

    {{-- START BUTTON --}}
    <a href="/course-start/{{ $o->id }}"
       style="display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:9px;background:#16a34a;color:#fff;font-size:0.85rem;font-weight:600;text-decoration:none;">
        State
    </a>

@else

    {{-- NORMAL ORDER --}}
    <a href="/orders/{{ $o->id }}"
       style="display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:9px;background:#e3eefd;color:#1a6fd4;font-size:0.85rem;font-weight:600;text-decoration:none;">
       View Details →
    </a>

@endif

            </div>
        </div>

        @endforeach
        </div>

        {{-- Back link --}}
        <a href="/"
           style="display:inline-flex;align-items:center;gap:6px;margin-top:2rem;padding:10px 20px;border-radius:10px;background:#e3eefd;color:#1a6fd4;font-size:0.875rem;font-weight:600;text-decoration:none;border:1px solid #93c5fd;transition:background 0.18s"
           onmouseover="this.style.background='#c8dff9'"
           onmouseout="this.style.background='#e3eefd'"
        >← Browse More Programs</a>

    @endif

</div>

@endsection