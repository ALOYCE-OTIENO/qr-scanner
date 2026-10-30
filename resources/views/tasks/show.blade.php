@extends('layouts.app')

@section('title', 'Task Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ $task->title }}</h1>
    <div class="d-flex gap-2">
        @if($task->creator_id === auth()->id() || auth()->user()->isAdmin())
        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-wecom-outline">Edit</a>
        @endif
        <a href="{{ route('tasks.index') }}" class="btn btn-wecom-outline">Back</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p class="mb-1"><strong>Status:</strong> 
                    <span class="badge {{ $task->status === 'completed' ? 'badge-success' : ($task->status === 'in_progress' ? 'badge-info' : 'badge-warning') }}">
                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                    </span>
                </p>
                <p class="mb-1"><strong>Priority:</strong> 
                    <span class="badge {{ $task->priority === 'urgent' ? 'badge-danger' : ($task->priority === 'high' ? 'badge-warning' : 'badge-success') }}">
                        {{ ucfirst($task->priority) }}
                    </span>
                </p>
                <p class="mb-1"><strong>Created by:</strong> {{ $task->creator->name }}</p>
                <p class="mb-1"><strong>Created on:</strong> {{ $task->created_at->format('M d, Y H:i') }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-1"><strong>Assigned to:</strong> {{ $task->assignee ? $task->assignee->name : 'Unassigned' }}</p>
                @if($task->due_date)
                <p class="mb-1"><strong>Due date:</strong> {{ $task->due_date->format('M d, Y') }}</p>
                @endif
                @if($task->completed_at)
                <p class="mb-1"><strong>Completed on:</strong> {{ $task->completed_at->format('M d, Y H:i') }}</p>
                @endif
            </div>
        </div>

        <hr>

        <div class="mb-4">
            <h5 class="mb-2">Description</h5>
            <p>{{ $task->description }}</p>
        </div>

        <hr>

        <div class="mb-3">
            <label class="form-label">Update Status</label>
            <form action="{{ route('tasks.update-status', $task->id) }}" method="POST" class="d-flex gap-2">
                @csrf
                <select class="form-select" name="status" style="width: auto;">
                    <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $task->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="btn btn-wecom-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
