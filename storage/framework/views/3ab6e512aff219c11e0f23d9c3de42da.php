<?php $__env->startSection('title', 'Approvals'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Approvals</h1>
    <a href="<?php echo e(route('approvals.create')); ?>" class="btn btn-wecom-primary">
        <i class="bi bi-plus-lg me-2"></i>New Request
    </a>
</div>

<ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#my-requests" type="button">My Requests</button>
    </li>
    <?php if(auth()->user()->isAdmin()): ?>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#to-review" type="button">To Review (<?php echo e($toReview->count()); ?>)</button>
    </li>
    <?php endif; ?>
</ul>

<div class="tab-content">
    <!-- My Requests -->
    <div class="tab-pane fade show active" id="my-requests">
        <div class="card">
            <div class="card-body">
                <?php if($myRequests->count() > 0): ?>
                    <div class="list-group">
                        <?php $__currentLoopData = $myRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $approval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('approvals.show', $approval->id)); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1" style="font-weight: 600;">
                                        <span class="badge <?php echo e($approval->status === 'approved' ? 'badge-success' : ($approval->status === 'rejected' ? 'badge-danger' : 'badge-warning')); ?>">
                                            <?php echo e(ucfirst($approval->status)); ?>

                                        </span>
                                        <?php echo e($approval->title); ?>

                                    </h6>
                                    <p class="mb-1 text-muted small"><?php echo e($approval->description); ?></p>
                                    <small class="text-muted"><?php echo e($approval->created_at->format('M d, Y')); ?></small>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-file-earmark-check" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                        <p class="mt-3" style="color: var(--wecom-gray);">No approval requests yet</p>
                        <a href="<?php echo e(route('approvals.create')); ?>" class="btn btn-wecom-primary">
                            <i class="bi bi-plus-lg me-2"></i>Create Your First Request
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- To Review (Admin Only) -->
    <?php if(auth()->user()->isAdmin()): ?>
    <div class="tab-pane fade" id="to-review">
        <div class="card">
            <div class="card-body">
                <?php if($toReview->count() > 0): ?>
                    <div class="list-group">
                        <?php $__currentLoopData = $toReview; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $approval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('approvals.show', $approval->id)); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1" style="font-weight: 600;">
                                        <span class="badge badge-warning">Pending</span>
                                        <?php echo e($approval->title); ?>

                                    </h6>
                                    <p class="mb-1 text-muted small"><?php echo e($approval->description); ?></p>
                                    <small class="text-muted">Requested by: <?php echo e($approval->requester->name); ?></small>
                                </div>
                                <i class="bi bi-chevron-right text-muted"></i>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-check-circle" style="font-size: 4rem; color: var(--wecom-green);"></i>
                        <p class="mt-3" style="color: var(--wecom-gray);">No pending approvals to review</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/approvals/index.blade.php ENDPATH**/ ?>