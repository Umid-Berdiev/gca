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
      action="<?php echo e(route('documents.update', $grp_id)); ?>">
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
                  <?php echo e($value->category_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <label for="category_id">Document category</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" value="<?php echo e($val->title); ?>" id="titles">
              <label for="titles">title</label>
            </div>
            <div class="form-group floating-label">
              <textarea name="descriptions[]" class="form-control"><?php echo e($val->description); ?></textarea>
            </div>
            <div class="form-group floating-label">
              <input type="file" name="files[]" class="form-control" value="<?php echo e($val->files); ?>">
            </div>
            <div class="form-group floating-label">
              <input type="text" name="links[]" class="form-control" value="<?php echo e($val->link); ?>" id="links">
              <label for="links">link</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="other_link" class="form-control" value="<?php echo e($val->other_link); ?>" id="other_link">
              <label for="other_link">other link</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="register_numbers[]" class="form-control" value="<?php echo e($val->r_number); ?>"
                id="register_numbers">
              <label for="register_numbers">register number</label>
            </div>
            <div class="form-group floating-label">
              <input type="date" name="register_dates[]" class="form-control" value="<?php echo e($val->r_date); ?>"
                id="register_dates">
              <label for="register_dates">register date</label>
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
              <input type="text" name="titles[]" class="form-control" value="<?php echo e($val->title); ?>" id="titles">
              <label for="titles">title</label>
            </div>
            <div class="form-group floating-label">
              <textarea name="descriptions[]" class="form-control"><?php echo e($val->description); ?></textarea>
            </div>
            <div class="form-group floating-label">
              <input type="file" name="files[]" class="form-control" value="<?php echo e($val->files); ?>">
            </div>
            <div class="form-group floating-label">
              <input type="text" name="links[]" class="form-control" value="<?php echo e($val->link); ?>" id="links">
              <label for="links">link</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="register_numbers[]" class="form-control" value="<?php echo e($val->r_number); ?>"
                id="register_numbers">
              <label for="register_numbers">register number</label>
            </div>
            <div class="form-group floating-label">
              <input type="date" name="register_dates[]" class="form-control" value="<?php echo e($val->r_date); ?>"
                id="register_dates">
              <label for="register_dates">register date</label>
            </div>
          </div>
        </div>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="card-actionbar-row">
          <a href="<?php echo e(route('documents.index')); ?>" class="btn btn-secondary">Back</a>
          <button type="submit" class="btn btn-primary ink-reaction">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/document/edit.blade.php ENDPATH**/ ?>