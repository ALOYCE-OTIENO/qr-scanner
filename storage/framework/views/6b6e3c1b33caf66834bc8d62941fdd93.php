<?php $__env->startSection('title', 'Attendance Reports'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Attendance Reports</h1>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-4">Generate Attendance Report</h5>
        <form action="<?php echo e(route('reports.attendance')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Report Type</label>
                    <select name="type" class="form-select" id="reportType" onchange="toggleDateRange()">
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="<?php echo e(Carbon\Carbon::today()->format('Y-m-d')); ?>" required>
                </div>
                <div class="col-md-3 mb-3" id="endDateField" style="display: none;">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="<?php echo e(Carbon\Carbon::today()->format('Y-m-d')); ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Employee</label>
                    <select name="employee_id" class="form-select">
                        <option value="">All Employees</option>
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->full_name); ?> (<?php echo e($employee->employee_id); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Department</label>
                    <select name="department" class="form-select">
                        <option value="">All Departments</option>
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($department); ?>"><?php echo e($department); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-file-earmark-bar-graph"></i> Generate Report
            </button>
        </form>
    </div>
</div>

<script>
function toggleDateRange() {
    const reportType = document.getElementById('reportType').value;
    const endDateField = document.getElementById('endDateField');
    
    if (reportType === 'custom') {
        endDateField.style.display = 'block';
    } else {
        endDateField.style.display = 'none';
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/reports/attendance-index.blade.php ENDPATH**/ ?>