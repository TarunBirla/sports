@extends('vendor.layout')

@section('page_title', 'My Products')

@section('content')

    <div style="max-width:860px">

        {{-- Section header --}}
        <div
            style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;padding-bottom:1.25rem;border-bottom:1.5px solid #d0e2f7">
            <div style="display:flex;align-items:center;gap:12px">
                <div
                    style="width:44px;height:44px;border-radius:10px;background:#dcfce7;display:flex;align-items:center;justify-content:center;font-size:1.25rem">
                    🏋️</div>
                <div>
                    <div style="font-family:'Bebas Neue',sans-serif;font-size:1.9rem;letter-spacing:0.05em;color:#0d1f3c">My
                        Products</div>
                    <div style="font-size:0.8rem;color:#8aaac8;font-weight:500">{{ count($products) }} product(s) listed
                    </div>
                </div>
            </div>
            <a href="/vendor/training/create"
                style="display:inline-flex;align-items:center;gap:6px;padding:9px 20px;border-radius:10px;background:#16a34a;color:#fff;font-size:0.875rem;font-weight:600;text-decoration:none;font-family:'DM Sans',sans-serif"
                onmouseover="this.style.background='#15803d'" onmouseout="this.style.background='#16a34a'">+ Add Product</a>
        </div>

<<<<<<< HEAD
        @if(count($products) === 0)

            {{-- Empty state --}}
            <div style="text-align:center;padding:4rem 2rem;background:#fff;border:1px solid #d0e2f7;border-radius:16px">
                <div style="font-size:3rem;margin-bottom:1rem"></div>
                <div
                    style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:0.05em;color:#0d1f3c;margin-bottom:0.5rem">
                    No Products Yet</div>
                <p style="color:#8aaac8;font-size:0.9rem;margin-bottom:1.5rem;font-family:'DM Sans',sans-serif">Create your
                    first product to start selling.</p>
                <a href="/vendor/training/create"
                    style="display:inline-flex;align-items:center;gap:6px;padding:10px 24px;border-radius:10px;background:#16a34a;color:#fff;font-size:0.9rem;font-weight:600;text-decoration:none;font-family:'DM Sans',sans-serif">+
                    Add Your First Product</a>
            </div>

        @else

            {{-- Table card --}}
            <div
                style="background:#fff;border:1px solid #d0e2f7;border-radius:16px;overflow:hidden;box-shadow:0 4px 16px rgba(26,111,212,0.07)">

                {{-- Table header --}}
                <div
                    style="display:grid;grid-template-columns:1fr 100px 100px 140px;padding:10px 1.25rem;background:#f0f6ff;border-bottom:1.5px solid #d0e2f7">
                    <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#8aaac8">
                        Title</div>
                    <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#8aaac8">
                        Price</div>
                    <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#8aaac8">
                        Stock</div>
                    <div
                        style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#8aaac8;text-align:right">
                        Actions</div>
=======
                {{-- Price --}}
                <div>
                    <div style="font-family:'Bebas Neue',sans-serif;font-size:1.15rem;letter-spacing:0.03em;color:#16a34a">£{{ number_format($p->price, 2) }}</div>
                    @if($p->sale_price)
                        <div style="font-size:0.75rem;color:#ef4444;font-family:'DM Sans',sans-serif">Sale: £{{ number_format($p->sale_price, 2) }}</div>
                    @endif
