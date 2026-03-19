@extends('admin.layout')

@section('page_title', 'Orders')

@section('content')

<div class="page-header">
    <h1>All Orders</h1>
    <p>View and manage customer orders</p>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>User ID</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $o)
            <tr>
                <td>#{{ $o->id }}</td>
                <td style="color:var(--muted)">#{{ $o->user_id }}</td>
                <td style="font-weight:600;color:var(--text)">₹{{ number_format($o->total) }}</td>
                <td>
                    @if(isset($o->status))
                        @if($o->status == 'completed')
                            <span class="badge badge-green">Completed</span>
                        @elseif($o->status == 'pending')
                            <span class="badge badge-blue">Pending</span>
                        @elseif($o->status == 'cancelled')
                            <span class="badge badge-red">Cancelled</span>
                        @else
                            <span class="badge badge-purple">{{ $o->status }}</span>
                        @endif
                    @else
                        <span class="badge badge-blue">Pending</span>
                    @endif
                </td>
                <td style="color:var(--muted)">{{ $o->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    <div class="empty-state">
                        <span class="emoji">📦</span>
                        <p>No orders found</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection