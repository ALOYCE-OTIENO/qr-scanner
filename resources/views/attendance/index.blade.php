@extends('layouts.app')

@section('title', 'Attendance')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Attendance</h1>
    <a href="{{ route('attendance.history') }}" class="btn btn-outline-primary">View History</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($employee)
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">Employee: {{ $employee->full_name }}</h5>
        </div>
        <div class="card-body">
            @if($attendance)
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Date:</strong> {{ $attendance->date->format('l, F j, Y') }}</p>
                        <p><strong>Check In:</strong> {{ $attendance->check_in_time }}</p>
                        @if($attendance->check_out_time)
                            <p><strong>Check Out:</strong> {{ $attendance->check_out_time }}</p>
                            <p><strong>Work Hours:</strong> {{ $attendance->work_hours }}</p>
                        @endif
                        <p><strong>Status:</strong> 
                            <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : 'warning' }}">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        @if(!$attendance->check_out_time)
                            <form method="POST" action="{{ route('attendance.check-out') }}">
                                @csrf
                                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                                <input type="hidden" name="qr_code" value="{{ $employee->qr_code }}">
                                <button type="submit" class="btn btn-warning btn-lg w-100">
                                    <i class="bi bi-box-arrow-right"></i> Check Out
                                </button>
                            </form>
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-check-circle"></i> You have already checked out today.
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x" style="font-size: 4rem; color: #667eea;"></i>
                    <h4 class="mt-3">Not Checked In Today</h4>
                    <p class="text-muted">Scan your QR code to check in</p>
                    <form method="POST" action="{{ route('attendance.check-in') }}">
                        @csrf
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <input type="hidden" name="qr_code" value="{{ $employee->qr_code }}">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-box-arrow-in-right"></i> Check In
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-qr-code-scan" style="font-size: 4rem; color: #667eea;"></i>
            <h4 class="mt-3">Scan QR Code</h4>
            <p class="text-muted">Scan an employee's QR code to manage attendance</p>
            <a href="{{ route('qr.scan') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-qr-code-scan"></i> Go to QR Scanner
            </a>
        </div>
    </div>
@endif
@endsection
