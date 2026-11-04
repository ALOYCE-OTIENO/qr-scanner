<?php $__env->startSection('title', 'Employee Performance Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Employee Performance Report</h1>
    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="<?php echo e(route('reports.employee-performance')); ?>" method="GET">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="<?php echo e($startDate); ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="<?php echo e($endDate); ?>" required>
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-3">
            Performance Summary (<?php echo e(Carbon\Carbon::parse($startDate)->format('M d, Y')); ?> - <?php echo e(Carbon\Carbon::parse($endDate)->format('M d, Y')); ?>)
        </h5>
        
        <?php if(count($employeeData) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Attendance Days</th>
                            <th>Present</th>
                            <th>Late</th>
                            <th>Total Work Hours</th>
                            <th>Tasks Completed</th>
                            <th>Total Output</th>
                            <th>Avg Quality Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $employeeData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <strong><?php echo e($data['employee']->full_name); ?></strong>
                                    <br>
                                    <small class="text-muted"><?php echo e($data['employee']->employee_id); ?></small>
                                </td>
                                <td><?php echo e($data['employee']->department); ?></td>
                                <td><?php echo e($data['employee']->position); ?></td>
                                <td><?php echo e($data['attendance_count']); ?></td>
                                <td>
                                    <span class="badge bg-success"><?php echo e($data['present_days']); ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-warning"><?php echo e($data['late_days']); ?></span>
                                </td>
                                <td><?php echo e(number_format($data['total_work_hours'], 2)); ?> hrs</td>
                                <td><?php echo e($data['completed_tasks']); ?></td>
                                <td><?php echo e($data['total_quantity']); ?></td>
                                <td><?php echo e($data['avg_quality_score'] ? number_format($data['avg_quality_score'], 2) : '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> No performance data found for the selected period.
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/reports/employee-performance.blade.php ENDPATH**/ ?>