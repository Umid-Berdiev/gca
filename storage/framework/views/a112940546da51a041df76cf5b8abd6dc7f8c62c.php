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
    <form class="form" role="form" enctype="multipart/form-data" method="post"
      action="<?php echo e(route('videoalbum.update', $grp_id)); ?>">
      <?php echo csrf_field(); ?>
      <?php echo method_field('put'); ?>
      <input type="hidden" name="group" value="<?php echo e($grp_id); ?>">
      <div class="card-body tab-content">
        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($key == 0): ?>
        <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($val->language_id ==$language->id): ?>
        <div class="tab-pane active" id="<?php echo e($language->id); ?>">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="<?php echo e($language->id); ?>">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" value="<?php echo e($val->title); ?>" id="title">
              <label for="title">title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" value="<?php echo e($val->Description); ?>" id="desc">
              <label for="desc">Description</label>
            </div>
            <div class="form-group floating-label">
              <label for="file" for="cover">Choose album cover</label>
              <input type="file" name="cover" class="form-control" id="cover" value="<?php echo e($val->cover); ?>">
              
            </div>
            <?php if($val->cover && $val->cover != "null"): ?>
            <img src="<?php echo e(asset('storage/app/' . $val->cover)); ?>" height="30px" width="30px" />
            <input type="checkbox" name="remove_cover" id="remove-cover">
            <label for="remove-cover">Remove cover</label>
            <?php else: ?> <span>No image</span>
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if($val->language_id ==$language->id): ?>
        <div class="tab-pane" id="<?php echo e($language->id); ?>">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="<?php echo e($language->id); ?>">
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" value="<?php echo e($val->title); ?>" id="title">
              <label for="title">title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" value="<?php echo e($val->Description); ?>" id="desc">
              <label for="desc">description</label>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="card-actionbar-row">
          <a href="<?php echo e(route('videoalbum.index')); ?>" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/videoalbum/edit.blade.php ENDPATH**/ ?>