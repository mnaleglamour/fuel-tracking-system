

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Open Shift</h2>

    <form method="POST" action="<?php echo e(route('shifts.store')); ?>">
        <?php echo csrf_field(); ?>

        <label>Pump</label>
        <select name="pump_id" required>
            <option value="">-- Select Pump --</option>
            <?php $__currentLoopData = $pumps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pump): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($pump->id); ?>"><?php echo e($pump->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <label>Shift Period</label>
        <select name="shift_period" required>
            <option value="morning">Morning</option>
            <option value="evening">Evening</option>
            <option value="night">Night</option>
        </select>

        <label>Opening Meter</label>
        <input type="number" step="0.01" name="opening_meter" required>

        <button type="submit" class="btn btn-primary mt-3">
            Open Shift
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SHAYO\Desktop\laravel\tracking\resources\views/shifts/create.blade.php ENDPATH**/ ?>