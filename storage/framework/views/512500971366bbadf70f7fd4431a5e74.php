<?php $__env->startSection('title', 'Employee Directory'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Employee Directory</h1>
</div>

<div class="card">
    <div class="card-body">
        <?php if($users->count() > 0): ?>
            <div class="row">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($user->id !== auth()->id()): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <div style="width: 64px; height: 64px; background: var(--wecom-green-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--wecom-green); font-size: 1.5rem; margin: 0 auto 1rem;">
                                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                </div>
                                <h5 class="card-title"><?php echo e($user->name); ?></h5>
                                <p class="card-text text-muted small"><?php echo e($user->email); ?></p>
                                <?php if($user->is_admin): ?>
                                    <span class="badge badge-success">Admin</span>
                                <?php endif; ?>
                                <div class="mt-3">
                                    <a href="<?php echo e(route('messages.show', $user->id)); ?>" class="btn btn-sm btn-wecom-primary">
                                        <i class="bi bi-chat-dots me-1"></i>Message
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <p style="color: var(--wecom-gray);">No employees found</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/directory/index.blade.php ENDPATH**/ ?>