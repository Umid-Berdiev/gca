<?php $__env->startSection("content"); ?>

<div class="container">
  <div class="row justify-content-right">
    <div class="col-auto">
      <?php echo $__env->make('partials.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</div>

<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    <a class="btn ink-reaction btn-floating-action btn-lg btn-primary" href="<?php echo e(route('languages.create')); ?>">
      <i class="fa fa-plus"></i>
    </a>
    <br />
    <br />
    <div class="col-md-12">
      <table class="table">
        <thead>
          <tr>
            <td>№</td>
            <td>Language name</td>
            <td>Language prefix</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $langs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($key + 1); ?></td>
            <td><?php echo e($value->language_name); ?></td>
            <td><?php echo e($value->language_prefix); ?></td>
            <td>
              <form style="display: inline;" action="<?php echo e(route('languages.edit', $value->id)); ?>" method="get">
                <button>
                  <i class="fa fa-edit"></i>
                </button>
              </form>
              <form style="display: inline;" action="<?php echo e(route('languages.destroy', $value->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('delete'); ?>
                <button class="" type="submit" onclick="return confirm('Вы уверены?');">
                  <i class="fa fa-remove"></i>
                </button>
              </form>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
      </table>

      <?php echo e($langs->links()); ?>

    </div>
  </div>

  <?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/language/index.blade.php ENDPATH**/ ?>