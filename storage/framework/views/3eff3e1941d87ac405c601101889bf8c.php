<?php $__env->startSection('header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            <?php echo e(__('Task Details')); ?>

        </h2>
        <a href="<?php echo e(route('projects.show', $task->project->id)); ?>" class="btn btn-warning"><?php echo e(__('Back to Project')); ?></a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title"><?php echo e($task->title); ?></h5>
            <p><strong><?php echo e(__('Project:')); ?></strong> <?php echo e($task->project->name); ?></p>
            <p><strong><?php echo e(__('Priority:')); ?></strong>
                <span
                    class="badge
                    <?php if($task->priority === 'LOW'): ?> bg-secondary
                    <?php elseif($task->priority === 'MEDIUM'): ?> bg-warning
                    <?php else: ?> bg-danger <?php endif; ?>">
                    <?php echo e(ucfirst(strtolower($task->priority))); ?>

                </span>
            </p>
            <p><strong><?php echo e(__('Status:')); ?></strong>
                <span
                    class="badge
                    <?php if($task->status === 'TODO'): ?> bg-secondary
                    <?php elseif($task->status === 'INPROGRESS'): ?> bg-warning
                    <?php else: ?> bg-success <?php endif; ?>">
                    <?php echo e(ucfirst(strtolower($task->status))); ?>

                </span>
            </p>
            <p><strong><?php echo e(__('Start Date:')); ?></strong> <?php echo e($task->start_date); ?></p>
            <p><strong><?php echo e(__('End Date:')); ?></strong> <?php echo e($task->end_date ?? 'N/A'); ?></p>
            <p><strong><?php echo e(__('Description:')); ?></strong> <?php echo e($task->description); ?></p>
            <div class="mt-3 d-flex gap-2">
                <a href="<?php echo e(route('tasks.edit', $task->id)); ?>" class="btn btn-sm btn-info"><?php echo e(__('Edit')); ?></a>
                <form action="<?php echo e(route('tasks.destroy', $task->id)); ?>" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this task?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-sm btn-danger"><?php echo e(__('Delete')); ?></button>
                </form>
            </div>
        </div>
    </div>

    <!-- Assignees -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><?php echo e(__('Assigned Members')); ?></h5>
        </div>
        <div class="card-body">
            <?php if($task->assignees->isEmpty()): ?>
                <p class="text-muted"><?php echo e(__('No team members assigned.')); ?></p>
            <?php else: ?>
                <ul class="list-group">
                    <?php $__currentLoopData = $task->assignees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item"><?php echo e($member->name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <!-- Change Status -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0"><?php echo e(__('Update Task Status')); ?></h5>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('tasks.updateStatus', $task->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-3">
                    <label for="status" class="form-label"><?php echo e(__('Task Status')); ?></label>
                    <select name="status" id="status" class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        required>
                        <option value="TODO" <?php echo e($task->status === 'TODO' ? 'selected' : ''); ?>><?php echo e(__('To Do')); ?>

                        </option>
                        <option value="INPROGRESS" <?php echo e($task->status === 'INPROGRESS' ? 'selected' : ''); ?>>
                            <?php echo e(__('In Progress')); ?></option>
                        <option value="COMPLETED" <?php echo e($task->status === 'COMPLETED' ? 'selected' : ''); ?>>
                            <?php echo e(__('Completed')); ?></option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Update Status')); ?></button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\projectmanegement\resources\views/tasks/show.blade.php ENDPATH**/ ?>