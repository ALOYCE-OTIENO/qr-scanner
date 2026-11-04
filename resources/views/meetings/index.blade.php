@extends('layouts.app')

@section('title', 'Meetings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Meetings</h1>
    <a href="{{ route('meetings.create') }}" class="btn btn-wecom-primary">
        <i class="bi bi-plus-lg me-2"></i>Schedule Meeting
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($meetings->count() > 0)
            <div class="list-group">
                @foreach($meetings as $meeting)
                    <a href="{{ route('meetings.show', $meeting->id) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1" style="font-weight: 600;">
                                    <span class="badge badge-info">{{ ucfirst($meeting->type) }}</span>
                                    {{ $meeting->title }}
                                </h6>
                                <p class="mb-1 text-muted small">{{ $meeting->description }}</p>
                                <small class="text-muted">
                                    {{ $meeting->start_time->format('M d, Y H:i') }} - {{ $meeting->end_time->format('H:i') }}
                                    @if($meeting->location)
                                        | {{ $meeting->location }}
                                    @endif
                                </small>
                            </div>
                            <small class="text-muted">{{ $meeting->participants->count() }} participants</small>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-calendar-event" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                <p class="mt-3" style="color: var(--wecom-gray);">No meetings scheduled</p>
                <a href="{{ route('meetings.create') }}" class="btn btn-wecom-primary">
                    <i class="bi bi-plus-lg me-2"></i>Schedule Your First Meeting
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
