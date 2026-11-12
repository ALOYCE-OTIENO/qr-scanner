@extends('layouts.app')

@section('title', $group->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ $group->name }}</h1>
    <a href="{{ route('groups.index') }}" class="btn btn-wecom-outline">
        <i class="bi bi-arrow-left me-2"></i>Back
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">{{ $group->name }}</h5>
        @if($group->description)
        <p class="card-text">{{ $group->description }}</p>
        @endif
        @if($group->is_announcement)
        <span class="badge bg-warning">Announcement Group</span>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Members ({{ $group->users->count() }})</h5>
            </div>
            <div class="card-body">
                @if($group->users->count() > 0)
                    <ul class="list-group">
                        @foreach($group->users as $member)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $member->name }}</strong>
                                @if($member->pivot->is_admin)
                                <span class="badge bg-primary ms-2">Admin</span>
                                @endif
                            </div>
                            <a href="{{ route('messages.show', $member->id) }}" class="btn btn-sm btn-wecom-outline">
                                <i class="bi bi-chat"></i> Message
                            </a>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No members yet</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add Member</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('groups.add-member', $group->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Select User</label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            @foreach(\App\Models\User::where('id', '!=', auth()->id())->get() as $user)
                            @if(!$group->users->contains($user->id))
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-wecom-primary">
                        <i class="bi bi-person-plus me-2"></i>Add Member
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection