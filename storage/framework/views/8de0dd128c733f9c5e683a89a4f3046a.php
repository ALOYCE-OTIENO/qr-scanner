<?php $__env->startSection('title', 'Notifications'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Notifications</h1>
    <?php if(auth()->user()->isAdmin()): ?>
        <a href="<?php echo e(route('notifications.create')); ?>" class="btn btn-wecom-primary">
            <i class="bi bi-megaphone me-2"></i>Send Announcement
        </a>
    <?php endif; ?>
</div>

<div class="card">
    <div class="card-body">
        <?php if($notifications->count() > 0): ?>
            <div class="list-group">
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="list-group-item <?php echo e($notification->is_read ? '' : 'bg-light'); ?>">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1" style="font-weight: 600;"><?php echo e($notification->title); ?></h6>
                                <p class="mb-1"><?php echo e($notification->message); ?></p>
                                <small class="text-muted"><?php echo e($notification->created_at->diffForHumans()); ?></small>
                            </div>
                            <?php if(!$notification->is_read): ?>
                                <form action="<?php echo e(route('notifications.mark-read', $notification->id)); ?>" method="POST" class="ms-2">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-sm btn-wecom-outline">Mark Read</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php echo e($notifications->links()); ?>

        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-bell" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                <p class="mt-3" style="color: var(--wecom-gray);">No notifications</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/notifications/index.blade.php ENDPATH**/ ?>