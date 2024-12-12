<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
            <img src="https://laravel.com/img/logomark.min.svg" alt="Logo" height="30">
        </a>

        <!-- Hamburger (Mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>"
                        href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('projects.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Projects')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('tasks.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('tasks.index')); ?>"><?php echo e(__('Tasks')); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('users.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('users.index')); ?>"><?php echo e(__('Users')); ?></a>
                </li>
            </ul>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo e(Auth::user()->name); ?>

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>"><?php echo e(__('Profile')); ?></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">
                                    <?php echo e(__('Log Out')); ?>

                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\www\projectmanegement\resources\views/layouts/header.blade.php ENDPATH**/ ?>