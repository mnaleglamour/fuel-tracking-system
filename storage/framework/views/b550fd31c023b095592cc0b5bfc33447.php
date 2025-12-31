

<?php $__env->startSection('content'); ?>

<style>
    .sale-form-container {
        margin-left: 260px;
        padding: 30px;
        max-width: 480px;
    }

    .sale-card {
        background: white;
        padding: 25px;
        border-radius: 14px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    }

    .sale-title {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 20px;
        color: #0f172a;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .alert-warning {
        background: #fef3c7;
        color: #92400e;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: 700;
        margin-bottom: 6px;
        color: #334155;
    }

    select, input {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #cbd5f5;
        margin-bottom: 16px;
        font-size: 14px;
    }

    select:focus, input:focus {
        outline: none;
        border-color: #22c55e;
    }

    .submit-btn {
        background: #16a34a;
        color: white;
        padding: 12px;
        width: 100%;
        border-radius: 10px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }

    .submit-btn:hover {
        background: #15803d;
    }
</style>

<div class="sale-form-container">
    <div class="sale-card">
        <h2 class="sale-title">Record Sale</h2>

        <?php if(session('success')): ?>
            <div class="alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('warning')): ?>
            <div class="alert-warning">
                <?php echo e(session('warning')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert-error">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>⚠ <?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('sales.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <label>Select Pump</label>
            <select name="pump_id" required onchange="updatePumpInfo()">
                <option value="">-- Select a pump --</option>
                <?php $__currentLoopData = $pumps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pump): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($pump->id); ?>" data-price="<?php echo e($pump->price_per_litre); ?>" data-region="<?php echo e($pump->region); ?>" data-fuel="<?php echo e($pump->fuel_type); ?>" data-cap="<?php echo e($pump->cap_price ?? 'N/A'); ?>">
                        <?php echo e($pump->name); ?> — <?php echo e($pump->fuel_type); ?> — Stock: <?php echo e($pump->stock ?? 'N/A'); ?> L
                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <div id="pumpInfo" style="display: none; margin-bottom: 16px; padding: 12px; background: #f0f9ff; border-left: 4px solid #2563eb; border-radius: 6px;">
                <div style="font-size: 13px; margin-bottom: 8px;">
                    <strong>Region:</strong> <span id="infoPumpRegion">-</span>
                </div>
                <div style="font-size: 13px; margin-bottom: 8px;">
                    <strong>Pump Price:</strong> TSH <span id="infoPumpPrice">0.00</span>/L
                </div>
                <div style="font-size: 13px; margin-bottom: 8px;">
                    <strong>Gov Cap Price:</strong> 
                    <span id="infoCapPrice" style="font-weight: bold; color: #16a34a;">-</span>
                </div>
            </div>

            <label>Litres Sold</label>
            <input type="number" step="0.01" name="litres_sold" required placeholder="Enter quantity">

            <button type="submit" class="submit-btn">
                Submit Sale
            </button>
        </form>
    </div>
</div>

<script>
function updatePumpInfo() {
    const select = document.querySelector('select[name="pump_id"]');
    const option = select.options[select.selectedIndex];
    const pumpInfo = document.getElementById('pumpInfo');
    
    if (!option.value) {
        pumpInfo.style.display = 'none';
        return;
    }
    
    pumpInfo.style.display = 'block';
    
    const region = option.getAttribute('data-region');
    const price = option.getAttribute('data-price');
    const cap = option.getAttribute('data-cap');
    
    document.getElementById('infoPumpRegion').textContent = region || '-';
    document.getElementById('infoPumpPrice').textContent = parseFloat(price || 0).toFixed(2);
    
    if (cap === 'N/A' || !cap) {
        document.getElementById('infoCapPrice').textContent = 'Not set';
        document.getElementById('infoCapPrice').style.color = '#dc2626';
    } else {
        document.getElementById('infoCapPrice').textContent = '₦' + parseFloat(cap).toFixed(2) + '/L';
        document.getElementById('infoCapPrice').style.color = '#16a34a';
    }
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SHAYO\Desktop\laravel\tracking\resources\views/sales/create.blade.php ENDPATH**/ ?>