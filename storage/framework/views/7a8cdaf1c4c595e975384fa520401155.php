<?php $__env->startSection('header'); ?>
    <h2 class="h4 text-dark">
        <?php echo e(__('Profile')); ?>

    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="row g-4">
            <!-- Update Profile Information -->
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.update-profile-information-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.update-password-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\projectmanegement\resources\views/profile/edit.blade.php ENDPATH**/ ?>