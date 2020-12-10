<?php $__env->startSection("content"); ?>

<div class="card-body" style="background-color: white">
  <div class="col-md-12">
    <div class="card-head">
      <ul class="nav nav-tabs" data-toggle="tabs">
        <?php $__currentLoopData = $languages;
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $key => $language) : $__env->incrementLoopIndices();
          $loop = $__env->getLastLoop(); ?>
          <?php if ($key == 0) : ?>
            <li class="active"><a href="#<?php echo e($language->id); ?>"><?php echo e($language->language_name); ?></a></li>
          <?php else : ?>
            <li><a href="#<?php echo e($language->id); ?>"><?php echo e($language->language_name); ?></a></li>
          <?php endif; ?>

        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="<?php echo e(URL("/admin/doccategory/edit")); ?>">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <input type="hidden" name="group" value="<?php echo e($grp_id); ?>">
      <div class="card-body tab-content">
        <?php $__currentLoopData = $languages;
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $key => $language) : $__env->incrementLoopIndices();
          $loop = $__env->getLastLoop(); ?>
          <?php if ($key == 0) : ?>

            <?php $__currentLoopData = $model;
            $__env->addLoop($__currentLoopData);
            foreach ($__currentLoopData as $val) : $__env->incrementLoopIndices();
              $loop = $__env->getLastLoop(); ?>

              <?php if ($val->language_id == $language->id) : ?>
                <div class="tab-pane active" id="<?php echo e($language->id); ?>">
                  <div class="form" role="form">

                    <input type="hidden" name="language_ids[]" value="<?php echo e($language->id); ?>">
                    <div class="form-group floating-label">
                      <input type="text" name="category_names[]" class="form-control" value="<?php echo e($val->category_name); ?>" id="regular2">
                      <label for="regular2">category_name</label>
                    </div>


                  </div>
                </div>
              <?php endif; ?>
            <?php endforeach;
            $__env->popLoop();
            $loop = $__env->getLastLoop(); ?>
          <?php else : ?>
            <?php $__currentLoopData = $model;
            $__env->addLoop($__currentLoopData);
            foreach ($__currentLoopData as $val) : $__env->incrementLoopIndices();
              $loop = $__env->getLastLoop(); ?>

              <?php if ($val->language_id == $language->id) : ?>
                <div class="tab-pane" id="<?php echo e($language->id); ?>">
                  <div class="form" role="form">

                    <input type="hidden" name="language_ids[]" value="<?php echo e($language->id); ?>">
                    <div class="form-group floating-label">
                      <input type="text" name="category_names[]" class="form-control" value="<?php echo e($val->category_name); ?>" id="regular2">
                      <label for="regular2">category_name</label>
                    </div>
                  </div>
                </div>
              <?php endif; ?>
            <?php endforeach;
            $__env->popLoop();
            $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\doccategory_edit.blade.php ENDPATH**/ ?>