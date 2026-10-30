@extends('layouts.app')

@section('title', 'Chat with ' . $otherUser->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <a href="{{ route('messages.index') }}" class="back-link me-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        {{ $otherUser->name }}
    </h1>
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
                        <div class="{{ $message->sender_id === auth()->id() ? 'bg-success text-white' : 'bg-light' }} rounded p-3" style="max-width: 70%;">
                            <p class="mb-1" style="font-size: 0.9rem;">{{ $message->content }}</p>
                            <small class="{{ $message->sender_id === auth()->id() ? 'text-white-50' : 'text-muted' }}" style="font-size: 0.75rem;">
                                {{ $message->created_at->format('H:i') }}
                            </small>
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
@endsection
