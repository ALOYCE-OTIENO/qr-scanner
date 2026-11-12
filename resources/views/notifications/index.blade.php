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

<div class="card mb-4">
    <div class="card-header bg-wecom-green-light">
        <h5 class="mb-0" style="color: var(--wecom-green);">
            <i class="bi bi-bell-fill me-2"></i>Unread Notifications ({{ $unreadNotifications->count() }})
        </h5>
    </div>
    <div class="card-body">
        @if($unreadNotifications->count() > 0)
            <div class="list-group">
                @foreach($unreadNotifications as $notification)
                    @if($notification->route)
                    <a href="{{ $notification->route }}" class="list-group-item list-group-item-action bg-wecom-green-light" onclick="markAsRead({{ $notification->id }})">
                    @else
                    <div class="list-group-item bg-wecom-green-light">
                    @endif
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-start">
                                <div style="width: 8px; height: 8px; background: var(--wecom-green); border-radius: 50%; margin-top: 8px; margin-right: 12px; flex-shrink: 0;"></div>
                                <div>
                                    <h6 class="mb-1" style="font-weight: 600;">{{ $notification->title }}</h6>
                                    <p class="mb-1">{{ $notification->message }}</p>
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            @if(!$notification->route)
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
        @else
            <div class="text-center py-5">
                <i class="bi bi-check-circle" style="font-size: 4rem; color: var(--wecom-green);"></i>
                <p class="mt-3" style="color: var(--wecom-gray);">No unread notifications</p>
            </div>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 text-muted">
            <i class="bi bi-check2-circle me-2"></i>Read Notifications ({{ $readNotifications->count() }})
        </h5>
    </div>
    <div class="card-body">
        @if($readNotifications->count() > 0)
            <div class="list-group">
                @foreach($readNotifications as $notification)
                    @if($notification->route)
                    <a href="{{ $notification->route }}" class="list-group-item list-group-item-action">
                    @else
                    <div class="list-group-item">
                    @endif
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-start">
                                <div>
                                    <h6 class="mb-1" style="font-weight: 600;">
                                        {{ $notification->title }}
                                        @if(isset($notification->is_merged) && $notification->is_merged)
                                        <span class="badge bg-secondary ms-2">{{ $notification->merged_count }} messages</span>
                                        @endif
                                    </h6>
                                    <p class="mb-1 text-muted">{{ $notification->message }}</p>
                                    <small class="text-muted">
                                        {{ $notification->created_at->diffForHumans() }}
                                        @if(isset($notification->is_merged) && $notification->is_merged)
                                        • {{ $notification->merged_count }} read messages
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    @if($notification->route)
                    </a>
                    @else
                    </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-x-circle" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                <p class="mt-3" style="color: var(--wecom-gray);">No read notifications</p>
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
