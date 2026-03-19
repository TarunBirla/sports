{{-- ====== USERS PAGE: resources/views/admin/users.blade.php ====== --}}

@extends('admin.layout')

@section('page_title', 'Users')

@section('content')

<div class="page-header">
    <h1>All Users</h1>
    <p>Manage registered user accounts</p>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $u)
            <tr>
                <td>#{{ $u->id }}</td>
                <td style="font-weight:500;color:var(--text)">{{ $u->name }}</td>
                <td style="color:var(--muted)">{{ $u->email }}</td>
                <td style="color:var(--muted)">{{ $u->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">
                    <div class="empty-state">
                        <span class="emoji">👤</span>
                        <p>No users found</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection