@extends('layouts.app')

@section('title', 'Job Output')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Job Output</h1>
    <a href="{{ route('job-output.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Job Output
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        @if($jobOutputs->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Task Name</th>
                            <th>Quantity</th>
                            <th>Quality Score</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobOutputs as $jobOutput)
                            <tr>
                                <td>{{ $jobOutput->employee->full_name }}</td>
                                <td>{{ $jobOutput->task_name }}</td>
                                <td>{{ $jobOutput->quantity }} {{ $jobOutput->unit }}</td>
                                <td>{{ $jobOutput->quality_score ?? '-' }}/100</td>
                                <td>
                                    <span class="badge bg-{{ $jobOutput->status === 'completed' ? 'success' : ($jobOutput->status === 'rejected' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($jobOutput->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('job-output.edit', $jobOutput->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('job-output.destroy', $jobOutput->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $jobOutputs->links() }}
        @else
            <p class="text-muted text-center">No job outputs recorded</p>
        @endif
    </div>
</div>
@endsection
