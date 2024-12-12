<?php $__env->startSection('header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 text-dark">
            <?php echo e(__('Project Lists')); ?>

        </h2>
        <a href="<?php echo e(route('projects.create')); ?>" class="btn btn-primary"><?php echo e(__('Add New Project')); ?></a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row g-4">
        <!-- Project Cards -->
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="<?php echo e(route('projects.show', $project->id)); ?>"><?php echo e($project->name); ?></a>
                        </h5>
                        <p class="mb-2"><strong>Start Date:</strong> <?php echo e($project->start_date); ?></p>
                        <p class="mb-2"><strong>End Date:</strong> <?php echo e($project->end_date ?? 'N/A'); ?></p>
                        <p class="mb-2"><strong>Description:</strong> <?php echo e($project->description); ?></p>
                        <p class="mb-2"><strong>Team Members:</strong>
                            <?php if($project->teamMembers->count() > 0): ?>
                                <?php echo e($project->teamMembers->pluck('name')->join(', ')); ?>

                            <?php else: ?>
                                None
                            <?php endif; ?>
                        </p>
                        <p class="mb-2"><strong>Status:</strong>
                            <span
                                class="badge
                                <?php if($project->status == 'COMPLETED'): ?> bg-success
                                <?php elseif($project->status == 'STARTED'): ?> bg-warning
                                <?php else: ?> bg-danger <?php endif; ?>">
                                <?php echo e(ucfirst(strtolower($project->status))); ?>

                            </span>
                        </p>
                        <p class="mb-0"><strong>Task Completed:</strong>
                            <?php echo e($project->tasks->where('status', 'COMPLETED')->count()); ?>/<?php echo e($project->tasks->count()); ?>

                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\projectmanegement\resources\views/projects/index.blade.php ENDPATH**/ ?>