<?php $__env->startSection('title', 'Employees'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Employees</h1>
    <a href="<?php echo e(route('employees.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Employee
    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-body">
        <?php if($employees->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($employee->employee_id); ?></td>
                                <td><?php echo e($employee->full_name); ?></td>
                                <td><?php echo e($employee->email); ?></td>
                                <td><?php echo e($employee->department); ?></td>
                                <td><?php echo e($employee->position); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo e($employee->is_active ? 'success' : 'danger'); ?>">
                                        <?php echo e($employee->is_active ? 'Active' : 'Inactive'); ?>

                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('employees.show', $employee->id)); ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('employees.edit', $employee->id)); ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('employees.destroy', $employee->id)); ?>" method="POST" style="display: inline;">
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
            <?php echo e($employees->links()); ?>

        <?php else: ?>
            <p class="text-muted text-center">No employees found</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\QR SCANNER\resources\views/employees/index.blade.php ENDPATH**/ ?>