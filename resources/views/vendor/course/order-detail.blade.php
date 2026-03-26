@extends('vendor.layout')

@section('page_title', 'Order Detail')

@section('content')

<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1e40af;
        --accent: #10b981;
        --danger: #ef4444;
        --muted: #6b7280;
        --light: #f9fafb;
        --lighter: #f3f4f6;
        --border: #e5e7eb;
        --text: #111827;
        --text-muted: #6b7280;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', 'Ubuntu', 'Cantarell', sans-serif;
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        color: var(--text);
        line-height: 1.6;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    /* Header Section */
    .page-header {
        margin-bottom: 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-title {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--text);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .page-title-icon {
        font-size: 2rem;
        opacity: 0.8;
    }

    .breadcrumb-nav {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    .breadcrumb-nav a {
        color: var(--primary);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .breadcrumb-nav a:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    /* Main Card */
    .order-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08), 0 10px 30px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid var(--border);
        transition: all 0.3s ease;
    }

    .order-card:hover {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 15px 40px rgba(0, 0, 0, 0.08);
    }

    /* Card Header */
    .card-header {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        padding: 2rem;
        border-bottom: 1px solid var(--border);
    }

    .course-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        word-break: break-word;
    }

    .course-badge {
        display: inline-block;
        background: var(--primary);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Card Content */
    .card-content {
        padding: 2rem;
    }

    .info-section {
        margin-bottom: 2rem;
    }

    .info-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-size: 0.95rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title-icon {
        font-size: 1.1rem;
    }

    .info-row {
        display: grid;
        grid-template-columns: 140px 1fr;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid var(--lighter);
        align-items: center;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .info-value {
        color: var(--text);
        font-size: 0.95rem;
        font-weight: 500;
        word-break: break-word;
    }

    .info-value.email {
        color: var(--primary);
        word-break: break-all;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--lighter);
    }

    .stat-box {
        background: var(--light);
        padding: 1.25rem;
        border-radius: 12px;
        border: 1px solid var(--border);
        text-align: center;
        transition: all 0.3s ease;
    }

    .stat-box:hover {
        background: white;
        border-color: var(--primary);
    }

    .stat-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--primary);
    }

    /* Total Section */
    .total-section {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-top: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .total-label {
        font-size: 0.9rem;
        font-weight: 600;
        opacity: 0.9;
    }

    .total-amount {
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -1px;
    }

    /* Footer Actions */
    .card-footer {
        padding: 2rem;
        background: var(--light);
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
    }

    .btn-back {
        background: white;
        color: var(--primary);
        border: 2px solid var(--primary);
    }

    .btn-back:hover {
        background: var(--primary);
        color: white;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(37, 99, 235, 0.3);
    }

    .btn-secondary {
        background: white;
        color: var(--text);
        border: 1px solid var(--border);
    }

    .btn-secondary:hover {
        background: var(--lighter);
        border-color: var(--text-muted);
    }

    /* Order Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: rgba(16, 185, 129, 0.1);
        color: var(--accent);
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        border: 1px solid var(--accent);
    }

    .status-badge::before {
        content: '●';
        font-size: 0.6rem;
    }

    /* Divider */
    .divider {
        height: 1px;
        background: var(--border);
        margin: 1.5rem 0;
    }

    /* Date Badge */
    .date-badge {
        display: inline-block;
        background: var(--light);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        color: var(--text-muted);
        border: 1px solid var(--border);
    }

    /* Print Styles */
    @media print {
        body {
            background: white;
        }

        .order-card {
            box-shadow: none;
            border: 1px solid #ccc;
        }

        .btn,
        .action-buttons {
            display: none;
        }
    }

    /* Responsive */
    @media (max-width: 640px) {
        .container {
            padding: 1rem 0.5rem;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .card-header {
            padding: 1.5rem;
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .info-row {
            grid-template-columns: 100px 1fr;
            gap: 0.75rem;
            padding: 0.75rem 0;
        }

        .info-label {
            font-size: 0.85rem;
        }

        .info-value {
            font-size: 0.9rem;
        }

        .total-section {
            flex-direction: column;
            text-align: center;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .breadcrumb-nav {
            font-size: 0.8rem;
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        :root {
            --text: #f3f4f6;
            --text-muted: #9ca3af;
            --light: #1f2937;
            --lighter: #111827;
            --border: #374151;
        }

        body {
            background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
            color: var(--text);
        }

        .order-card {
            background: #1f2937;
            border-color: var(--border);
        }

        .card-header {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            border-bottom-color: var(--border);
        }

        .stat-box {
            background: #111827;
            border-color: var(--border);
        }

        .stat-box:hover {
            background: #1f2937;
        }

        .card-footer {
            background: #111827;
            border-top-color: var(--border);
        }

        .total-section {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }

        .course-title {
            color: var(--text);
        }

        .info-value {
            color: var(--text);
        }

        .btn-secondary {
            background: #374151;
            color: var(--text);
            border-color: #4b5563;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }
    }
</style>

<div class="container">

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">
            <span class="page-title-icon">📄</span>
            Order Detail
        </h1>
        <div class="breadcrumb-nav">
            <a href="/vendor/dashboard">Dashboard</a>
            <span>/</span>
            <a href="/vendor/course-orders/10">Orders</a>
            <span>/</span>
            <span>#{{ $orderItem->order_id }}</span>
            <a href="{{ url('/trainer/stats/'.$orderItem->course->category_id) }}"
                style="display:inline-flex;align-items:center;gap:4px;padding:6px 12px;border-radius:8px;background:#dcfce7;color:#16a34a;font-size:0.8rem;font-weight:600;border:1px solid #86efac;text-decoration:none">
                📊 Add Stats
            </a>
            <a href="/stats/create/1/{{auth()->user()->id}}"
                style="display:inline-flex;align-items:center;gap:4px;padding:6px 12px;border-radius:8px;background:#dcfce7;color:#16a34a;font-size:0.8rem;font-weight:600;border:1px solid #86efac;text-decoration:none">
                📊 Add Stats
            </a>
           
        </div>
    </div>

    <!-- Main Order Card -->
    <div class="order-card">

        <!-- Card Header with Course Title -->
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 250px;">
                    <h2 class="course-title">
                        📚
                        {{ $orderItem->course->title ?? 'Course' }}
                    </h2>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.5rem;">
                        {{ Str::limit($orderItem->course->description ?? 'No description', 100) }}
                    </p>
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem; align-items: flex-end;">
                    <span class="course-badge">Active Course</span>
                    <span class="status-badge">Completed</span>
                </div>
            </div>
        </div>

        <!-- Card Content -->
        <div class="card-content">

            <!-- Customer Information Section -->
            <div class="info-section">
                <h3 class="section-title">
                    <span class="section-title-icon">👤</span>
                    Customer Information
                </h3>
                <div class="info-row">
                    <div class="info-label">Full Name</div>
                    <div class="info-value">{{ $orderItem->order->user->name ?? 'Guest User' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email Address</div>
                    <div class="info-value email">
                        <a href="mailto:{{ $orderItem->order->user->email ?? '#' }}" style="color: inherit; text-decoration: none;">
                            {{ $orderItem->order->user->email ?? 'No email' }}
                        </a>
                    </div>
                </div>
                @if($orderItem->order->user->phone ?? null)
                <div class="info-row">
                    <div class="info-label">Phone Number</div>
                    <div class="info-value">
                        <a href="tel:{{ $orderItem->order->user->phone }}" style="color: inherit; text-decoration: none;">
                            {{ $orderItem->order->user->phone }}
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <div class="divider"></div>

            <!-- Order Information Section -->
            <div class="info-section">
                <h3 class="section-title">
                    <span class="section-title-icon">📦</span>
                    Order Information
                </h3>
                <div class="info-row">
                    <div class="info-label">Order ID</div>
                    <div class="info-value" style="font-family: monospace; font-weight: 700; color: var(--primary);">
                        #{{ $orderItem->order_id }}
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Order Date</div>
                    <div class="info-value">
                        <span class="date-badge">
                            📅 {{ $orderItem->created_at->format('d M Y') }}
                        </span>
                        <span style="color: var(--text-muted); margin-left: 0.5rem;">
                            {{ $orderItem->created_at->format('h:i A') }}
                        </span>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Quantity</div>
                    <div class="info-value">{{ $orderItem->qty }} {{ Str::plural('item', $orderItem->qty) }}</div>
                </div>
            </div>

            <div class="divider"></div>

            <!-- Pricing Information -->
            <div class="info-section">
                <h3 class="section-title">
                    <span class="section-title-icon">💷</span>
                    Pricing Breakdown
                </h3>

                <div class="stats-grid">
                    <div class="stat-box">
                        <div class="stat-label">Unit Price</div>
                        <div class="stat-value">£{{ number_format($orderItem->price, 2) }}</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">Quantity</div>
                        <div class="stat-value">{{ $orderItem->qty }}</div>
                    </div>
                </div>

                <div class="total-section">
                    <div class="total-label">Total Amount Due</div>
                    <div class="total-amount">£{{ number_format($orderItem->price * $orderItem->qty, 2) }}</div>
                </div>
            </div>

        </div>

        <!-- Card Footer with Actions -->
        <div class="card-footer">
            <div style="flex: 1;">
                <p style="margin: 0; color: var(--text-muted); font-size: 0.85rem;">
                    Last updated: {{ $orderItem->updated_at->diffForHumans() }}
                </p>
            </div>
            <div class="action-buttons">
                <a href="{{ url()->previous() }}" class="btn btn-back">
                    <span>←</span> Back
                </a>
                <button class="btn btn-secondary" onclick="window.print()">
                    <span>🖨️</span> Print
                </button>
                <a href="#" class="btn btn-primary">
                    <span>💬</span> Contact Customer
                </a>
            </div>
        </div>

    </div>

</div>

@endsection