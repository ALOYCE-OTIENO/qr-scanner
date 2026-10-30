@extends('layouts.app')

@section('title', 'Work Groups')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Work Groups</h1>
    <a href="{{ route('groups.create') }}" class="btn btn-wecom-primary">
        <i class="bi bi-plus-lg me-2"></i>Create Group
    </a>
</div>

<div class="row">
    @if($groups->count() > 0)
        @foreach($groups as $group)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $group->name }}</h5>
                        <p class="card-text text-muted small">{{ $group->description }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">{{ $group->users->count() }} members</small>
                            <a href="{{ route('groups.show', $group->id) }}" class="btn btn-sm btn-wecom-outline">View</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-people" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                    <p class="mt-3" style="color: var(--wecom-gray);">No groups yet</p>
                    <a href="{{ route('groups.create') }}" class="btn btn-wecom-primary">
                        <i class="bi bi-plus-lg me-2"></i>Create Your First Group
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
