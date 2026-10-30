@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-wecom-primary">
        <i class="bi bi-plus-lg me-2"></i>New Task
    </a>
</div>

<ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#created" type="button">Created by Me ({{ $myCreatedTasks->count() }})</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#assigned" type="button">Assigned to Me ({{ $myAssignedTasks->count() }})</button>
    </li>
</ul>

<div class="tab-content">
    <!-- Created Tasks -->
    <div class="tab-pane fade show active" id="created">
        <div class="card">
            <div class="card-body">
                @if($myCreatedTasks->count() > 0)
                    <div class="list-group">
                        @foreach($myCreatedTasks as $task)
                            <a href="{{ route('tasks.show', $task->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1" style="font-weight: 600;">
                                        <span class="badge {{ $task->priority === 'urgent' ? 'badge-danger' : ($task->priority === 'high' ? 'badge-warning' : 'badge-success') }}">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                        {{ $task->title }}
                                    </h6>
                                    <p class="mb-1 text-muted small">{{ $task->description }}</p>
                                    <small class="text-muted">
                                        Assigned to: {{ $task->assignee ? $task->assignee->name : 'Unassigned' }}
                                        @if($task->due_date)
                                            | Due: {{ $task->due_date->format('M d, Y') }}
                                        @endif
                                    </small>
                                </div>
                                <span class="badge {{ $task->status === 'completed' ? 'badge-success' : ($task->status === 'in_progress' ? 'badge-info' : 'badge-warning') }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-list-check" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                        <p class="mt-3" style="color: var(--wecom-gray);">No tasks created yet</p>
                        <a href="{{ route('tasks.create') }}" class="btn btn-wecom-primary">
                            <i class="bi bi-plus-lg me-2"></i>Create Your First Task
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Assigned Tasks -->
    <div class="tab-pane fade" id="assigned">
        <div class="card">
            <div class="card-body">
                @if($myAssignedTasks->count() > 0)
                    <div class="list-group">
                        @foreach($myAssignedTasks as $task)
                            <a href="{{ route('tasks.show', $task->id) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1" style="font-weight: 600;">
                                        <span class="badge {{ $task->priority === 'urgent' ? 'badge-danger' : ($task->priority === 'high' ? 'badge-warning' : 'badge-success') }}">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                        {{ $task->title }}
                                    </h6>
                                    <p class="mb-1 text-muted small">{{ $task->description }}</p>
                                    <small class="text-muted">
                                        Created by: {{ $task->creator->name }}
                                        @if($task->due_date)
                                            | Due: {{ $task->due_date->format('M d, Y') }}
                                        @endif
                                    </small>
                                </div>
                                <span class="badge {{ $task->status === 'completed' ? 'badge-success' : ($task->status === 'in_progress' ? 'badge-info' : 'badge-warning') }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                        <p class="mt-3" style="color: var(--wecom-gray);">No tasks assigned to you</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
