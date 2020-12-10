<?php $__env->startSection("content"); ?>

<div class="container">
  <div class="row">
    <div class="col-auto ml-auto">
      <?php echo $__env->make('partials.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</div>

<div class="card-body" style="background-color: white">
  <div class="col-md-12">
    <div class="card-head">
      <ul class="nav nav-tabs" data-toggle="tabs">
        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($key == 0): ?>
        <li class="active"><a href="#<?php echo e($language->id); ?>"><?php echo e($language->language_name); ?></a></li>
        <?php else: ?>
        <li><a href="#<?php echo e($language->id); ?>"><?php echo e($language->language_name); ?></a></li>
        <?php endif; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="<?php echo e(route('videoalbum.store')); ?>">
      <?php echo csrf_field(); ?>
      <div class="card-body tab-content">
        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($key == 0): ?>
        <div class="tab-pane active" id="<?php echo e($language->id); ?>">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="<?php echo e($language->id); ?>">

            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="title">
              <label for="title">title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" id="desc">
              <label for="desc">Description</label>
            </div>

            <div class="form-group floating-label">
              <label for="file">Choose album cover</label>
              <input type="file" name="cover" class="form-control" id="file">
            </div>

          </div>
        </div>
        <?php else: ?>
        <div class="tab-pane" id="<?php echo e($language->id); ?>">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="<?php echo e($language->id); ?>">

            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="title">
              <label for="title">title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" id="desc">
              <label for="desc">description</label>
            </div>

          </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="card-actionbar-row">
          <a href="<?php echo e(route('videoalbum.index')); ?>" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/videoalbum/create.blade.php ENDPATH**/ ?>