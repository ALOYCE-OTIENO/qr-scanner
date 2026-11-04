<?php $__env->startSection('title', 'Attendance'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Attendance</h1>
    <a href="<?php echo e(route('attendance.history')); ?>" class="btn btn-wecom-outline">View History</a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
<?php endif; ?>

<!-- Check-in Confirmation Modal -->
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
                <h4 style="font-weight: 600; color: #333; margin-bottom: 0.5rem;"><?php echo e($employee->full_name); ?></h4>
                <p class="text-muted mb-3">Employee ID: <?php echo e($employee->employee_id); ?></p>
                <div class="card bg-light border-0" style="background: var(--wecom-gray-light);">
                    <div class="card-body py-3">
                        <p class="mb-1" style="color: var(--wecom-gray);">Check-in Time</p>
                        <h3 style="font-weight: 600; color: var(--wecom-green); font-size: 2rem;"><?php echo e($attendance->check_in_time); ?></h3>
                        <p class="mb-0 small text-muted"><?php echo e($attendance->date->format('l, F j, Y')); ?></p>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge <?php echo e($attendance->status === 'present' ? 'badge-success' : 'badge-warning'); ?> fs-6">
                        <?php echo e(ucfirst($attendance->status)); ?>

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
<?php endif; ?>

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

<?php if($employee && $attendance && session('success')): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = new bootstrap.Modal(document.getElementById('checkInConfirmModal'));
    modal.show();
});
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/attendance/index.blade.php ENDPATH**/ ?>