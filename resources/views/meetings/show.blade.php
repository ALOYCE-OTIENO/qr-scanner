@extends('layouts.app')

@section('title', 'Meeting Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ $meeting->title }}</h1>
    <a href="javascript:history.back()" class="btn btn-wecom-outline">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p class="mb-1"><strong>Type:</strong> 
                    <span class="badge badge-info">{{ ucfirst($meeting->type) }}</span>
                </p>
                <p class="mb-1"><strong>Organizer:</strong> {{ $meeting->organizer->name }}</p>
                <p class="mb-1"><strong>Location:</strong> {{ $meeting->location ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-1"><strong>Start:</strong> {{ $meeting->start_time->format('M d, Y H:i') }}</p>
                <p class="mb-1"><strong>End:</strong> {{ $meeting->end_time->format('H:i') }}</p>
                <p class="mb-1"><strong>Participants:</strong> {{ $meeting->participants->count() }}</p>
            </div>
        </div>

        <hr>

        <div class="mb-4">
            <h5 class="mb-2">Description</h5>
            <p>{{ $meeting->description }}</p>
        </div>

        <hr>

        <div>
            <h5 class="mb-2">Participants</h5>
            @if($meeting->participants->count() > 0)
                <div class="d-flex flex-wrap gap-2">
                    @foreach($meeting->participants as $participant)
                        <span class="badge badge-success">{{ $participant->name }}</span>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No participants</p>
            @endif
        </div>
    </div>
</div>
@endsection
