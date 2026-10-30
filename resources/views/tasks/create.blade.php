@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Create Task</h1>
    <a href="{{ route('tasks.index') }}" class="btn btn-wecom-outline">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required placeholder="e.g., Complete monthly report">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Provide task details"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="assignee_id" class="form-label">Assign To</label>
                    <select class="form-select" id="assignee_id" name="assignee_id">
                        <option value="">Unassigned</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="priority" class="form-label">Priority</label>
                    <select class="form-select" id="priority" name="priority" required>
                        <option value="low">Low</option>
                        <option value="medium" selected>Medium</option>
                        <option value="high">High</option>
                        <option value="urgent">Urgent</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="due_date" class="form-label">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date">
            </div>

            <button type="submit" class="btn btn-wecom-primary">
                <i class="bi bi-send me-2"></i>Create Task
            </button>
        </form>
    </div>
</div>
@endsection
