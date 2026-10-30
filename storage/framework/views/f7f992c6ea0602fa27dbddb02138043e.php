<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Dashboard</h1>
    <span class="text-muted"><?php echo e(now()->format('l, F j, Y')); ?></span>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="stat-card">
            <i class="bi bi-people"></i>
            <h3><?php echo e($totalEmployees); ?></h3>
            <p>Total Employees</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="bi bi-calendar-check"></i>
            <h3><?php echo e($presentToday); ?></h3>
            <p>Present Today</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="bi bi-clipboard-data"></i>
            <h3><?php echo e($jobOutputsToday); ?></h3>
            <p>Job Outputs Today</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <i class="bi bi-clock-history"></i>
            <h3><?php echo e($lateToday); ?></h3>
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
                <?php if($recentAttendances->count() > 0): ?>
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
                                <?php $__currentLoopData = $recentAttendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($attendance->employee->full_name); ?></td>
                                        <td><?php echo e($attendance->date->format('M d, Y')); ?></td>
                                        <td><?php echo e($attendance->check_in_time); ?></td>
                                        <td>
                                            <span class="badge <?php echo e($attendance->status === 'present' ? 'badge-success' : 'badge-warning'); ?>">
                                                <?php echo e(ucfirst($attendance->status)); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center">No recent attendances</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Job Outputs</h5>
            </div>
            <div class="card-body">
                <?php if($recentJobOutputs->count() > 0): ?>
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
                                <?php $__currentLoopData = $recentJobOutputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobOutput): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($jobOutput->employee->full_name); ?></td>
                                        <td><?php echo e($jobOutput->task_name); ?></td>
                                        <td><?php echo e($jobOutput->quantity); ?> <?php echo e($jobOutput->unit); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($jobOutput->status === 'completed' ? 'success' : ($jobOutput->status === 'rejected' ? 'danger' : 'warning')); ?>">
                                                <?php echo e(ucfirst($jobOutput->status)); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center">No recent job outputs</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Attendance Chart
const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
new Chart(attendanceCtx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode($attendanceLabels, 15, 512) ?>,
        datasets: [
            {
                label: 'Total Attendance',
                data: <?php echo json_encode($attendanceData, 15, 512) ?>,
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'Late Arrivals',
                data: <?php echo json_encode($lateData, 15, 512) ?>,
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
        labels: <?php echo json_encode($jobOutputLabels, 15, 512) ?>,
        datasets: [
            {
                label: 'Total Job Outputs',
                data: <?php echo json_encode($jobOutputData, 15, 512) ?>,
                backgroundColor: 'rgba(17, 153, 142, 0.8)',
                borderColor: '#11998e',
                borderWidth: 1
            },
            {
                label: 'Completed',
                data: <?php echo json_encode($completedJobData, 15, 512) ?>,
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/dashboard.blade.php ENDPATH**/ ?>