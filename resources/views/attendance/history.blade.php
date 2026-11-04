@extends('layouts.app')

@section('title', 'Attendance History')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Attendance History</h1>
    <a href="{{ route('attendance.index') }}" class="btn btn-wecom-outline">Back to Attendance</a>
</div>

<div class="card">
    <div class="card-body">
        @if($attendances->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Check In Time</th>
                            <th>Check Out Time</th>
                            <th>Work Hours</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>
                                    <div style="font-weight: 600;">{{ $attendance->employee->full_name }}</div>
                                    <small class="text-muted">{{ $attendance->employee->employee_id }}</small>
                                </td>
                                <td>{{ $attendance->date->format('M d, Y') }}</td>
                                <td>
                                    <span style="font-weight: 600; color: var(--wecom-green);">{{ $attendance->check_in_time }}</span>
                                </td>
                                <td>
                                    @if($attendance->check_out_time)
                                        <span style="font-weight: 600; color: #333;">{{ $attendance->check_out_time }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($attendance->work_hours)
                                        <span style="font-weight: 600;">{{ $attendance->work_hours }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $attendance->status === 'present' ? 'badge-success' : 'badge-warning' }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $attendances->links() }}
        @else
            <div class="text-center py-5">
                <i class="bi bi-calendar-x" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                <p class="mt-3" style="color: var(--wecom-gray);">No attendance records found</p>
            </div>
        @endif
    </div>
</div>
@endsection
