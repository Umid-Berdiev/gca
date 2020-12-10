<?php if(session('success')): ?>
<div class="alert small alert-success text-center mb-0">
  <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if(session('warning')): ?>
<div class="alert small alert-warning text-center mb-0 py-2">
  <?php echo e(session('warning')); ?>

</div>
<?php endif; ?>

<?php if($errors->any()): ?>
<div class="alert small alert-danger">
  <p>Ошибки:</p>
  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <p><?php echo e($error); ?></p>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>

<?php /**PATH D:\OpenServer\domains\gca\resources\views/partials/alerts.blade.php ENDPATH**/ ?>