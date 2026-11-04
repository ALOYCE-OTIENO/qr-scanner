@extends('layouts.app')

@section('title', 'Attendance')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Attendance</h1>
    <a href="{{ route('attendance.history') }}" class="btn btn-wecom-outline">View History</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- Check-in Confirmation Modal -->
@if(isset($employee) && isset($attendance))
<div class="modal fade" id="checkInConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid var(--wecom-border);">
                <h5 class="modal-title" style="font-weight: 600;">Check-In Successful! ✓</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div style="width: 80px; height: 80px; background: var(--wecom-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem; margin: 0 auto 1.5rem;">
                    <i class="bi bi-check-lg"></i>
                </div>
                <h4 style="font-weight: 600; color: #333; margin-bottom: 0.5rem;">{{ $employee->full_name }}</h4>
                <p class="text-muted mb-3">Employee ID: {{ $employee->employee_id }}</p>
                <div class="card bg-light border-0" style="background: var(--wecom-gray-light);">
                    <div class="card-body py-3">
                        <p class="mb-1" style="color: var(--wecom-gray);">Check-in Time</p>
                        <h3 style="font-weight: 600; color: var(--wecom-green); font-size: 2rem;">{{ $attendance->check_in_time }}</h3>
                        <p class="mb-0 small text-muted">{{ $attendance->date->format('l, F j, Y') }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge {{ $attendance->status === 'present' ? 'badge-success' : 'badge-warning' }} fs-6">
                        {{ ucfirst($attendance->status) }}
                    </span>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--wecom-border);">
                <button type="button" class="btn btn-wecom-primary" data-bs-dismiss="modal">
                    <i class="bi bi-check-circle me-2"></i>Got it
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@if($employee)
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                @if(auth()->user()->isAdmin())
                    Employee: {{ $employee->full_name }}
                @else
                    My Attendance
                @endif
            </h5>
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
                            @if(auth()->user()->isAdmin())
                            <form method="POST" action="{{ route('attendance.check-out') }}">
                                @csrf
                                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                                <button type="submit" class="btn btn-warning btn-lg w-100">
                                    <i class="bi bi-box-arrow-right"></i> Check Out
                                </button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('attendance.check-out') }}">
                                @csrf
                                <button type="submit" class="btn btn-wecom-primary w-100">
                                    <i class="bi bi-box-arrow-right"></i> Check Out
                                </button>
                            </form>
                            @endif
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
                    <p class="text-muted">
                        @if(auth()->user()->isAdmin())
                            Scan employee's QR code to check in
                        @else
                        Click below to check in for your shift
                        @endif
                    </p>
                    <form method="POST" action="{{ route('attendance.check-in') }}">
                        @csrf
                        @if(auth()->user()->isAdmin())
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        @endif
                        <button type="submit" class="btn btn-wecom-primary btn-lg px-5">
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

@if($employee && $attendance && session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = new bootstrap.Modal(document.getElementById('checkInConfirmModal'));
    modal.show();
});
</script>
@endif
@endsection
