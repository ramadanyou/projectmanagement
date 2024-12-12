<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="text-center">
            <h1 class="display-1 text-danger">403</h1>
            <h2 class="mb-3"><?php echo e(__('Unauthorized')); ?></h2>
            <p class="text-muted mb-4"><?php echo e(__('You do not have permission to access this page.')); ?></p>
            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary"><?php echo e(__('Back to Home')); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\projectmanegement\resources\views/errors/403.blade.php ENDPATH**/ ?>