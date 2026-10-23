@extends('layouts.app')

@section('title', 'Edit Job Output')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Edit Job Output</h1>
    <a href="{{ route('job-output.index') }}" class="btn btn-outline-primary">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('job-output.update', $jobOutput->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="task_name" class="form-label">Task Name</label>
                <input type="text" class="form-control" id="task_name" name="task_name" required value="{{ $jobOutput->task_name }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $jobOutput->description }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required min="0" value="{{ $jobOutput->quantity }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" required value="{{ $jobOutput->unit }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="quality_score" class="form-label">Quality Score (0-100)</label>
                        <input type="number" class="form-control" id="quality_score" name="quality_score" min="0" max="100" step="0.01" value="{{ $jobOutput->quality_score }}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="pending" {{ $jobOutput->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $jobOutput->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="rejected" {{ $jobOutput->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks</label>
                <textarea class="form-control" id="remarks" name="remarks" rows="2">{{ $jobOutput->remarks }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Job Output</button>
        </form>
    </div>
</div>
@endsection
