<?php $__env->startSection('title', 'Attendance'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Attendance</h1>
    <a href="<?php echo e(route('attendance.history')); ?>" class="btn btn-outline-primary">View History</a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<?php if($employee): ?>
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">Employee: <?php echo e($employee->full_name); ?></h5>
        </div>
        <div class="card-body">
            <?php if($attendance): ?>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Date:</strong> <?php echo e($attendance->date->format('l, F j, Y')); ?></p>
                        <p><strong>Check In:</strong> <?php echo e($attendance->check_in_time); ?></p>
                        <?php if($attendance->check_out_time): ?>
                            <p><strong>Check Out:</strong> <?php echo e($attendance->check_out_time); ?></p>
                            <p><strong>Work Hours:</strong> <?php echo e($attendance->work_hours); ?></p>
                        <?php endif; ?>
                        <p><strong>Status:</strong> 
                            <span class="badge bg-<?php echo e($attendance->status === 'present' ? 'success' : 'warning'); ?>">
                                <?php echo e(ucfirst($attendance->status)); ?>

                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <?php if(!$attendance->check_out_time): ?>
                            <form method="POST" action="<?php echo e(route('attendance.check-out')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="attendance_id" value="<?php echo e($attendance->id); ?>">
                                <input type="hidden" name="qr_code" value="<?php echo e($employee->qr_code); ?>">
                                <button type="submit" class="btn btn-warning btn-lg w-100">
                                    <i class="bi bi-box-arrow-right"></i> Check Out
                                </button>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <i class="bi bi-check-circle"></i> You have already checked out today.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x" style="font-size: 4rem; color: #667eea;"></i>
                    <h4 class="mt-3">Not Checked In Today</h4>
                    <p class="text-muted">Scan your QR code to check in</p>
                    <form method="POST" action="<?php echo e(route('attendance.check-in')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="employee_id" value="<?php echo e($employee->id); ?>">
                        <input type="hidden" name="qr_code" value="<?php echo e($employee->qr_code); ?>">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-box-arrow-in-right"></i> Check In
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-qr-code-scan" style="font-size: 4rem; color: #667eea;"></i>
            <h4 class="mt-3">Scan QR Code</h4>
            <p class="text-muted">Scan an employee's QR code to manage attendance</p>
            <a href="<?php echo e(route('qr.scan')); ?>" class="btn btn-primary btn-lg">
                <i class="bi bi-qr-code-scan"></i> Go to QR Scanner
            </a>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/attendance/index.blade.php ENDPATH**/ ?>