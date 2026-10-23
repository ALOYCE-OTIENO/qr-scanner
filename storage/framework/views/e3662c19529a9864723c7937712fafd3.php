<?php $__env->startSection('title', 'Job Output'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Job Output</h1>
    <a href="<?php echo e(route('job-output.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Job Output
    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <?php if($jobOutputs->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Task Name</th>
                            <th>Quantity</th>
                            <th>Quality Score</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $jobOutputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobOutput): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($jobOutput->employee->full_name); ?></td>
                                <td><?php echo e($jobOutput->task_name); ?></td>
                                <td><?php echo e($jobOutput->quantity); ?> <?php echo e($jobOutput->unit); ?></td>
                                <td><?php echo e($jobOutput->quality_score ?? '-'); ?>/100</td>
                                <td>
                                    <span class="badge bg-<?php echo e($jobOutput->status === 'completed' ? 'success' : ($jobOutput->status === 'rejected' ? 'danger' : 'warning')); ?>">
                                        <?php echo e(ucfirst($jobOutput->status)); ?>

                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('job-output.edit', $jobOutput->id)); ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('job-output.destroy', $jobOutput->id)); ?>" method="POST" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($jobOutputs->links()); ?>

        <?php else: ?>
            <p class="text-muted text-center">No job outputs recorded</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/job-output/index.blade.php ENDPATH**/ ?>