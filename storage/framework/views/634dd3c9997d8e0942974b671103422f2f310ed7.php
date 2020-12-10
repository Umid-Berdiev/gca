<?php $__env->startSection("content"); ?>
<div class="container">
  <div class="row">
    <div class="col-auto ml-auto">
      <?php echo $__env->make('partials.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</div>

<div class="card-body" style="background-color: white">
  <div class="table-responsive">
    <div class="card">
      <div class="card-body tab-content">
        <form class="form-horizontal" role="form" method="post" action="<?php echo e(route('languages.update', $model->id)); ?>">
          <?php echo csrf_field(); ?>
          <?php echo method_field('put'); ?>
          <div class="form-group">
            <label for="regular1" class="col-sm-2 control-label">Language name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="language_name" id="regular1"
                value="<?php echo e($model->language_name); ?>">
              <div class="form-control-line"></div>
            </div>
          </div>
          <div class="form-group">
            <label for="regular2" class="col-sm-2 control-label">Language prefix</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="language_prefix" id="regular2"
                value="<?php echo e($model->language_prefix); ?>">
              <div class="form-control-line"></div>
            </div>
          </div>
          <div class="form-group">
            <a href="<?php echo e(route('languages.index')); ?>" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>

        </form>

      </div>

    </div>
    <!--end .card-body -->
  </div>
</div>
<!--end .table-responsive -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/language/edit.blade.php ENDPATH**/ ?>