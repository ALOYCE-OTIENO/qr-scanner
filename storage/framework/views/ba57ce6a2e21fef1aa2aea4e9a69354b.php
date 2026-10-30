<?php $__env->startSection('title', 'Work Groups'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Work Groups</h1>
    <a href="<?php echo e(route('groups.create')); ?>" class="btn btn-wecom-primary">
        <i class="bi bi-plus-lg me-2"></i>Create Group
    </a>
</div>

<div class="row">
    <?php if($groups->count() > 0): ?>
        <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo e($group->name); ?></h5>
                        <p class="card-text text-muted small"><?php echo e($group->description); ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted"><?php echo e($group->users->count()); ?> members</small>
                            <a href="<?php echo e(route('groups.show', $group->id)); ?>" class="btn btn-sm btn-wecom-outline">View</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-people" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                    <p class="mt-3" style="color: var(--wecom-gray);">No groups yet</p>
                    <a href="<?php echo e(route('groups.create')); ?>" class="btn btn-wecom-primary">
                        <i class="bi bi-plus-lg me-2"></i>Create Your First Group
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/groups/index.blade.php ENDPATH**/ ?>