@extends('layouts.app')

@section('title', 'Attendance History')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Attendance History</h1>
    <a href="{{ route('attendance.index') }}" class="btn btn-outline-primary">Back to Attendance</a>
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
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Work Hours</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->employee->full_name }}</td>
                                <td>{{ $attendance->date->format('M d, Y') }}</td>
                                <td>{{ $attendance->check_in_time }}</td>
                                <td>{{ $attendance->check_out_time ?? '-' }}</td>
                                <td>{{ $attendance->work_hours ?? '-' }}</td>
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
            {{ $attendances->links() }}
        @else
            <p class="text-muted text-center">No attendance records found</p>
        @endif
    </div>
</div>
@endsection
