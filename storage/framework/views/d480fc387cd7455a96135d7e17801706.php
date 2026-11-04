<?php $__env->startSection('title', 'Attendance Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Attendance Report</h1>
    <div>
        <a href="<?php echo e(route('reports.attendance.index')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <a href="<?php echo e(route('reports.attendance.export', request()->query())); ?>" class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i> Export CSV
        </a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card purple">
            <h3><?php echo e($totalDays); ?></h3>
            <p>Total Records</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card green">
            <h3><?php echo e($presentDays); ?></h3>
            <p>Present Days</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card orange">
            <h3><?php echo e($lateDays); ?></h3>
            <p>Late Arrivals</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card blue">
            <h3><?php echo e(number_format($totalWorkHours, 2)); ?></h3>
            <p>Total Work Hours</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-3">
            <?php if($type === 'daily'): ?>
                Daily Report for <?php echo e($startDate); ?>

            <?php elseif($type === 'weekly'): ?>
                Weekly Report for Week of <?php echo e($startDate); ?>

            <?php elseif($type === 'monthly'): ?>
                Monthly Report for <?php echo e(Carbon\Carbon::parse($startDate)->format('F Y')); ?>

            <?php else: ?>
                Custom Range: <?php echo e($startDate); ?> to <?php echo e($endDate); ?>

            <?php endif; ?>
        </h5>
        
        <?php if($attendances->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Work Hours</th>
                            <th>Status</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($attendance->date); ?></td>
                                <td>
                                    <strong><?php echo e($attendance->employee->full_name); ?></strong>
                                    <br>
                                    <small class="text-muted"><?php echo e($attendance->employee->employee_id); ?></small>
                                </td>
                                <td><?php echo e($attendance->employee->department); ?></td>
                                <td><?php echo e($attendance->check_in_time); ?></td>
                                <td><?php echo e($attendance->check_out_time ?? '-'); ?></td>
                                <td><?php echo e($attendance->work_hours ?? '-'); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo e($attendance->status === 'present' ? 'success' : ($attendance->status === 'late' ? 'warning' : 'danger')); ?>">
                                        <?php echo e(ucfirst($attendance->status)); ?>

                                    </span>
                                </td>
                                <td><?php echo e($attendance->notes ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No attendance records found for the selected criteria.
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/reports/attendance.blade.php ENDPATH**/ ?>