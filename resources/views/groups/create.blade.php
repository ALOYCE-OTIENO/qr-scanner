@extends('layouts.app')

@section('title', 'Create Group')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Create Group</h1>
    <a href="{{ route('groups.index') }}" class="btn btn-wecom-outline">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('groups.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Group Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="members" class="form-label">Members</label>
                <select class="form-select" id="members" name="members[]" multiple>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Hold Ctrl/Cmd to select multiple members</small>
            </div>

            <div class="mb-3 form-check">
                <input type="hidden" name="is_announcement" value="0">
                <input class="form-check-input" type="checkbox" id="is_announcement" name="is_announcement" value="1">
                <label class="form-check-label" for="is_announcement">
                    Announcement Group (only admins can post)
                </label>
            </div>

            <button type="submit" class="btn btn-wecom-primary">
                <i class="bi bi-plus-circle me-2"></i>Create Group
            </button>
        </form>
    </div>
</div>
@endsection