>>>>>>> 86844bb5a3c3a0de2ea8d892459330bd437bf977
                </div>

                {{-- Rows --}}
                @foreach($products as $p)
                    <div style="display:grid;grid-template-columns:1fr 100px 100px 140px;padding:1rem 1.25rem;border-bottom:1px solid #e8f1fd;align-items:center"
                        onmouseover="this.style.background='#f8fbff'" onmouseout="this.style.background='transparent'">
                        {{-- Title --}}
                        <div style="display:flex;align-items:center;gap:10px">
                            <div style="width:50px;height:50px;border-radius:8px;overflow:hidden;flex-shrink:0">

                                @if($p->image)
                                    <img src="{{ asset('products/' . $p->image) }}" style="width:100%;height:100%;object-fit:cover">
                                @else
                                    <div
                                        style="width:100%;height:100%;background:#dcfce7;display:flex;align-items:center;justify-content:center">
                                        🏋️
                                    </div>
                                @endif

                            </div>
                            <div>
                                <div style="font-size:0.925rem;font-weight:600;color:#0d1f3c;font-family:'DM Sans',sans-serif">
                                    {{ $p->title }}</div>
                                <div style="font-size:0.75rem;color:#8aaac8;margin-top:1px;font-family:'DM Sans',sans-serif">
                                    SKU: {{ $p->sku ?? '—' }}
                                    <br>
                                    <span style="font-size:0.75rem;color:#1a6fd4;font-weight:600">
                                        Category: {{ $p->category->name ?? '—' }}
                                    </span>
                                    @if($p->is_featured)
                                        &nbsp;<span
                                            style="background:#fef3c7;color:#92400e;font-size:0.65rem;font-weight:700;padding:1px 6px;border-radius:4px;letter-spacing:0.04em">FEATURED</span>
                                    @endif
                                    @if(!$p->is_active)
                                        &nbsp;<span
                                            style="background:#fee2e2;color:#dc2626;font-size:0.65rem;font-weight:700;padding:1px 6px;border-radius:4px;letter-spacing:0.04em">INACTIVE</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div>
                            <div style="font-family:'Bebas Neue',sans-serif;font-size:1.15rem;letter-spacing:0.03em;color:#16a34a">
                                £{{ number_format($p->price, 2) }}</div>
                            @if($p->sale_price)
                                <div style="font-size:0.75rem;color:#ef4444;font-family:'DM Sans',sans-serif">Sale:
                                    £{{ number_format($p->sale_price, 2) }}</div>
                            @endif
                        </div>

                        {{-- Stock --}}
                        <div style="font-size:0.9rem;color:#4a6890;font-family:'DM Sans',sans-serif;font-weight:500">
                            {{ $p->stock ?? '—' }}
                        </div>

                        {{-- Actions --}}
                        <div style="display:flex;align-items:center;gap:6px;justify-content:flex-end">
                            <a href="/vendor/training/edit/{{ $p->id }}"
                                style="display:inline-flex;align-items:center;gap:4px;padding:6px 14px;border-radius:8px;background:#e3eefd;color:#1a6fd4;font-size:0.8rem;font-weight:600;text-decoration:none;border:1px solid #93c5fd;font-family:'DM Sans',sans-serif"
                                onmouseover="this.style.background='#c8dff9'" onmouseout="this.style.background='#e3eefd'">✏️
                                Edit</a>

                            <form method="POST" action="/vendor/training/delete/{{ $p->id }}"
                                onsubmit="return confirm('Delete \'{{ addslashes($p->title) }}\'? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="display:inline-flex;align-items:center;gap:4px;padding:6px 14px;border-radius:8px;background:#fee2e2;color:#dc2626;font-size:0.8rem;font-weight:600;border:1px solid #fca5a5;cursor:pointer;font-family:'DM Sans',sans-serif"
                                    onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">🗑
                                    Delete</button>
                            </form>
                        </div>

                    </div>
                @endforeach

            </div>

            {{-- Summary strip --}}
            <div
                style="margin-top:1rem;display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;background:#f0f6ff;border:1px solid #d0e2f7;border-radius:10px">
                <span style="font-size:0.8rem;color:#4a6890;font-weight:500;font-family:'DM Sans',sans-serif">Showing
                    {{ count($products) }} product(s)</span>
                <a href="/vendor/training/create"
                    style="font-size:0.8rem;font-weight:600;color:#16a34a;text-decoration:none;font-family:'DM Sans',sans-serif"
                    onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">+ Add
                    another</a>
            </div>

        @endif

    </div>

@endsection