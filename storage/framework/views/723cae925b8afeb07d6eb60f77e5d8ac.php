<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-xl">
    <h2 class="text-2xl font-bold mb-4">Edit User Role</h2>

    <form method="POST" action="<?php echo e(route('admin.users.update', $user)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <div class="mt-1"><?php echo e($user->name); ?></div>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300">
                <option value="<?php echo e(\App\Models\User::ROLE_ATTENDANT); ?>" <?php echo e($user->role === \App\Models\User::ROLE_ATTENDANT ? 'selected' : ''); ?>>Attendant</option>
                <option value="<?php echo e(\App\Models\User::ROLE_ADMIN); ?>" <?php echo e($user->role === \App\Models\User::ROLE_ADMIN ? 'selected' : ''); ?>>Admin</option>
            </select>
            <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="px-4 py-2 border rounded">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\tracking\resources\views/admin/users/edit.blade.php ENDPATH**/ ?>