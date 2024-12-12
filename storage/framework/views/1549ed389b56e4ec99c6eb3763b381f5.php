<?php $__env->startSection('header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            <?php echo e(__('Project Details')); ?>

        </h2>
        <div class="d-flex gap-2">
            <!-- Edit Button -->
            <a href="<?php echo e(route('projects.edit', $project->id)); ?>" class="btn btn-sm btn-info"><?php echo e(__('Edit')); ?></a>

            <!-- Delete Button -->
            <form action="<?php echo e(route('projects.destroy', $project->id)); ?>" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this project? This action cannot be undone.');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-sm btn-danger"><?php echo e(__('Delete')); ?></button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title"><?php echo e($project->name); ?></h5>
            <p><strong><?php echo e(__('Start Date:')); ?></strong> <?php echo e($project->start_date); ?></p>
            <p><strong><?php echo e(__('End Date:')); ?></strong> <?php echo e($project->end_date ?? 'N/A'); ?></p>
            <p><strong><?php echo e(__('Description:')); ?></strong> <?php echo e($project->description); ?></p>
            <p>
                <strong><?php echo e(__('Status:')); ?></strong>
                <span
                    class="badge
                    <?php if($project->status === 'STARTED'): ?> bg-warning
                    <?php elseif($project->status === 'ONHOLD'): ?> bg-secondary
                    <?php else: ?> bg-success <?php endif; ?>">
                    <?php echo e(ucfirst(strtolower($project->status))); ?>

                </span>
            </p>
            <form action="<?php echo e(route('projects.updateStatus', $project->id)); ?>" method="POST" class="mt-3">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="d-flex align-items-center gap-2">
                    <select name="status" id="status"
                        class="form-select form-select-sm w-auto <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <option value="STARTED" <?php echo e($project->status === 'STARTED' ? 'selected' : ''); ?>><?php echo e(__('Started')); ?>

                        </option>
                        <option value="ONHOLD" <?php echo e($project->status === 'ONHOLD' ? 'selected' : ''); ?>><?php echo e(__('On Hold')); ?>

                        </option>
                        <option value="COMPLETED" <?php echo e($project->status === 'COMPLETED' ? 'selected' : ''); ?>>
                            <?php echo e(__('Completed')); ?></option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary"><?php echo e(__('Update Status')); ?></button>
                </div>
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
            </form>
        </div>
    </div>

    <!-- Team Members -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><?php echo e(__('Team Members')); ?></h5>
        </div>
        <div class="card-body">
            <?php if($project->teamMembers->isEmpty()): ?>
                <p class="text-muted"><?php echo e(__('No team members assigned.')); ?></p>
            <?php else: ?>
                <ul class="list-group">
                    <?php $__currentLoopData = $project->teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item"><?php echo e($member->name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <!-- Task List -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><?php echo e(__('Tasks')); ?></h5>
            <a href="<?php echo e(route('tasks.create', $project->id)); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Create Task')); ?></a>
        </div>
        <div class="card-body">
            <?php if($project->tasks->isEmpty()): ?>
                <p class="text-muted"><?php echo e(__('No tasks found.')); ?></p>
            <?php else: ?>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th><?php echo e(__('Title')); ?></th>
                            <th><?php echo e(__('Assigned Members')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <th><?php echo e(__('Actions')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(route('tasks.show', $task->id)); ?>"><?php echo e($task->title); ?></a>
                                </td>
                                <td>
                                    <?php if($task->assignees->isEmpty()): ?>
                                        <span class="text-muted"><?php echo e(__('Unassigned')); ?></span>
                                    <?php else: ?>
                                        <?php echo e($task->assignees->pluck('name')->join(', ')); ?>

                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span
                                        class="badge
                                        <?php if($task->status === 'TODO'): ?> bg-secondary
                                        <?php elseif($task->status === 'INPROGRESS'): ?> bg-warning
                                        <?php else: ?> bg-success <?php endif; ?>">
                                        <?php echo e(ucfirst(strtolower($task->status))); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?php echo e(route('tasks.edit', $task->id)); ?>"
                                            class="btn btn-sm btn-info"><?php echo e(__('Edit')); ?></a>
                                        <form action="<?php echo e(route('tasks.destroy', $task->id)); ?>" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this task?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                class="btn btn-sm btn-danger"><?php echo e(__('Delete')); ?></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projectmanegement\resources\views/projects/show.blade.php ENDPATH**/ ?>