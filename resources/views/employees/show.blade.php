@extends('layouts.app')

@section('title', 'Employee Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Employee: {{ $employee->full_name }}</h1>
    <div>
        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-outline-primary">Edit</a>
        <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Employee Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
                <p><strong>Name:</strong> {{ $employee->full_name }}</p>
                <p><strong>Email:</strong> {{ $employee->email }}</p>
                <p><strong>Phone:</strong> {{ $employee->phone ?? '-' }}</p>
                <p><strong>Department:</strong> {{ $employee->department }}</p>
                <p><strong>Position:</strong> {{ $employee->position }}</p>
                <p><strong>Hire Date:</strong> {{ $employee->hire_date->format('M d, Y') }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-{{ $employee->is_active ? 'success' : 'danger' }}">
                        {{ $employee->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">QR Code</h5>
            </div>
            <div class="card-body text-center">
                @if($employee->qr_code)
                    <img src="{{ asset('storage/qr_codes/' . $employee->employee_id . '.png') }}" 
                         alt="QR Code" 
                         class="img-fluid mb-3"
                         style="max-width: 200px;">
                    <p class="small text-muted">Scan this QR code for attendance</p>
                @else
                    <p class="text-muted">QR code not generated</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Statistics</h5>
            </div>
            <div class="card-body">
                <p><strong>Total Attendances:</strong> {{ $employee->attendances->count() }}</p>
                <p><strong>Total Job Outputs:</strong> {{ $employee->jobOutputs->count() }}</p>
                <p><strong>Completed Jobs:</strong> {{ $employee->jobOutputs->where('status', 'completed')->count() }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Attendances</h5>
            </div>
            <div class="card-body">
                @if($employee->attendances->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Check In</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee->attendances->take(5) as $attendance)
                                    <tr>
                                        <td>{{ $attendance->date->format('M d') }}</td>
                                        <td>{{ $attendance->check_in_time }}</td>
                                        <td>
                                            <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : 'warning' }}">
                                                {{ ucfirst($attendance->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No attendance records</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Job Outputs</h5>
            </div>
            <div class="card-body">
                @if($employee->jobOutputs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee->jobOutputs->take(5) as $jobOutput)
                                    <tr>
                                        <td>{{ $jobOutput->task_name }}</td>
                                        <td>{{ $jobOutput->quantity }}</td>
                                        <td>
                                            <span class="badge bg-{{ $jobOutput->status === 'completed' ? 'success' : 'warning' }}">
                                                {{ ucfirst($jobOutput->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No job outputs</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
