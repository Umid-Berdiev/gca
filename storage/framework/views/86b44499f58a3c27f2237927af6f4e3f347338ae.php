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
      action="<?php echo e(route('video.update', $grp_id)); ?>">
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
              <select class="form-control" name="category_id" id="category_id">
                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($value->group); ?>" selected="<?php echo e($val->event_category_id == $value->group); ?>">
                  <?php echo e($value->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <label for="category_id">Video category</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="names[]" class="form-control" value="<?php echo e($val->name); ?>" id="names">
              <label for="names">name</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="descriptions[]" class="form-control" value="<?php echo e($val->description); ?>"
                id="descriptions">
              <label for="descriptions">description</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="links[]" class="form-control" id="links" value="<?php echo e($val->youtube_link); ?>">
              <label for="links">youtube link id</label>
            </div>
            
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
            <input type="text" name="names[]" class="form-control" value="<?php echo e($val->name); ?>" id="names">
            <label for="names">name</label>
          </div>
          <div class="form-group floating-label">
            <input type="text" name="descriptions[]" class="form-control" value="<?php echo e($val->description); ?>"
              id="descriptions">
            <label for="descriptions">description</label>
          </div>
          <div class="form-group floating-label">
            <input type="text" name="links[]" class="form-control" value="<?php echo e($val->youtube_link); ?>" id="links">
            <label for="links">youtube link id</label>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <div class="card-actionbar-row">
        <a href="<?php echo e(route('video.index')); ?>" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary ink-reaction">Update</button>
      </div>
  </div>
  </form>
</div>
</div>
<!--end .table-responsive -->



<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/video/edit.blade.php ENDPATH**/ ?>