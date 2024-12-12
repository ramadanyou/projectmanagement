<?php $__env->startSection('header'); ?>
    <h2 class="h4 text-dark">
        <?php echo e(__('Dashboard')); ?>

    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Projects</h5>
                    <p class="display-4 fw-bold"><?php echo e($totalProjects); ?></p>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Ongoing Projects</h5>
                    <p class="display-4 fw-bold"><?php echo e($ongoingProjects); ?></p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Completed Projects</h5>
                    <p class="display-4 fw-bold"><?php echo e($completedProjects); ?></p>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Team Members</h5>
                    <p class="display-4 fw-bold"><?php echo e($totalTeamMembers); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Table -->
    <div class="mt-5 card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-4">Project Statistics</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Project Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Tasks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($project->name); ?></td>
                                <td><?php echo e($project->start_date); ?></td>
                                <td><?php echo e($project->end_date ?? 'N/A'); ?></td>
                                <td class="<?php echo e($project->status === 'COMPLETED' ? 'text-success' : ($project->status === 'STARTED' ? 'text-warning' : 'text-danger')); ?>">
                                    <?php echo e(ucfirst(strtolower($project->status))); ?>

                                </td>
                                <td>
                                    <?php echo e($project->completed_tasks); ?>/<?php echo e($project->tasks_count); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">No projects found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projectmanegement\resources\views/dashboard.blade.php ENDPATH**/ ?>