@extends('layouts.app')

@section('title', 'Chat with ' . $otherUser->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <a href="javascript:history.back()" class="back-link me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        {{ $otherUser->name }}
    </h1>
    <div id="deleteActions" class="d-flex gap-2" style="display: none;">
        <form method="POST" action="{{ route('messages.destroy-selected') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i> Delete Selected
            </button>
        </form>
        <button type="button" class="btn btn-sm btn-secondary" onclick="clearSelection()">
            Cancel
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body p-0" style="max-height: 500px; overflow-y: auto;">
        <div class="p-3">
            @if($messages->count() > 0)
                @foreach($messages as $message)
                    <div class="d-flex mb-3 {{ $message->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                        @if($message->sender_id !== auth()->id())
                            <div class="me-2">
                                <div style="width: 40px; height: 40px; background: var(--wecom-green-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--wecom-green); font-size: 1rem;">
                                    {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                                </div>
                            </div>
                        @endif
                        <div class="{{ $message->sender_id === auth()->id() ? 'bg-success text-white' : 'bg-light' }} rounded p-3 message-bubble" 
                             style="max-width: 70%; cursor: pointer; user-select: none;"
                             data-message-id="{{ $message->id }}"
                             oncontextmenu="showContextMenu(event, {{ $message->id }})"
                             onmousedown="startLongPress(event, {{ $message->id }})"
                             onmouseup="cancelLongPress()"
                             onmouseleave="cancelLongPress()"
                             ontouchstart="startLongPress(event, {{ $message->id }})"
                             ontouchend="cancelLongPress()">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="me-2" id="checkbox-{{ $message->id }}" style="display: none;">
                                    <input type="checkbox" class="message-checkbox" value="{{ $message->id }}" onchange="checkSelection()">
                                </div>
                                <div>
                                    <p class="mb-1" style="font-size: 0.9rem;">{{ $message->content }}</p>
                                    <small class="{{ $message->sender_id === auth()->id() ? 'text-white-50' : 'text-muted' }}" style="font-size: 0.75rem;">
                                        {{ $message->created_at->format('H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <p style="color: var(--wecom-gray);">No messages yet. Start the conversation!</p>
                </div>
            @endif
        </div>
    </div>
    <div class="card-footer bg-white border-top">
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $otherUser->id }}">
            <div class="input-group">
                <input type="text" class="form-control" name="content" placeholder="Type a message..." required>
                <button type="submit" class="btn btn-wecom-primary">
                    <i class="bi bi-send"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Context Menu -->
<div id="contextMenu" class="context-menu" style="display: none; position: fixed; z-index: 1000; background: white; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 16px rgba(0,0,0,0.15); min-width: 150px;">
    <div class="context-menu-item" onclick="deleteSingleMessage()" style="padding: 10px 15px; cursor: pointer; display: flex; align-items: center; gap: 8px;">
        <i class="bi bi-trash text-danger"></i>
        <span>Delete</span>
    </div>
    <div class="context-menu-item" onclick="startSelection()" style="padding: 10px 15px; cursor: pointer; display: flex; align-items: center; gap: 8px; border-top: 1px solid #eee;">
        <i class="bi bi-check-square"></i>
        <span>Select Multiple</span>
    </div>
</div>

<style>
.message-bubble:hover {
    opacity: 0.9;
}
.message-bubble.selected {
    border: 2px solid var(--wecom-green);
}
.context-menu-item:hover {
    background: #f5f5f5;
}
</style>

<script>
let selectedMessageId = null;
let selectedMessages = new Set();
let longPressTimer = null;
let longPressActive = false;

function showContextMenu(event, messageId) {
    event.preventDefault();
    selectedMessageId = messageId;
    
    const menu = document.getElementById('contextMenu');
    menu.style.display = 'block';
    menu.style.left = event.pageX + 'px';
    menu.style.top = event.pageY + 'px';
}

function hideContextMenu() {
    document.getElementById('contextMenu').style.display = 'none';
}

document.addEventListener('click', function(event) {
    if (!event.target.closest('#contextMenu')) {
        hideContextMenu();
    }
});

function deleteSingleMessage() {
    if (selectedMessageId) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/messages/' + selectedMessageId;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = document.querySelector('meta[name="csrf-token"]').content;
        form.appendChild(csrf);
        
        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';
        form.appendChild(method);
        
        document.body.appendChild(form);
        form.submit();
    }
    hideContextMenu();
}

function startSelection() {
    if (selectedMessageId) {
        selectedMessages.add(selectedMessageId);
        document.getElementById('checkbox-' + selectedMessageId).style.display = 'block';
        checkSelection();
    }
    hideContextMenu();
}

function startLongPress(event, messageId) {
    longPressActive = false;
    longPressTimer = setTimeout(function() {
        longPressActive = true;
        selectedMessageId = messageId;
        selectedMessages.add(messageId);
        document.getElementById('checkbox-' + messageId).style.display = 'block';
        document.querySelector('#checkbox-' + messageId + ' input').checked = true;
        checkSelection();
    }, 500);
}

function cancelLongPress() {
    clearTimeout(longPressTimer);
}

document.addEventListener('click', function(event) {
    if (!event.target.closest('.message-bubble') && !event.target.closest('#deleteActions')) {
        clearSelection();
    }
});

function checkSelection() {
    const checkboxes = document.querySelectorAll('.message-checkbox:checked');
    if (checkboxes.length > 0) {
        document.getElementById('deleteActions').style.display = 'flex';
    } else {
        document.getElementById('deleteActions').style.display = 'none';
    }
}

function clearSelection() {
    selectedMessages.clear();
    document.querySelectorAll('.message-checkbox').forEach(cb => {
        cb.checked = false;
        cb.closest('#checkbox-' + cb.value).style.display = 'none';
    });
    document.getElementById('deleteActions').style.display = 'none';
}
</script>
@endsection
