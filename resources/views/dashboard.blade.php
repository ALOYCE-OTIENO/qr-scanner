@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Dashboard</h1>
    <span class="text-muted">{{ now()->format('l, F j, Y') }}</span>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card purple">
            <h3>{{ $totalEmployees }}</h3>
            <p>Total Employees</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card blue">
            <h3>{{ $presentToday }}</h3>
            <p>Present Today</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card green">
            <h3>{{ $jobOutputsToday }}</h3>
            <p>Job Outputs Today</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card orange">
            <h3>{{ $lateToday }}</h3>
            <p>Late Arrivals</p>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Attendance Trends (Last 7 Days)</h5>
            </div>
            <div class="card-body">
                <canvas id="attendanceChart" height="300"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Job Output Trends (Last 7 Days)</h5>
            </div>
            <div class="card-body">
                <canvas id="jobOutputChart" height="300"></canvas>
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
                @if($recentAttendances->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Check In</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentAttendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->employee->full_name }}</td>
                                        <td>{{ $attendance->date->format('M d, Y') }}</td>
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
                    <p class="text-muted text-center">No recent attendances</p>
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
                @if($recentJobOutputs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Task</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentJobOutputs as $jobOutput)
                                    <tr>
                                        <td>{{ $jobOutput->employee->full_name }}</td>
                                        <td>{{ $jobOutput->task_name }}</td>
                                        <td>{{ $jobOutput->quantity }} {{ $jobOutput->unit }}</td>
                                        <td>
                                            <span class="badge bg-{{ $jobOutput->status === 'completed' ? 'success' : ($jobOutput->status === 'rejected' ? 'danger' : 'warning') }}">
                                                {{ ucfirst($jobOutput->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">No recent job outputs</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Attendance Chart
const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
new Chart(attendanceCtx, {
    type: 'line',
    data: {
        labels: @json($attendanceLabels),
        datasets: [
            {
                label: 'Total Attendance',
                data: @json($attendanceData),
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'Late Arrivals',
                data: @json($lateData),
                borderColor: '#f5576c',
                backgroundColor: 'rgba(245, 87, 108, 0.1)',
                fill: true,
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Job Output Chart
const jobOutputCtx = document.getElementById('jobOutputChart').getContext('2d');
new Chart(jobOutputCtx, {
    type: 'bar',
    data: {
        labels: @json($jobOutputLabels),
        datasets: [
            {
                label: 'Total Job Outputs',
                data: @json($jobOutputData),
                backgroundColor: 'rgba(17, 153, 142, 0.8)',
                borderColor: '#11998e',
                borderWidth: 1
            },
            {
                label: 'Completed',
                data: @json($completedJobData),
                backgroundColor: 'rgba(56, 239, 125, 0.8)',
                borderColor: '#38ef7d',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});
</script>
@endpush
