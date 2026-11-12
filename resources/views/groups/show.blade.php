@extends('layouts.app')

@section('title', $group->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ $group->name }}</h1>
    <a href="{{ route('groups.index') }}" class="btn btn-wecom-outline">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">{{ $group->name }}</h5>
        @if($group->description)
        <p class="card-text">{{ $group->description }}</p>
        @endif
        @if($group->is_announcement)
        <span class="badge bg-warning">Announcement Group</span>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Members ({{ $group->users->count() }})</h5>
            </div>
            <div class="card-body">
                @if($group->users->count() > 0)
                    <ul class="list-group">
                        @foreach($group->users as $member)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $member->name }}</strong>
                                @if($member->pivot->is_admin)
                                <span class="badge bg-primary ms-2">Admin</span>
                                @endif
                            </div>
                            <a href="{{ route('messages.show', $member->id) }}" class="btn btn-sm btn-wecom-outline">
                                <i class="bi bi-chat"></i> Message
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No members yet</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add Member</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('groups.add-member', $group->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Select User</label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                            @if(!$group->users->contains($user->id))
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-wecom-primary">
                        <i class="bi bi-person-plus me-2"></i>Add Member
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">{{ $group->name }}</h5>
        @if($group->description)
        <p class="card-text">{{ $group->description }}</p>
        @endif
        @if($group->is_announcement)
        <span class="badge bg-warning">Announcement Group</span>
        @endif
    </div>
</div>

<div class="card mb-4">
    <div class="card-body p-0" style="max-height: 500px; overflow-y: auto;">
        <div class="p-3">
            @if($group->messages->count() > 0)
                @foreach($group->messages as $message)
                    @if($message->is_private_reply)
                        <!-- Private reply (only visible to sender and recipient) -->
                        @if($message->sender_id === auth()->id() || $message->receiver_id === auth()->id())
                        <div class="alert alert-info mb-2" style="background: #e6f7ff; border-left: 4px solid #1890ff;">
                            <small class="text-muted">
                                <i class="bi bi-lock-fill"></i> Private reply from {{ $message->sender->name }} to {{ $message->replyToMessage->sender->name }}
                            </small>
                            <p class="mb-1 mt-1">{{ $message->content }}</p>
                            <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
                        </div>
                        @endif
                    @else
                        <!-- Regular group message -->
                        <div class="d-flex mb-3 {{ $message->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                            @if($message->sender_id !== auth()->id())
                                <div class="me-2">
                                    <div style="width: 40px; height: 40px; background: var(--wecom-green-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--wecom-green); font-size: 1rem;">
                                        {{ strtoupper(substr($message->sender->name, 0, 1)) }}
                                    </div>
                                </div>
                            @endif
                            <div class="{{ $message->sender_id === auth()->id() ? 'bg-success text-white' : 'bg-light' }} rounded p-3" style="max-width: 70%;">
                                @if($message->reply_to_message_id)
                                <div class="mb-2 p-2 rounded" style="background: rgba(0,0,0,0.05); font-size: 0.85rem;">
                                    <small class="text-muted">Replying to {{ $message->replyToMessage->sender->name }}:</small>
                                    <p class="mb-0">{{ $message->replyToMessage->content }}</p>
                                </div>
                                @endif
                                <p class="mb-1" style="font-size: 0.9rem;">{{ $message->content }}</p>
                                <small class="{{ $message->sender_id === auth()->id() ? 'text-white-50' : 'text-muted' }}" style="font-size: 0.75rem;">
                                    {{ $message->sender->name }} • {{ $message->created_at->format('H:i') }}
                                </small>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-sm btn-link text-muted p-0" onclick="showReplyOptions({{ $message->id }}, '{{ $message->sender->name }}')">
                                        <i class="bi bi-reply"></i> Reply
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="text-center py-5">
                    <p style="color: var(--wecom-gray);">No messages yet. Start the conversation!</p>
                </div>
            @endif
        </div>
    </div>
    <div class="card-footer bg-white border-top">
        <form action="{{ route('groups.send-message', $group->id) }}" method="POST">
            @csrf
            <input type="hidden" name="reply_to_message_id" id="reply_to_message_id">
            <input type="hidden" name="is_private_reply" id="is_private_reply" value="0">
            <div id="reply_preview" class="alert alert-info d-none mb-2 py-2">
                <small>Replying to <strong id="reply_to_name"></strong></small>
                <button type="button" class="btn btn-sm btn-link float-end" onclick="cancelReply()">✕</button>
                <div class="form-check mt-1">
                    <input class="form-check-input" type="checkbox" id="private_reply_check">
                    <label class="form-check-label" for="private_reply_check">
                        <i class="bi bi-lock-fill"></i> Reply privately
                    </label>
                </div>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" name="content" placeholder="Type a message..." required>
                <button type="submit" class="btn btn-wecom-primary">
                    <i class="bi bi-send"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Members ({{ $group->users->count() }})</h5>
            </div>
            <div class="card-body">
                @if($group->users->count() > 0)
                    <ul class="list-group">
                        @foreach($group->users as $member)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $member->name }}</strong>
                                @if($member->pivot->is_admin)
                                <span class="badge bg-primary ms-2">Admin</span>
                                @endif
                            </div>
                            <a href="{{ route('messages.show', $member->id) }}" class="btn btn-sm btn-wecom-outline">
                                <i class="bi bi-chat"></i> Message
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No members yet</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add Member</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('groups.add-member', $group->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Select User</label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                            @if(!$group->users->contains($user->id))
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-wecom-primary">
                        <i class="bi bi-person-plus me-2"></i>Add Member
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function showReplyOptions(messageId, senderName) {
    document.getElementById('reply_to_message_id').value = messageId;
    document.getElementById('reply_to_name').textContent = senderName;
    document.getElementById('reply_preview').classList.remove('d-none');
    document.getElementById('private_reply_check').checked = false;
    document.getElementById('is_private_reply').value = '0';
}

function cancelReply() {
    document.getElementById('reply_to_message_id').value = '';
    document.getElementById('reply_preview').classList.add('d-none');
}

document.getElementById('private_reply_check').addEventListener('change', function() {
    document.getElementById('is_private_reply').value = this.checked ? '1' : '0';
});
</script>
@endsection