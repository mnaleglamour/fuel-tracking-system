<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>sales tracking</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="font-sans antialiased bg-gray-100">

    <!-- NOTIFICATION BELL (top right) -->
    <div style="position:fixed; top:20px; right:20px; z-index:1000;">
        <a href="<?php echo e(route('notifications.index')); ?>" style="position:relative; display:inline-flex; align-items:center; background:#1e293b; color:#e5e7eb; padding:12px 16px; border-radius:50px; text-decoration:none; font-weight:600; box-shadow:0 4px 12px rgba(0,0,0,0.2); transition:0.3s;">
            <i class="fa-solid fa-bell" style="font-size:18px; margin-right:8px;"></i>
            <span>Notifications</span>
            <?php if(auth()->guard()->check()): ?>
                <?php $unreadCount = auth()->user()->unreadNotifications()->count(); ?>
                <?php if($unreadCount > 0): ?>
                    <span style="position:absolute; top:-4px; right:-4px; background:#ef4444; color:white; border-radius:50%; width:20px; height:20px; font-size:11px; font-weight:700; display:flex; align-items:center; justify-content:center;"><?php echo e($unreadCount); ?></span>
                <?php endif; ?>
            <?php endif; ?>
        </a>
    </div>

    <!-- LEFT SIDEBAR -->
    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- MAIN CONTENT -->
    <main style="margin-left:240px; padding:20px; min-height:100vh;">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</body>
</html>
<?php /**PATH C:\laravel\tracking\resources\views/layouts/app.blade.php ENDPATH**/ ?>