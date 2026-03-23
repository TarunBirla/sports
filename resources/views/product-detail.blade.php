@extends('layouts.app')

@section('content')

{{-- Google Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --gold: #c8a45e;
        --gold-light: #e8d5a3;
        --ink: #1a1a2e;
        --ink-soft: #3d3d56;
        --cream: #faf8f5;
        --sage: #4a7c59;
        --sage-light: #e8f2eb;
        --red-soft: #e05252;
        --border: #e8e4dc;
    }

    body { font-family: 'DM Sans', sans-serif; background: var(--cream); }
    h1, h2, .serif { font-family: 'Playfair Display', serif; }

    /* Breadcrumb */
    .breadcrumb a { color: var(--gold); text-decoration: none; transition: opacity 0.2s; }
    .breadcrumb a:hover { opacity: 0.7; }

    /* Image Gallery */
    .main-image-wrap {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        background: #f0ede8;
        aspect-ratio: 4/3;
    }
    .main-image-wrap img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .main-image-wrap:hover img { transform: scale(1.04); }
    .badge-sale {
        position: absolute; top: 16px; left: 16px;
        background: var(--red-soft); color: #fff;
        font-size: 11px; font-weight: 600; letter-spacing: 1px;
        padding: 4px 10px; border-radius: 50px;
        text-transform: uppercase;
    }
    .badge-new {
        position: absolute; top: 16px; left: 16px;
        background: var(--ink); color: #fff;
        font-size: 11px; font-weight: 600; letter-spacing: 1px;
        padding: 4px 10px; border-radius: 50px;
        text-transform: uppercase;
    }
    .thumb-grid { display: flex; gap: 10px; margin-top: 12px; }
    .thumb {
        width: 70px; height: 70px;
        border-radius: 10px; overflow: hidden;
        border: 2px solid transparent;
        cursor: pointer; transition: border-color 0.2s;
    }
    .thumb.active { border-color: var(--gold); }
    .thumb img { width: 100%; height: 100%; object-fit: cover; }

    /* Details */
    .category-tag {
        display: inline-block;
        background: var(--sage-light); color: var(--sage);
        font-size: 11px; font-weight: 600; letter-spacing: 1.2px;
        text-transform: uppercase; padding: 5px 14px;
        border-radius: 50px; margin-bottom: 14px;
    }

    /* Stars */
    .stars { color: var(--gold); font-size: 15px; letter-spacing: 2px; }

    /* Price */
    .price-main { font-family: 'Playfair Display', serif; font-size: 2rem; color: var(--sage); font-weight: 700; }
    .price-old { text-decoration: line-through; color: #aaa; font-size: 1rem; }
    .discount-chip {
        background: #fde8e8; color: var(--red-soft);
        font-size: 11px; font-weight: 700; padding: 3px 9px; border-radius: 50px;
    }

    /* Stock */
    .stock-in { color: var(--sage); font-weight: 600; }
    .stock-out { color: var(--red-soft); font-weight: 600; }

    /* Qty */
    .qty-wrap {
        display: flex; align-items: center;
        border: 1.5px solid var(--border); border-radius: 12px;
        overflow: hidden; width: fit-content;
    }
    .qty-btn {
        width: 36px; height: 40px; background: none; border: none;
        font-size: 18px; cursor: pointer; color: var(--ink-soft);
        transition: background 0.15s;
    }
    .qty-btn:hover { background: #f0ede8; }
    .qty-input {
        width: 44px; height: 40px;
        border: none; border-left: 1.5px solid var(--border); border-right: 1.5px solid var(--border);
        text-align: center; font-size: 14px; font-weight: 600;
        color: var(--ink); background: #fff; outline: none;
        font-family: 'DM Sans', sans-serif;
    }

    /* Buttons */
    .btn-cart {
        background: var(--ink); color: #fff;
        border: none; padding: 14px 28px;
        border-radius: 14px; font-size: 15px; font-weight: 600;
        cursor: pointer; display: flex; align-items: center; gap: 8px;
        transition: background 0.2s, transform 0.15s;
        font-family: 'DM Sans', sans-serif; text-decoration: none;
    }
    .btn-cart:hover { background: #2d2d4a; transform: translateY(-2px); }
    .btn-buy {
        background: var(--gold); color: #fff;
        border: none; padding: 14px 28px;
        border-radius: 14px; font-size: 15px; font-weight: 600;
        cursor: pointer; display: flex; align-items: center; gap: 8px;
        transition: background 0.2s, transform 0.15s;
        font-family: 'DM Sans', sans-serif; text-decoration: none;
    }
    .btn-buy:hover { background: #b8924e; transform: translateY(-2px); }
    .btn-wish {
        background: #fff; border: 1.5px solid var(--border);
        padding: 14px 18px; border-radius: 14px;
        font-size: 18px; cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
    }
    .btn-wish:hover { border-color: var(--red-soft); background: #fde8e8; }

    /* Trust badges */
    .trust-bar {
        display: flex; flex-wrap: wrap; gap: 14px;
        margin-top: 22px; padding-top: 20px;
        border-top: 1px solid var(--border);
    }
    .trust-item {
        display: flex; align-items: center; gap: 7px;
        font-size: 12.5px; color: var(--ink-soft); font-weight: 500;
    }
    .trust-icon { font-size: 16px; }

    /* Divider */
    .meta-row {
        display: flex; align-items: center; gap: 8px;
        padding: 9px 0; border-bottom: 1px solid var(--border);
        font-size: 13.5px;
    }
    .meta-label { color: #888; min-width: 90px; }
    .meta-value { color: var(--ink); font-weight: 500; }

    /* Tabs */
    .tab-nav { display: flex; gap: 0; border-bottom: 2px solid var(--border); margin-bottom: 24px; }
    .tab-btn {
        background: none; border: none; padding: 13px 22px;
        font-size: 14px; font-weight: 600; cursor: pointer;
        color: #888; font-family: 'DM Sans', sans-serif;
        border-bottom: 2px solid transparent; margin-bottom: -2px;
        transition: color 0.2s, border-color 0.2s;
    }
    .tab-btn.active { color: var(--ink); border-bottom-color: var(--gold); }
    .tab-content { display: none; }
    .tab-content.active { display: block; }

    /* Review cards */
    .review-card {
        background: var(--cream); border: 1px solid var(--border);
        border-radius: 14px; padding: 18px;
    }
    .reviewer-avatar {
        width: 42px; height: 42px; border-radius: 50%;
        background: var(--gold-light); display: flex;
        align-items: center; justify-content: center;
        font-weight: 700; color: var(--gold); font-size: 16px;
    }

    /* Shipping table */
    .info-table { width: 100%; border-collapse: collapse; font-size: 14px; }
    .info-table td { padding: 11px 14px; border-bottom: 1px solid var(--border); }
    .info-table tr:last-child td { border-bottom: none; }
    .info-table td:first-child { color: #888; font-weight: 500; width: 40%; }
    .info-table td:last-child { color: var(--ink); font-weight: 600; }

    /* Related cards */
    .related-card {
        background: #fff; border-radius: 16px; overflow: hidden;
        border: 1px solid var(--border);
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .related-card:hover { box-shadow: 0 8px 30px rgba(0,0,0,0.09); transform: translateY(-4px); }
    .related-card img { width: 100%; height: 180px; object-fit: cover; }

    @media (max-width: 768px) {
        .price-main { font-size: 1.6rem; }
        .btn-cart, .btn-buy { padding: 12px 18px; font-size: 14px; }
    }
</style>

<div class="max-w-6xl mx-auto px-4 py-8">

 

    {{-- MAIN PRODUCT AREA --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

        {{-- ===== LEFT: IMAGE GALLERY ===== --}}
        <div>
            <div class="main-image-wrap" id="mainImageWrap">
                @if($product->image)
                    <img src="{{ asset('products/'.$product->image) }}"
                         id="mainImage" alt="{{ $product->title }}">
                @else
                    <div style="display:flex;align-items:center;justify-content:center;height:100%;flex-direction:column;gap:10px;color:#bbb;">
                        <span style="font-size:48px;">📦</span>
                        <span style="font-size:14px;">No Image Available</span>
                    </div>
                @endif

                {{-- Sale badge --}}
                @if($product->sale_price && $product->sale_price < $product->price)
                    @php $discPct = round((($product->price - $product->sale_price) / $product->price) * 100); @endphp
                    <span class="badge-sale">{{ $discPct }}% OFF</span>
                @else
                    <span class="badge-new">New</span>
                @endif
            </div>

            
        </div>

        {{-- ===== RIGHT: PRODUCT DETAILS ===== --}}
        <div>

            {{-- Category --}}
            <span class="category-tag">
                {{ optional($product->category)->name ?? 'Training' }}
            </span>

            {{-- Title --}}
            <h1 class="serif text-3xl font-bold mb-3" style="color:var(--ink); line-height:1.3;">
                {{ $product->title }}
            </h1>

            {{-- Rating row --}}
            <div class="flex items-center gap-3 mb-4">
                <span class="stars">★★★★☆</span>
                <span style="font-size:13px;color:#888;">4.0 / 5.0 &nbsp;•&nbsp; <a href="#reviews" style="color:var(--gold);text-decoration:none;">120 Reviews</a></span>
                <span style="font-size:13px;color:#aaa;">|</span>
                <span style="font-size:13px;color:var(--sage);">✔ Verified Training</span>
            </div>

            {{-- Short description --}}
            <p style="color:var(--ink-soft);font-size:15px;line-height:1.75;margin-bottom:20px;">
                {{ $product->description }}
            </p>

            {{-- Price --}}
            <div class="flex items-center gap-3 mb-5">
                @if($product->sale_price && $product->sale_price < $product->price)
                    <span class="price-main">£{{ number_format($product->sale_price, 2) }}</span>
                    <span class="price-old">£{{ number_format($product->price, 2) }}</span>
                    <span class="discount-chip">Save £{{ number_format($product->price - $product->sale_price, 2) }}</span>
                @else
                    <span class="price-main">£{{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            {{-- Meta info rows --}}
            <div style="margin-bottom:20px;">
                <div class="meta-row">
                    <span class="meta-label">Availability</span>
                    @if($product->stock > 0)
                        <span class="stock-in">✔ In Stock ({{ $product->stock }} left)</span>
                    @else
                        <span class="stock-out">✖ Out of Stock</span>
                    @endif
                </div>
                <div class="meta-row">
                    <span class="meta-label">SKU</span>
                    <span class="meta-value">TRN-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Category</span>
                    <span class="meta-value">{{ optional($product->category)->name ?? '—' }}</span>
                </div>
                {{-- Duration - static UI example --}}
                <div class="meta-row">
                    <span class="meta-label">Duration</span>
                    <span class="meta-value">6 Weeks (Static)</span>
                </div>
                <div class="meta-row">
                    <span class="meta-label">Level</span>
                    <span class="meta-value">Beginner – Advanced (Static)</span>
                </div>
            </div>

            {{-- Qty + Buttons --}}
            @if($product->stock > 0)
           

            <div class="flex gap-3 flex-wrap">
                <a href="{{ url('/cart/add/training/'.$product->id) }}"
                   class="btn-cart" id="addCartBtn">
                    🛒 Add to Cart
                </a>
               
            </div>
            @else
            <div style="background:#fde8e8;border:1px solid #f5c6c6;border-radius:14px;padding:16px 20px;color:var(--red-soft);font-weight:600;margin-bottom:16px;">
                ⚠️ This product is currently out of stock.
            </div>
            <button class="btn-cart" style="opacity:.6;cursor:not-allowed;" disabled>🛒 Add to Cart</button>
            @endif

            {{-- Trust bar --}}
            <div class="trust-bar">
                <div class="trust-item"><span class="trust-icon">🔒</span> Secure Payment</div>
                <div class="trust-item"><span class="trust-icon">↩️</span> 7-Day Returns</div>
                <div class="trust-item"><span class="trust-icon">🎓</span> Expert Support</div>
                <div class="trust-item"><span class="trust-icon">📜</span> Certificate Included</div>
                <div class="trust-item"><span class="trust-icon">♾️</span> Lifetime Access</div>
            </div>

        </div>
    </div>

    {{-- ===== TABS SECTION ===== --}}
    <div class="mt-12 bg-white rounded-2xl shadow-sm p-6" style="border:1px solid var(--border);">

        <div class="tab-nav">
            <button class="tab-btn active" onclick="openTab(event,'tab-desc')">📄 Description</button>
            <button class="tab-btn" onclick="openTab(event,'tab-reviews')" id="reviews">⭐ Reviews (120)</button>
            <button class="tab-btn" onclick="openTab(event,'tab-info')">📦 Shipping & Info</button>
            <button class="tab-btn" onclick="openTab(event,'tab-faq')">💬 FAQ</button>
        </div>

        {{-- Description Tab --}}
        <div id="tab-desc" class="tab-content active">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="md:col-span-2">
                    <h3 class="serif text-xl font-bold mb-4" style="color:var(--ink);">About This Training</h3>
                    <p style="color:var(--ink-soft);line-height:1.85;margin-bottom:14px;">
                        {{ $product->description }}
                    </p>
                    <p style="color:var(--ink-soft);line-height:1.85;margin-bottom:14px;">
                        This training is designed for both beginners and professionals looking to advance their career.
                        You'll receive structured learning sessions, hands-on exercises, and guidance from industry experts.
                    </p>

                    <h4 style="font-weight:700;color:var(--ink);margin:20px 0 12px;">What You'll Learn</h4>
                    <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:8px;">
                        @foreach(['Core concepts and fundamentals', 'Industry-standard best practices', 'Practical real-world application', 'Assessment & certification process', 'Ongoing support & community access'] as $item)
                        <li style="display:flex;align-items:flex-start;gap:10px;font-size:14px;color:var(--ink-soft);">
                            <span style="color:var(--sage);margin-top:1px;">✔</span> {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <div style="background:var(--cream);border:1px solid var(--border);border-radius:16px;padding:20px;">
                        <h4 style="font-weight:700;color:var(--ink);margin-bottom:14px;">Course Includes</h4>
                        @foreach([['🎥','12 HD Video Lessons'],['📝','Workbook & Resources'],['✅','End-of-Module Quizzes'],['🏆','Certificate of Completion'],['👥','Community Forum Access'],['🔄','Free Lifetime Updates']] as [$icon, $text])
                        <div style="display:flex;gap:10px;align-items:center;padding:8px 0;border-bottom:1px solid var(--border);font-size:13.5px;color:var(--ink-soft);">
                            <span>{{ $icon }}</span> {{ $text }}
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        {{-- Reviews Tab --}}
        <div id="tab-reviews" class="tab-content">

            {{-- Summary --}}
            <div class="flex gap-8 items-start flex-wrap mb-8">
                <div style="text-align:center;min-width:100px;">
                    <div style="font-size:52px;font-family:'Playfair Display',serif;font-weight:700;color:var(--ink);line-height:1;">4.0</div>
                    <div class="stars" style="font-size:18px;">★★★★☆</div>
                    <div style="font-size:12px;color:#888;margin-top:4px;">120 reviews</div>
                </div>
                <div style="flex:1;min-width:200px;">
                    @foreach([5=>70, 4=>28, 3=>12, 2=>6, 1=>4] as $star => $count)
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:7px;">
                        <span style="font-size:12px;color:#888;min-width:14px;">{{ $star }}</span>
                        <span style="color:var(--gold);font-size:12px;">★</span>
                        <div style="flex:1;background:#eee;border-radius:99px;height:6px;overflow:hidden;">
                            <div style="background:var(--gold);height:100%;width:{{ round($count/120*100) }}%;border-radius:99px;"></div>
                        </div>
                        <span style="font-size:12px;color:#888;min-width:28px;">{{ $count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Sample reviews (static) --}}
            <div style="display:grid;gap:16px;">
                @foreach([
                    ['S','Sarah M.','★★★★★','Absolutely brilliant training! Clear explanations, excellent support, and a certificate that actually means something. Highly recommend.'],
                    ['J','James P.','★★★★☆','Very comprehensive content. Could use a bit more interactive elements but overall great value for money.'],
                    ['A','Aisha K.','★★★★★','The structured approach made complex concepts easy to understand. Already applying what I learned at work!'],
                ] as [$initial, $name, $stars, $text])
                <div class="review-card">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;">
                        <div style="display:flex;gap:12px;align-items:center;">
                            <div class="reviewer-avatar">{{ $initial }}</div>
                            <div>
                                <div style="font-weight:700;font-size:14px;color:var(--ink);">{{ $name }}</div>
                                <div style="color:var(--gold);font-size:13px;">{{ $stars }}</div>
                            </div>
                        </div>
                        <span style="font-size:12px;color:#bbb;">2 weeks ago</span>
                    </div>
                    <p style="font-size:14px;color:var(--ink-soft);line-height:1.7;margin:0;">{{ $text }}</p>
                </div>
                @endforeach
            </div>

        </div>

        {{-- Info Tab --}}
        <div id="tab-info" class="tab-content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h4 style="font-weight:700;color:var(--ink);margin-bottom:14px;">Delivery & Shipping</h4>
                    <table class="info-table">
                        <tr><td>Format</td><td>Online / Digital Access</td></tr>
                        <tr><td>Delivery</td><td>Instant upon purchase</td></tr>
                        <tr><td>Access</td><td>Lifetime</td></tr>
                        <tr><td>Devices</td><td>Desktop, Mobile, Tablet</td></tr>
                        <tr><td>Language</td><td>English</td></tr>
                    </table>
                </div>
                <div>
                    <h4 style="font-weight:700;color:var(--ink);margin-bottom:14px;">Returns & Refunds</h4>
                    <table class="info-table">
                        <tr><td>Return Window</td><td>7 Days</td></tr>
                        <tr><td>Condition</td><td>No questions asked</td></tr>
                        <tr><td>Refund Time</td><td>3–5 Business Days</td></tr>
                        <tr><td>Contact</td><td>support@example.com</td></tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- FAQ Tab --}}
        <div id="tab-faq" class="tab-content">
            @foreach([
                ['Is this suitable for beginners?', 'Yes! This training is designed to welcome complete beginners while also offering depth for experienced professionals.'],
                ['Will I get a certificate?', 'Absolutely. On successful completion, you will receive a verifiable digital certificate.'],
                ['How long do I have access?', 'You get lifetime access to all materials, including any future updates at no extra cost.'],
                ['Can I pay in instalments?', 'Yes, we offer flexible payment plans. Contact our support team for details.'],
            ] as [$q, $a])
            <details style="border-bottom:1px solid var(--border);padding:16px 0;cursor:pointer;">
                <summary style="font-weight:600;color:var(--ink);font-size:15px;list-style:none;display:flex;justify-content:space-between;">
                    {{ $q }} <span style="color:var(--gold);">+</span>
                </summary>
                <p style="color:var(--ink-soft);font-size:14px;line-height:1.75;margin-top:10px;margin-bottom:0;">
                    {{ $a }}
                </p>
            </details>
            @endforeach
        </div>

    </div>

    {{-- ===== RELATED PRODUCTS (Static) ===== --}}
  <div class="mt-12">
    <h2 class="text-2xl font-bold mb-6">You May Also Like</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

        @foreach($relatedProducts as $rp)
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

            <!-- IMAGE -->
            <div class="h-40 bg-gray-100">
                @if($rp->image)
                    <img src="{{ asset('products/'.$rp->image) }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-full text-3xl">📦</div>
                @endif
            </div>

            <!-- CONTENT -->
            <div class="p-3">

                <div class="text-sm font-semibold text-gray-800 mb-1">
                    {{ $rp->title }}
                </div>

                <div class="text-green-600 font-bold text-sm">
                    £{{ $rp->price }}
                </div>

                <!-- RATING (STATIC) -->
                <div class="text-yellow-400 text-xs mt-1">
                    ★★★★☆
                </div>

                <!-- BUTTON -->
                <a href="{{ url('product/'.$rp->id) }}"
                   class="block mt-2 text-center bg-blue-600 text-white py-1 rounded text-xs hover:bg-blue-700">
                   View
                </a>

            </div>

        </div>
        @endforeach

    </div>
</div>

</div>

<script>
function changeQty(delta) {
    const input = document.getElementById('qtyInput');
    let val = parseInt(input.value) + delta;
    const max = parseInt(input.max) || 99;
    input.value = Math.max(1, Math.min(val, max));
}

function switchThumb(el, src) {
    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    const main = document.getElementById('mainImage');
    if(main) main.src = src;
}

function toggleWish(btn) {
    btn.textContent = btn.textContent === '🤍' ? '❤️' : '🤍';
}

function openTab(e, id) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    e.currentTarget.classList.add('active');
}
</script>

@endsection