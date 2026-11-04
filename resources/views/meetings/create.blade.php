@extends('layouts.app')

@section('title', 'Schedule Meeting')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Schedule Meeting</h1>
    <a href="{{ route('meetings.index') }}" class="btn btn-wecom-outline">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('meetings.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required placeholder="e.g., Weekly Team Meeting">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Meeting agenda"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="e.g., Conference Room A">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="meeting">Meeting</option>
                        <option value="video_call">Video Call</option>
                        <option value="training">Training</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="participants" class="form-label">Participants</label>
                <select class="form-select" id="participants" name="participants[]" multiple>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Hold Ctrl/Cmd to select multiple</small>
            </div>

            <button type="submit" class="btn btn-wecom-primary">
                <i class="bi bi-calendar-check me-2"></i>Schedule Meeting
            </button>
        </form>
    </div>
</div>
@endsection
