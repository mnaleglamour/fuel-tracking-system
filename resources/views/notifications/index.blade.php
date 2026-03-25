@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Notifications</h4>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <form method="POST" action="{{ route('notifications.read-all') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-primary">Mark All as Read</button>
                        </form>
                    @endif
                </div>
                <div class="card-body">
                    @forelse($notifications as $notification)
                        <div class="notification-item {{ !$notification->read_at ? 'bg-light' : '' }} p-3 mb-3 border rounded">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>{{ $notification->data['pump']['name'] ?? 'Low Stock Alert' }}</strong>
                                    <br>
                                    <small class="text-muted">
                                        Stock: {{ $notification->data['remaining'] }} L
                                        @if(isset($notification->data['attempted']) && $notification->data['attempted'] > 0)
                                            (Attempted: {{ $notification->data['attempted'] }} L)
                                        @endif
                                    </small>
                                </div>
                                <div>
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    @if(!$notification->read_at)
                                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Mark Read</button>
                                        </form>
                                    @else
                                        <span class="badge bg-success">Read</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted">No notifications.</p>
                    @endforelse

                    <div class="mt-4">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

