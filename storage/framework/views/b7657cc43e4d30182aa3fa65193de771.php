<?php $__env->startSection('header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            <?php echo e(__('User Management')); ?>

        </h2>
        <?php if(auth()->user()->hasRole('administrator')): ?>
            <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary"><?php echo e(__('Add New User')); ?></a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th><?php echo e(__('Name')); ?></th>
                        <th><?php echo e(__('Email')); ?></th>
                        <th><?php echo e(__('Role')); ?></th>
                        <th><?php echo e(__('Actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <?php if($user->roles->isNotEmpty()): ?>
                                    <?php echo e(ucfirst($user->roles->pluck('name')->join(', '))); ?>

                                <?php else: ?>
                                    <span class="text-muted"><?php echo e(__('No Role Assigned')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Edit Button -->
                                <?php if(auth()->user()->hasRole('administrator') ||
                                        (auth()->user()->hasRole('project manager') && $user->hasRole('team member'))): ?>
                                    <a href="<?php echo e(route('users.edit', $user->id)); ?>"
                                        class="btn btn-sm btn-info"><?php echo e(__('Edit')); ?></a>
                                <?php endif; ?>

                                <!-- Delete Button -->
                                <?php if(auth()->user()->hasRole('administrator')): ?>
                                    <form action="<?php echo e(route('users.destroy', $user->id)); ?>" method="POST"
                                        style="display: inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger"><?php echo e(__('Delete')); ?></button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted"><?php echo e(__('No users found.')); ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projectmanegement\resources\views/users/index.blade.php ENDPATH**/ ?>