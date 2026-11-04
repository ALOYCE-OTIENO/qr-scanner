<?php $__env->startSection('title', 'Tasks'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Tasks</h1>
    <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-wecom-primary">
        <i class="bi bi-plus-lg me-2"></i>New Task
    </a>
</div>

<ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#created" type="button">Created by Me (<?php echo e($myCreatedTasks->count()); ?>)</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#assigned" type="button">Assigned to Me (<?php echo e($myAssignedTasks->count()); ?>)</button>
    </li>
</ul>

<div class="tab-content">
    <!-- Created Tasks -->
    <div class="tab-pane fade show active" id="created">
        <div class="card">
            <div class="card-body">
                <?php if($myCreatedTasks->count() > 0): ?>
                    <div class="list-group">
                        <?php $__currentLoopData = $myCreatedTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('tasks.show', $task->id)); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1" style="font-weight: 600;">
                                        <span class="badge <?php echo e($task->priority === 'urgent' ? 'badge-danger' : ($task->priority === 'high' ? 'badge-warning' : 'badge-success')); ?>">
                                            <?php echo e(ucfirst($task->priority)); ?>

                                        </span>
                                        <?php echo e($task->title); ?>

                                    </h6>
                                    <p class="mb-1 text-muted small"><?php echo e($task->description); ?></p>
                                    <small class="text-muted">
                                        Assigned to: <?php echo e($task->assignee ? $task->assignee->name : 'Unassigned'); ?>

                                        <?php if($task->due_date): ?>
                                            | Due: <?php echo e($task->due_date->format('M d, Y')); ?>

                                        <?php endif; ?>
                                    </small>
                                </div>
                                <span class="badge <?php echo e($task->status === 'completed' ? 'badge-success' : ($task->status === 'in_progress' ? 'badge-info' : 'badge-warning')); ?>">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $task->status))); ?>

                                </span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-list-check" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                        <p class="mt-3" style="color: var(--wecom-gray);">No tasks created yet</p>
                        <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-wecom-primary">
                            <i class="bi bi-plus-lg me-2"></i>Create Your First Task
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Assigned Tasks -->
    <div class="tab-pane fade" id="assigned">
        <div class="card">
            <div class="card-body">
                <?php if($myAssignedTasks->count() > 0): ?>
                    <div class="list-group">
                        <?php $__currentLoopData = $myAssignedTasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('tasks.show', $task->id)); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1" style="font-weight: 600;">
                                        <span class="badge <?php echo e($task->priority === 'urgent' ? 'badge-danger' : ($task->priority === 'high' ? 'badge-warning' : 'badge-success')); ?>">
                                            <?php echo e(ucfirst($task->priority)); ?>

                                        </span>
                                        <?php echo e($task->title); ?>

                                    </h6>
                                    <p class="mb-1 text-muted small"><?php echo e($task->description); ?></p>
                                    <small class="text-muted">
                                        Created by: <?php echo e($task->creator->name); ?>

                                        <?php if($task->due_date): ?>
                                            | Due: <?php echo e($task->due_date->format('M d, Y')); ?>

                                        <?php endif; ?>
                                    </small>
                                </div>
                                <span class="badge <?php echo e($task->status === 'completed' ? 'badge-success' : ($task->status === 'in_progress' ? 'badge-info' : 'badge-warning')); ?>">
                                    <?php echo e(ucfirst(str_replace('_', ' ', $task->status))); ?>

                                </span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 4rem; color: var(--wecom-gray);"></i>
                        <p class="mt-3" style="color: var(--wecom-gray);">No tasks assigned to you</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/tasks/index.blade.php ENDPATH**/ ?>