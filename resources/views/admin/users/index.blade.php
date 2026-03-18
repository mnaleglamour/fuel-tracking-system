@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h1><i class="bi bi-people me-2"></i>Attendants</h1>
        <p>Manage all system users and their roles</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-success">
        <i class="bi bi-person-plus me-2"></i>Create User
    </a>
</div>

@if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header d-flex align-items-center gap-2 py-3">
        <i class="bi bi-table text-primary"></i>
        <span class="fw-semibold">All Users</span>
        <span class="badge bg-secondary ms-1">{{ $users->total() }}</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background:var(--primary-navy);">
                    <tr>
                        <th class="text-white px-4 py-3">Name</th>
                        <th class="text-white px-4 py-3">Email</th>
                        <th class="text-white px-4 py-3">Role</th>
                        <th class="text-white px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                     style="width:36px;height:36px;background:var(--accent-blue);font-size:14px;flex-shrink:0;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="fw-semibold" style="color:var(--primary-navy);">{{ $user->name }}</span>
                                @if(auth()->id() === $user->id)
                                    <span class="badge bg-light text-muted">you</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 text-muted">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            @if($user->role === 'admin')
                                <span class="badge rounded-pill" style="background:var(--accent-blue);">Admin</span>
                            @else
                                <span class="badge rounded-pill bg-secondary">Attendant</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if(auth()->id() !== $user->id)
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Delete user {{ $user->name }}?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-3 d-block mb-2"></i>No users found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white px-4 py-3">
        {{ $users->links() }}
    </div>
</div>
@endsection
