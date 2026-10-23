@extends('layouts.app')

@section('title', 'Add Job Output')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Add Job Output</h1>
    <a href="{{ route('job-output.index') }}" class="btn btn-outline-primary">Back</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('job-output.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employee</label>
                        <select class="form-select" id="employee_id" name="employee_id" required>
                            <option value="">Select Employee</option>
                            @foreach(\App\Models\Employee::where('is_active', true)->get() as $employee)
                                <option value="{{ $employee->id }}" {{ $employeeId == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->full_name }} ({{ $employee->employee_id }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="attendance_id" class="form-label">Attendance (Optional)</label>
                        <select class="form-select" id="attendance_id" name="attendance_id">
                            <option value="">Select Attendance</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="task_name" class="form-label">Task Name</label>
                <input type="text" class="form-control" id="task_name" name="task_name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required min="0" value="0">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit" required value="units">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="quality_score" class="form-label">Quality Score (0-100)</label>
                        <input type="number" class="form-control" id="quality_score" name="quality_score" min="0" max="100" step="0.01">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks</label>
                <textarea class="form-control" id="remarks" name="remarks" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Job Output</button>
        </form>
    </div>
</div>
@endsection
