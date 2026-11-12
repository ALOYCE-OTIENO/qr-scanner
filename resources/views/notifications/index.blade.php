@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Notifications</h1>
    @if(auth()->user()->isAdmin())
        <a href="{{ route('notifications.create') }}" class="btn btn-wecom-primary">
            <i class="bi bi-megaphone me-2"></i>Send Announcement
        </a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        @if($notifications->count() > 0)
            <div class="list-group">
                @foreach($notifications as $notification)
                    @if($notification->route)
                    <a href="{{ $notification->route }}" class="list-group-item list-group-item-action {{ $notification->is_read ? '' : 'bg-light' }}" onclick="markAsRead({{ $notification->id }})">
                    @else
                    <div class="list-group-item {{ $notification->is_read ? '' : 'bg-light' }}">
                    @endif
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1" style="font-weight: 600;">{{ $notification->title }}</h6>
                                <p class="mb-1">{{ $notification->message }}</p>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            @if(!$notification->is_read && !$notification->route)
                                <form action="{{ route('notifications.mark-read', $notification->id) }}" method="POST" class="ms-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-wecom-outline">Mark Read</button>
                                </form>
                            @endif
                        </div>
                    @if($notification->route)
                    </a>
                    @else
                    </div>
                    @endif
                @endforeach
            </div>
            {{ $notifications->links() }}
        @else
            <div class="text-center py-5">
                <i class="bi bi-bell" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                <p class="mt-3" style="color: var(--wecom-gray);">No notifications</p>
            </div>
        @endif
    </div>
</div>

<script>
function markAsRead(notificationId) {
    fetch('/notifications/' + notificationId + '/mark-read', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({})
    }).then(response => {
        // Continue to the link destination
    }).catch(error => {
        console.error('Error marking as read:', error);
    });
}
</script>
@endsection
