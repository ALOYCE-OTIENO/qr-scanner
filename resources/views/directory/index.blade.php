@extends('layouts.app')

@section('title', 'Employee Directory')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Employee Directory</h1>
</div>

<div class="card">
    <div class="card-body">
        @if($users->count() > 0)
            <div class="row">
                @foreach($users as $user)
                    @if($user->id !== auth()->id())
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <div style="width: 64px; height: 64px; background: var(--wecom-green-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--wecom-green); font-size: 1.5rem; margin: 0 auto 1rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text text-muted small">{{ $user->email }}</p>
                                @if($user->is_admin)
                                    <span class="badge badge-success">Admin</span>
                                @endif
                                <div class="mt-3">
                                    <a href="{{ route('messages.show', $user->id) }}" class="btn btn-sm btn-wecom-primary">
                                        <i class="bi bi-chat-dots me-1"></i>Message
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <p style="color: var(--wecom-gray);">No employees found</p>
            </div>
        @endif
    </div>
</div>
@endsection
