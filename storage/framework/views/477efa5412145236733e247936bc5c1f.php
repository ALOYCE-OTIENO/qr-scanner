<?php $__env->startSection('title', 'Employee Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Employee: <?php echo e($employee->full_name); ?></h1>
    <div>
        <a href="<?php echo e(route('employees.edit', $employee->id)); ?>" class="btn btn-outline-primary">Edit</a>
        <a href="<?php echo e(route('employees.index')); ?>" class="btn btn-outline-secondary">Back</a>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Employee Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Employee ID:</strong> <?php echo e($employee->employee_id); ?></p>
                <p><strong>Name:</strong> <?php echo e($employee->full_name); ?></p>
                <p><strong>Email:</strong> <?php echo e($employee->email); ?></p>
                <p><strong>Phone:</strong> <?php echo e($employee->phone ?? '-'); ?></p>
                <p><strong>Department:</strong> <?php echo e($employee->department); ?></p>
                <p><strong>Position:</strong> <?php echo e($employee->position); ?></p>
                <p><strong>Hire Date:</strong> <?php echo e($employee->hire_date->format('M d, Y')); ?></p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-<?php echo e($employee->is_active ? 'success' : 'danger'); ?>">
                        <?php echo e($employee->is_active ? 'Active' : 'Inactive'); ?>

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
                <?php if($employee->qr_code): ?>
                    <img src="<?php echo e(asset('storage/qr_codes/' . $employee->employee_id . '.png')); ?>" 
                         alt="QR Code" 
                         class="img-fluid mb-3"
                         style="max-width: 200px;">
                    <p class="small text-muted">Scan this QR code for attendance</p>
                <?php else: ?>
                    <p class="text-muted">QR code not generated</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Statistics</h5>
            </div>
            <div class="card-body">
                <p><strong>Total Attendances:</strong> <?php echo e($employee->attendances->count()); ?></p>
                <p><strong>Total Job Outputs:</strong> <?php echo e($employee->jobOutputs->count()); ?></p>
                <p><strong>Completed Jobs:</strong> <?php echo e($employee->jobOutputs->where('status', 'completed')->count()); ?></p>
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
                <?php if($employee->attendances->count() > 0): ?>
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
                                <?php $__currentLoopData = $employee->attendances->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($attendance->date->format('M d')); ?></td>
                                        <td><?php echo e($attendance->check_in_time); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($attendance->status === 'present' ? 'success' : 'warning'); ?>">
                                                <?php echo e(ucfirst($attendance->status)); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No attendance records</p>
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
                <?php if($employee->jobOutputs->count() > 0): ?>
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
                                <?php $__currentLoopData = $employee->jobOutputs->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobOutput): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($jobOutput->task_name); ?></td>
                                        <td><?php echo e($jobOutput->quantity); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($jobOutput->status === 'completed' ? 'success' : 'warning'); ?>">
                                                <?php echo e(ucfirst($jobOutput->status)); ?>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No job outputs</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/employees/show.blade.php ENDPATH**/ ?>