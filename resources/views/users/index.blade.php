@extends('layouts.base')

@section('title', 'User Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-people"></i> User Management</h1>
            <p>Manage system users and their roles</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-light">
            <i class="bi bi-person-plus"></i> Add New User
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-people"></i> All Users ({{ $users->total() }})</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="usersTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar" style="width:36px;height:36px;border-radius:50%;background:{{ $user->isAdmin() ? '#3498db' : '#27ae60' }};color:white;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:14px;flex-shrink:0;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <strong>{{ $user->name }}</strong>
                                    @if($user->id === auth()->id())
                                        <span class="badge" style="background:#f39c12;color:white;font-size:10px;">You</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->isAdmin())
                                    <span class="badge" style="background-color:#3498db;color:white;">
                                        <i class="bi bi-shield-check"></i> Admin
                                    </span>
                                @else
                                    <span class="badge" style="background-color:#27ae60;color:white;">
                                        <i class="bi bi-person"></i> Staff
                                    </span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('users.edit', $user) }}"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                                              onsubmit="return confirm('Delete user {{ addslashes($user->name) }}? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled title="Cannot delete your own account">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-people fs-3 d-block mb-2"></i>
                                No users found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} users
            </small>
            {{ $users->links() }}
        </div>
    </div>
</div>

@section('scripts')
<script>
$(document).ready(function () {
    // Live search filter
    $('#userSearch').on('keyup', function () {
        var val = $(this).val().toLowerCase();
        $('#usersTable tbody tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
        });
    });
});
</script>
@endsection
@endsection
