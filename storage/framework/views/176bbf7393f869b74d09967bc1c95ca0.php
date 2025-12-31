

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-xl">
    <h2 class="text-2xl font-bold mb-4">Create User</h2>

    <form method="POST" action="<?php echo e(route('admin.users.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="mt-1 block w-full rounded-md border-gray-300" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="mt-1 block w-full rounded-md border-gray-300" required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300" required>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-600 text-sm"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300" required>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300">
                <option value="<?php echo e(\App\Models\User::ROLE_ATTENDANT); ?>">Attendant</option>
                <option value="<?php echo e(\App\Models\User::ROLE_ADMIN); ?>">Admin</option>
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
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Create</button>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="px-4 py-2 border rounded">Cancel</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SHAYO\Desktop\laravel\tracking\resources\views/admin/users/create.blade.php ENDPATH**/ ?>