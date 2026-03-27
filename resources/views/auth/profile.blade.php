@extends('layouts.app')

@section('content')
    <div class="bg-gray-100">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mb-10">

            <div class="grid md:grid-cols-4 gap-6">

                <!-- LEFT MENU -->
                <div class="bg-white rounded-xl shadow p-4">

                    <ul class="space-y-2 text-sm">

                        

                        <li>
                            <button onclick="openTab('dashboardTab')"
                                class="tab-btn w-full text-left px-4 py-2 rounded-lg bg-blue-100 text-blue-600 font-semibold">

                                📊 Dashboard
                            </button>
                        </li>
                        <li>
                            <button onclick="openTab('profileTab')"
                                class="tab-btn w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">

                                👤 Profile
                            </button>
                        </li>

                        <li>
                            <button onclick="openTab('ordersTab')"
                                class="tab-btn w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                                📦 Orders
                            </button>
                        </li>

                        <li>
                            <button onclick="openTab('downloadsTab')"
                                class="tab-btn w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                                ⬇ Downloads
                            </button>
                        </li>

                        <li>
                            <button onclick="openTab('addressTab')"
                                class="tab-btn w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                                📍 Addresses
                            </button>
                        </li>

                        <li>
                            <button onclick="openTab('paymentTab')"
                                class="tab-btn w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                                ⚙ Packages
                            </button>
                        </li>

                        <li>
                            <button onclick="openTab('accountTab')"
                                class="tab-btn w-full text-left px-4 py-2 rounded-lg hover:bg-gray-100">
                                ⚙ Account Details
                            </button>
                        </li>

                        <li>
                            <a href="/logout" class="block px-4 py-2 rounded-lg text-red-500 hover:bg-red-50">
                                🚪 Logout
                            </a>
                        </li>

                    </ul>

                </div>

                <!-- RIGHT CONTENT -->
                <div class="md:col-span-3">

                       <!-- DASHBOARD -->
                    <div id="dashboardTab" class="tab-content">
                        <div class="bg-white p-6 rounded-xl shadow">

                            <h2 class="text-xl font-bold mb-4">Dashboard</h2>
                            <p class="mb-6 text-gray-600">
                                Welcome {{ auth()->user()->name }}
                            </p>

                            <!-- Stats Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                                <!-- Total Orders -->
                                <div class="bg-blue-50 p-5 rounded-xl shadow-sm border border-blue-100">
                                    <h3 class="text-sm text-gray-500">Total Orders</h3>
                                    <p class="text-2xl font-bold text-blue-600">
                                        {{ $totalOrders }}
                                    </p>
                                </div>

                                <!-- Total Earnings (£) -->
                                <div class="bg-green-50 p-5 rounded-xl shadow-sm border border-green-100">
                                    <h3 class="text-sm text-gray-500">Total Earnings (£)</h3>
                                    <p class="text-2xl font-bold text-green-600">
                                         £ {{ number_format($totalEarnings, 2) }}
                                    </p>
                                </div>

                                <!-- Completed Orders -->
                                <div class="bg-yellow-50 p-5 rounded-xl shadow-sm border border-yellow-100">
                                    <h3 class="text-sm text-gray-500">Completed Orders</h3>
                                    <p class="text-2xl font-bold text-yellow-600">
                                       {{ $completedOrders }}
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- PROFILE TAB (DEFAULT OPEN) -->
                    <div id="profileTab" class="tab-content hidden">

                        <div class="bg-gray-100">

                            <!-- Gradient Header -->
                            <div class="mb-10">

                                <div class="h-64 w-full" style="
                              background:
                              linear-gradient(
                                135deg,
                                hsl(220 50% 12%),
                                hsl(220 45% 18%),
                                hsl(145 40% 20%)
                              );
                            ">

                                    <div class="max-w-6xl mx-auto pt-6 px-4">

                                        <a href="/" class="text-white flex items-center gap-2">
                                            ← Back
                                        </a>

                                    </div>

                                </div>



                                <div class="max-w-6xl mx-auto px-4 -mt-32">

                                    <div class="grid md:grid-cols-3 gap-8">

                                        <!-- LEFT COLUMN -->

                                        <div class="space-y-6">

                                            <!-- Player Image -->

                                            <div class="bg-white p-2 rounded-xl shadow">

                                                <img src="https://elitecricket.nexteck.uk/assets/player-batting.jpg"
                                                    class="rounded-lg h-80 w-full">

                                            </div>



                                            <!-- Player Info -->

                                          

                                        </div>



                                        <!-- RIGHT COLUMN -->

                                        <div class="md:col-span-2 space-y-8">

                                            <!-- Career Stats -->

                                              <div class="bg-white p-6 rounded-xl shadow mb-10">

                                                <h2 class="text-xl font-semibold">
                                                    {{ auth()->user()->name }}
                                                </h2>
                                                <p>{{ auth()->user()->email }}</p>

                                                <p class="text-green-600 font-medium mb-4">
                                                    Batsman
                                                </p>


                                                <div class="space-y-2 text-sm text-gray-600">

                                                    <div class="flex justify-between">
                                                        <span>Age</span>
                                                        <span>{{ auth()->user()->age ?? '-' }}</span>
                                                    </div>

                                                    <div class="flex justify-between">
                                                        <span>Batting</span>
                                                        <span>{{ auth()->user()->batting ?? '-' }}</span>
                                                    </div>

                                                    <div class="flex justify-between">
                                                        <span>Bowling</span>
                                                        <span>{{ auth()->user()->bowling ?? '-' }}</span>
                                                    </div>

                                                    <div class="flex justify-between">
                                                        <span>Academy</span>
                                                        <span>{{ auth()->user()->academy ?? '-' }}</span>
                                                    </div>

                                                </div>


                                                <!-- <button onclick="openModal()"
                                                    class="mt-6 w-full border rounded-lg py-2 hover:bg-gray-100 transition">
                                                    Edit Profile
                                                </button> -->

                                            </div>



                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                  

                    <!-- ORDERS -->
                    <div id="ordersTab" class="tab-content hidden">
                        <div class="bg-white p-6 rounded-xl shadow">

                            <div>

                                {{-- Page title --}}
                                <div
                                    style="display:flex;align-items:center;gap:12px;margin-bottom:2rem;padding-bottom:1.25rem;border-bottom:1.5px solid #d0e2f7">
                                    <div
                                        style="width:44px;height:44px;border-radius:10px;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-size:1.25rem">
                                        📦</div>
                                    <div>
                                        <div
                                            style="font-family:'Bebas Neue',sans-serif;font-size:1.9rem;letter-spacing:0.05em;color:#0d1f3c">
                                            My Orders</div>
                                        <div style="font-size:0.8rem;color:#8aaac8;font-weight:500">{{ count($orders) }}
                                            order(s) placed</div>
                                    </div>
                                </div>

                                @if(count($orders) === 0)

                                    {{-- Empty state --}}
                                    <div
                                        style="text-align:center;padding:4rem 2rem;background:#fff;border:1px solid #d0e2f7;border-radius:16px">
                                        <div style="font-size:3rem;margin-bottom:1rem">🧾</div>
                                        <div
                                            style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:0.05em;color:#0d1f3c;margin-bottom:0.5rem">
                                            No orders yet</div>
                                        <p style="color:#8aaac8;font-size:0.9rem;margin-bottom:1.5rem">Once you place an order
                                            it will appear here.</p>
                                        <a href="/"
                                            style="display:inline-flex;align-items:center;gap:6px;padding:10px 24px;border-radius:10px;background:#1a6fd4;color:#fff;font-size:0.9rem;font-weight:600;text-decoration:none">Explore
                                            Programs →</a>
                                    </div>

                                @else

                                    <div style="display:flex;flex-direction:column;gap:12px">
                                        @foreach($orders as $o)

                                                        <div style="background:#fff;border:1px solid #d0e2f7;border-radius:16px;overflow:hidden;transition:box-shadow 0.18s"
                                                            onmouseover="this.style.boxShadow='0 4px 16px rgba(26,111,212,0.10)'"
                                                            onmouseout="this.style.boxShadow='none'">

                                                            {{-- Order header --}}
                                                            <div
                                                                style="display:flex;align-items:center;justify-content:space-between;padding:1rem 1.25rem;border-bottom:1px solid #e8f1fd;background:#f8fbff">

                                                                <div style="display:flex;align-items:center;gap:12px">
                                                                    <div
                                                                        style="width:40px;height:40px;border-radius:10px;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-size:1.1rem">
                                                                        🧾</div>
                                                                    <div>
                                                                        <div
                                                                            style="font-size:0.75rem;color:#8aaac8;font-weight:600;letter-spacing:0.05em;text-transform:uppercase">
                                                                            Order ID</div>
                                                                        <div
                                                                            style="font-family:'Bebas Neue',sans-serif;font-size:1.2rem;letter-spacing:0.05em;color:#0d1f3c">
                                                                            #{{ str_pad($o->id, 5, '0', STR_PAD_LEFT) }}</div>
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
                                                            <div
                                                                style="padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">

                                                                <div style="display:flex;gap:2rem;flex-wrap:wrap">
                                                                    <div>
                                                                        <div
                                                                            style="font-size:0.75rem;color:#8aaac8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px">
                                                                            Total Amount</div>
                                                                        <div
                                                                            style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:0.03em;color:#16a34a">
                                                                            £{{ number_format($o->total, 2) }}</div>
                                                                    </div>
                                                                    <div>
                                                                        <div
                                                                            style="font-size:0.75rem;color:#8aaac8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px">
                                                                            Placed On</div>
                                                                        <div style="font-size:0.9rem;font-weight:500;color:#0d1f3c">
                                                                            {{ $o->created_at ? $o->created_at->format('d M Y') : '—' }}</div>
                                                                    </div>
                                                                    @if($o->items_count ?? false)
                                                                        <div>
                                                                            <div
                                                                                style="font-size:0.75rem;color:#8aaac8;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px">
                                                                                Items</div>
                                                                            <div style="font-size:0.9rem;font-weight:500;color:#0d1f3c">
                                                                                {{ $o->items_count }}</div>
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                                @php
                                                                    $hasCourse = $o->items->where('type', 'course')->count();
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
                                        onmouseout="this.style.background='#e3eefd'">← Browse More Programs</a>

                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- DOWNLOADS -->
                    <div id="downloadsTab" class="tab-content hidden">
                        <div class="bg-white p-6 rounded-xl shadow">

                            <h2 class="text-xl font-bold mb-4">Downloads</h2>

                            <div class="grid md:grid-cols-2 gap-4">

                                <!-- File 1 -->
                                <div class="border rounded-lg p-4 flex justify-between items-center hover:shadow">
                                    <div>
                                        <p class="font-semibold">Invoice #1234</p>
                                        <p class="text-sm text-gray-500">PDF • 2.3 MB</p>
                                    </div>
                                    <button class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm">
                                        Download
                                    </button>
                                </div>

                                <!-- File 2 -->
                                <div class="border rounded-lg p-4 flex justify-between items-center hover:shadow">
                                    <div>
                                        <p class="font-semibold">Order Receipt #5678</p>
                                        <p class="text-sm text-gray-500">PDF • 1.8 MB</p>
                                    </div>
                                    <button class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm">
                                        Download
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>


                    <!-- ADDRESS -->
                    <div id="addressTab" class="tab-content hidden">
                        <div class="bg-white p-6 rounded-xl shadow">

                            <h2 class="text-xl font-bold mb-4">Addresses</h2>

                            <div class="grid md:grid-cols-2 gap-4">

                                <!-- Home Address -->
                                <div class="border rounded-xl p-5 hover:shadow-md transition">
                                    <h3 class="font-semibold text-lg mb-1">Home</h3>
                                    <p class="text-sm text-gray-600 leading-relaxed">
                                        Nasar Faridi <br>
                                        221B Baker Street <br>
                                        London <br>
                                        NW1 6XE <br>
                                        United Kingdom
                                    </p>

                                </div>

                                <!-- Office Address -->
                                <div class="border rounded-xl p-5 hover:shadow-md transition">
                                    <h3 class="font-semibold text-lg mb-1">Office</h3>
                                    <p class="text-sm text-gray-600 leading-relaxed">
                                        Nasar Faridi <br>
                                        10 Downing Street <br>
                                        Westminster <br>
                                        London <br>
                                        SW1A 2AA <br>
                                        United Kingdom
                                    </p>

                                </div>

                            </div>

                        </div>
                    </div>


                    <!-- PAYMENT -->
                    <div id="paymentTab" class="tab-content hidden">
                        <div class="bg-white p-6 rounded-xl shadow">

                            <h2 class="text-xl font-bold mb-6">Packages</h2>

                            <div class="grid md:grid-cols-3 gap-6">

                                <!-- Basic -->
                                <div class="border rounded-xl p-6 text-center hover:shadow-md transition">
                                    <h3 class="text-lg font-semibold mb-2">Basic</h3>
                                    <p class="text-2xl font-bold mb-2">Free</p>
                                    <p class="text-sm text-gray-500 mb-4">For beginners</p>

                                    <ul class="text-sm text-gray-600 mb-6 space-y-1">
                                        <li>✔ 5 Orders</li>
                                        <li>✔ Basic Support</li>
                                        <li>✔ Limited Access</li>
                                    </ul>

                                    <button class="w-full py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900">
                                        Get Started
                                    </button>
                                </div>

                                <!-- Premium (Highlight) -->
                                <div class="border-2 border-blue-600 rounded-xl p-6 text-center shadow-lg relative">
                                    <span class="absolute top-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded">
                                        Popular
                                    </span>

                                    <h3 class="text-lg font-semibold mb-2">Premium</h3>
                                    <p class="text-2xl font-bold mb-2">£9.99<span class="text-sm">/month</span></p>
                                    <p class="text-sm text-gray-500 mb-4">Best for regular users</p>

                                    <ul class="text-sm text-gray-600 mb-6 space-y-1">
                                        <li>✔ Unlimited Orders</li>
                                        <li>✔ Priority Support</li>
                                        <li>✔ Full Access</li>
                                    </ul>

                                    <button class="w-full py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Subscribe
                                    </button>
                                </div>

                                <!-- Pro -->
                                <div class="border rounded-xl p-6 text-center hover:shadow-md transition">
                                    <h3 class="text-lg font-semibold mb-2">Pro</h3>
                                    <p class="text-2xl font-bold mb-2">£19.99<span class="text-sm">/month</span></p>
                                    <p class="text-sm text-gray-500 mb-4">For professionals</p>

                                    <ul class="text-sm text-gray-600 mb-6 space-y-1">
                                        <li>✔ Everything in Premium</li>
                                        <li>✔ Dedicated Support</li>
                                        <li>✔ Advanced Features</li>
                                    </ul>

                                    <button class="w-full py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                                        Go Pro
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- ACCOUNT -->
                    <div id="accountTab" class="tab-content hidden">
                        <div class="bg-white p-6 rounded-xl shadow">
                            <h2 class="text-lg font-semibold">Account Details</h2>
                            <p>Name: {{ auth()->user()->name }}</p>
                            <p>Email: {{ auth()->user()->email }}</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- MODAL -->
    <div id="profileModal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-start justify-center z-50 overflow-y-auto">

        <div class="bg-white w-full max-w-3xl mt-20 rounded-2xl shadow-xl p-6 relative">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-5 border-b pb-3">
                <h2 class="text-xl font-bold">Update Profile</h2>

                <button onclick="closeModal()" class="text-gray-500 hover:text-red-500 text-lg">
                    ✕
                </button>
            </div>

            <!-- FORM -->
            <form method="POST" action="/update-profile">
                @csrf

                <!-- GRID START -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <input name="age" value="{{ auth()->user()->age }}" placeholder="Age" class="border rounded-lg p-2">

                    <input name="academy" value="{{ auth()->user()->academy }}" placeholder="Academy"
                        class="border rounded-lg p-2">

                    <input name="batting" value="{{ auth()->user()->batting }}" placeholder="Batting Style"
                        class="border rounded-lg p-2">

                    <input name="bowling" value="{{ auth()->user()->bowling }}" placeholder="Bowling Style"
                        class="border rounded-lg p-2">

                    <input name="total_matches" value="{{ auth()->user()->total_matches }}" placeholder="Total Matches"
                        class="border rounded-lg p-2">

                    <input name="runs" value="{{ auth()->user()->runs }}" placeholder="Runs" class="border rounded-lg p-2">

                    <input name="wickets" value="{{ auth()->user()->wickets }}" placeholder="Wickets"
                        class="border rounded-lg p-2">

                    <input name="strike_rate" value="{{ auth()->user()->strike_rate }}" placeholder="Strike Rate"
                        class="border rounded-lg p-2">

                    <input name="batting_average" value="{{ auth()->user()->batting_average }}"
                        placeholder="Batting Average" class="border rounded-lg p-2">

                    <input name="high_score" value="{{ auth()->user()->high_score }}" placeholder="High Score"
                        class="border rounded-lg p-2">

                </div>
                <!-- GRID END -->

                <!-- BUTTONS -->
                <div class="flex gap-3 mt-6">

                    <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Update Profile
                    </button>

                    <button type="button" onclick="closeModal()"
                        class="flex-1 border border-gray-300 py-2 rounded-lg hover:bg-gray-100">
                        Cancel
                    </button>

                </div>

            </form>

        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('profileModal').classList.remove('hidden');
            document.getElementById('profileModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('profileModal').classList.add('hidden');
        }
    </script>
    <script>
        function openTab(tabId) {

            // sab hide karo
            document.querySelectorAll('.tab-content').forEach(el => {
                el.classList.add('hidden');
            });

            // selected show karo
            document.getElementById(tabId).classList.remove('hidden');

            // active button style
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-blue-100', 'text-blue-600');
            });

            event.target.classList.add('bg-blue-100', 'text-blue-600');
        }
    </script>
@endsection