<?php $__env->startSection('title', 'Messages'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Messages</h1>
</div>

<div class="card">
    <div class="card-body">
        <?php if($conversations->count() > 0): ?>
            <div class="list-group">
                <?php $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userId => $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $conversation = $messages->first();
                        $otherUser = $conversation->sender_id === auth()->id() ? $conversation->receiver : $conversation->sender;
                    ?>
                    <a href="<?php echo e(route('messages.show', $otherUser->id)); ?>" class="list-group-item list-group-item-action d-flex align-items-center">
                        <div class="me-3">
                            <div style="width: 48px; height: 48px; background: var(--wecom-green-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--wecom-green); font-size: 1.25rem;">
                                <?php echo e(strtoupper(substr($otherUser->name, 0, 1))); ?>

                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-1" style="font-weight: 600;"><?php echo e($otherUser->name); ?></h6>
                                <small class="text-muted"><?php echo e($conversation->created_at->diffForHumans()); ?></small>
                            </div>
                            <p class="mb-0 text-muted small" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 300px;">
                                <?php echo e($conversation->content); ?>

                            </p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-chat-dots" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                <p class="mt-3" style="color: var(--wecom-gray);">No conversations yet</p>
                <a href="<?php echo e(route('directory.index')); ?>" class="btn btn-wecom-primary">
                    <i class="bi bi-person-plus me-2"></i>Find People
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/messages/index.blade.php ENDPATH**/ ?>