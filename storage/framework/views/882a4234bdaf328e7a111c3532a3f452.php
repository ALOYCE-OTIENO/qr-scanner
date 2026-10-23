<?php $__env->startSection('title', 'Generate QR Code'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>QR Code Generated</h1>
    <a href="<?php echo e(route('qr.scan')); ?>" class="btn btn-outline-primary">Back to Scanner</a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="mb-4"><?php echo e($employee->full_name); ?></h4>
                <p class="text-muted">Employee ID: <?php echo e($employee->employee_id); ?></p>
                
                <div class="my-4">
                    <img src="<?php echo e($qrCodeUrl); ?>" alt="QR Code" class="img-fluid" style="max-width: 300px;">
                </div>
                
                <p class="text-muted small">QR Code: <?php echo e($employee->qr_code); ?></p>
                
                <div class="mt-4">
                    <a href="<?php echo e($qrCodeUrl); ?>" download="qr_<?php echo e($employee->employee_id); ?>.png" class="btn btn-primary">
                        <i class="bi bi-download"></i> Download QR Code
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/qr-code/generate.blade.php ENDPATH**/ ?>