

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Notifications</h4>
                    <?php if(auth()->user()->unreadNotifications->count() > 0): ?>
                        <form method="POST" action="<?php echo e(route('notifications.read-all')); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-sm btn-primary">Mark All as Read</button>
                        </form>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="notification-item <?php echo e(!$notification->read_at ? 'bg-light' : ''); ?> p-3 mb-3 border rounded">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong><?php echo e($notification->data['pump']['name'] ?? 'Low Stock Alert'); ?></strong>
                                    <br>
                                    <small class="text-muted">
                                        Stock: <?php echo e($notification->data['remaining']); ?> L
                                        <?php if(isset($notification->data['attempted']) && $notification->data['attempted'] > 0): ?>
                                            (Attempted: <?php echo e($notification->data['attempted']); ?> L)
                                        <?php endif; ?>
                                    </small>
                                </div>
                                <div>
                                    <small class="text-muted"><?php echo e($notification->created_at->diffForHumans()); ?></small>
                                    <?php if(!$notification->read_at): ?>
                                        <form method="POST" action="<?php echo e(route('notifications.read', $notification->id)); ?>" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Mark Read</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="badge bg-success">Read</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center text-muted">No notifications.</p>
                    <?php endif; ?>

                    <div class="mt-4">
                        <?php echo e($notifications->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\tracking\resources\views/notifications/index.blade.php ENDPATH**/ ?>