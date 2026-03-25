<!-- @extends('layouts.app')

@section('content')

<div style="min-height:80vh;display:flex;align-items:center;justify-content:center;padding:2rem">
<div style="width:100%;max-width:420px;background:#fff;border:1px solid #d0e2f7;border-radius:20px;overflow:hidden;box-shadow:0 8px 32px rgba(26,111,212,0.10)">

    {{-- Card header --}}
    <div style="background:linear-gradient(135deg,#fef3c7,#fde68a);padding:2rem 2rem 1.5rem;text-align:center">
        <div style="width:56px;height:56px;border-radius:50%;background:rgba(180,83,9,0.12);display:flex;align-items:center;justify-content:center;font-size:1.6rem;margin:0 auto 1rem">🏪</div>
        <div style="font-family:'Bebas Neue',sans-serif;font-size:1.6rem;letter-spacing:0.05em;color:#0d1f3c">Vendor Portal</div>
        <div style="font-size:0.85rem;color:#92400e;margin-top:4px">Sign in to manage your listings &amp; orders</div>
    </div>

    {{-- Form body --}}
    <div style="padding:2rem">

        @if(session('error'))
            <div style="background:#fee2e2;border:1px solid #fca5a5;border-radius:8px;padding:10px 14px;color:#dc2626;font-size:0.875rem;margin-bottom:1.25rem;display:flex;align-items:center;gap:8px">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/vendor/login">
            @csrf

            {{-- Email --}}
            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#4a6890;letter-spacing:0.05em;text-transform:uppercase;margin-bottom:6px">Email Address</label>
                <input
                    name="email"
                    type="email"
                    placeholder="you@example.com"
                    value="{{ old('email') }}"
                    style="width:100%;padding:10px 14px;border:1.5px solid #d0e2f7;border-radius:10px;font-size:0.95rem;color:#0d1f3c;background:#f0f6ff;outline:none;transition:border-color 0.18s;font-family:'DM Sans',sans-serif"
                    onfocus="this.style.borderColor='#b45309';this.style.background='#fff'"
                    onblur="this.style.borderColor='#d0e2f7';this.style.background='#f0f6ff'"
                >
                @error('email')
                    <span style="font-size:0.78rem;color:#dc2626;margin-top:4px;display:block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div style="margin-bottom:1.5rem">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
                    <label style="font-size:0.8rem;font-weight:600;color:#4a6890;letter-spacing:0.05em;text-transform:uppercase">Password</label>
                    <a href="/vendor/forgot-password" style="font-size:0.78rem;color:#b45309;text-decoration:none">Forgot password?</a>
                </div>
                <input
                    name="password"
                    type="password"
                    placeholder="••••••••"
                    style="width:100%;padding:10px 14px;border:1.5px solid #d0e2f7;border-radius:10px;font-size:0.95rem;color:#0d1f3c;background:#f0f6ff;outline:none;transition:border-color 0.18s;font-family:'DM Sans',sans-serif"
                    onfocus="this.style.borderColor='#b45309';this.style.background='#fff'"
                    onblur="this.style.borderColor='#d0e2f7';this.style.background='#f0f6ff'"
                >
                @error('password')
                    <span style="font-size:0.78rem;color:#dc2626;margin-top:4px;display:block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Submit --}}
            <button
                type="submit"
                style="width:100%;padding:11px;border-radius:10px;background:#b45309;color:#fff;font-size:0.95rem;font-weight:600;border:none;cursor:pointer;transition:background 0.18s;font-family:'DM Sans',sans-serif;letter-spacing:0.02em"
                onmouseover="this.style.background='#92400e'"
                onmouseout="this.style.background='#b45309'"
            >
                Sign In to Portal →
            </button>

        </form>

        {{-- Divider --}}
        <div style="display:flex;align-items:center;gap:12px;margin:1.5rem 0">
            <div style="flex:1;height:1px;background:#d0e2f7"></div>
            <span style="font-size:0.78rem;color:#8aaac8">Not a vendor yet?</span>
            <div style="flex:1;height:1px;background:#d0e2f7"></div>
        </div>

        {{-- Bottom links --}}
        <div style="display:flex;gap:10px">
            <a href="/vendor/register"
               style="flex:1;text-align:center;padding:9px;border-radius:10px;background:#fef3c7;color:#b45309;font-size:0.85rem;font-weight:600;text-decoration:none;border:1px solid #fcd34d;transition:background 0.18s"
               onmouseover="this.style.background='#fde68a'"
               onmouseout="this.style.background='#fef3c7'"
            >Become Seller</a>
            <a href="/login"
               style="flex:1;text-align:center;padding:9px;border-radius:10px;background:#e3eefd;color:#1a6fd4;font-size:0.85rem;font-weight:600;text-decoration:none;border:1px solid #93c5fd;transition:background 0.18s"
               onmouseover="this.style.background='#c8dff9'"
               onmouseout="this.style.background='#e3eefd'"
            >User Login</a>
        </div>

    </div>
</div>
</div>

@endsection -->

