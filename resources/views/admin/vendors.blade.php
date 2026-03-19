@extends('admin.layout')

@section('page_title', 'Vendors')

@section('content')

<div class="page-header">
    <h1>Vendor List</h1>
    <p>All registered product and training vendors</p>
</div>

@if($vendors->count() == 0)

    <div class="table-wrap">
        <div class="empty-state">
            <span class="emoji">🏪</span>
            <p>No vendors found</p>
        </div>
    </div>

@else

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendors as $v)
            <tr>
                <td>#{{ $v->id }}</td>
                <td style="font-weight:500;color:var(--text)">{{ $v->name }}</td>
                <td style="color:var(--muted)">{{ $v->email }}</td>
                <td>
                    @if($v->type == 'training')
                        <span class="badge badge-purple">Training Vendor</span>
                    @else
                        <span class="badge badge-green">Product Vendor</span>
                    @endif
                </td>
                <td style="color:var(--muted)">{{ $v->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endif

@endsection