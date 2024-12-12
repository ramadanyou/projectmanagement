<?php $__env->startSection('header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            <?php echo e(__('Tasks Lists')); ?>

        </h2>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mt-4">
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!-- Collapsible Project Section -->
            <div class="mb-4 border rounded shadow-sm">
                <!-- Project Header -->
                <div class="bg-primary text-white p-3 cursor-pointer" data-bs-toggle="collapse" data-bs-target="#project-<?php echo e($project->id); ?>" aria-expanded="true" aria-controls="project-<?php echo e($project->id); ?>">
                    <h5 class="mb-0">
                        <?php echo e($project->name); ?>

                    </h5>
                </div>

                <!-- Collapsible Tasks (Visible by Default) -->
                <div class="collapse show" id="project-<?php echo e($project->id); ?>">
                    <div class="p-3 bg-light">
                        <?php if($project->tasks->isEmpty()): ?>
                            <p class="text-muted mb-0"><?php echo e(__('No tasks available.')); ?></p>
                        <?php else: ?>
                            <div class="row g-3">
                                <?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <!-- Task Card -->
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                   <a href="<?php echo e(route('tasks.show', $task->id)); ?>"><?php echo e($task->title); ?></a>
                                                </h6>
                                                <div>
                                                    <p class="mb-1">
                                                        <strong><?php echo e(__('Assigned to:')); ?></strong>
                                                        <?php if($task->assignees->isEmpty()): ?>
                                                            <span class="text-muted"><?php echo e(__('Unassigned')); ?></span>
                                                        <?php else: ?>
                                                            <?php echo e($task->assignees->pluck('name')->join(', ')); ?>

                                                        <?php endif; ?>
                                                    </p>
                                                    <p class="mb-0">
                                                        <strong><?php echo e(__('Status:')); ?></strong>
                                                        <span class="badge
                                                            <?php if($task->status === 'TODO'): ?> bg-secondary
                                                            <?php elseif($task->status === 'INPROGRESS'): ?> bg-warning
                                                            <?php else: ?> bg-success <?php endif; ?>">
                                                            <?php echo e(ucfirst(strtolower($task->status))); ?>

                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projectmanegement\resources\views/tasks/index.blade.php ENDPATH**/ ?>