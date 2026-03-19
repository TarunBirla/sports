@extends('admin.layout')

@section('page_title', 'Dashboard')

@section('content')

<div class="page-header">
    <h1>Overview</h1>
    <p>Welcome back! Here's what's happening today.</p>
</div>

<div class="cards">

    <div class="card">
        <span class="card-icon">👤</span>
        <div class="card-label">Total Users</div>
        <div class="card-value">{{ $data['users'] }}</div>
        <div class="card-glow" style="background:var(--accent)"></div>
    </div>

    <div class="card">
        <span class="card-icon">🏪</span>
        <div class="card-label">Vendors</div>
        <div class="card-value">{{ $data['vendors'] }}</div>
        <div class="card-glow" style="background:var(--accent2)"></div>
    </div>

    <div class="card">
        <span class="card-icon">🏋️</span>
        <div class="card-label">Products</div>
        <div class="card-value">{{ $data['products'] }}</div>
        <div class="card-glow" style="background:var(--success)"></div>
    </div>

    <div class="card">
        <span class="card-icon">📚</span>
        <div class="card-label">Courses</div>
        <div class="card-value">{{ $data['courses'] }}</div>
        <div class="card-glow" style="background:#f7c94f"></div>
    </div>

    <div class="card">
        <span class="card-icon">📦</span>
        <div class="card-label">Orders</div>
        <div class="card-value">{{ $data['orders'] }}</div>
        <div class="card-glow" style="background:var(--danger)"></div>
    </div>

</div>

@endsection