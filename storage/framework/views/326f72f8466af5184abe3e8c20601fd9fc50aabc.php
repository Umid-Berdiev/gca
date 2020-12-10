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
        <form class="form-horizontal" role="form" method="post" action="<?php echo e(route("languages.store")); ?>">
          <?php echo csrf_field(); ?>

          <div class="form-group">
            <label for="regular13" class="col-sm-2 control-label">Language name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="language_name" id="regular13">
              <div class="form-control-line"></div>
            </div>
          </div>
          <div class="form-group">
            <label for="regular13" class="col-sm-2 control-label">Language prefix</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="language_prefix" id="regular13">
              <div class="form-control-line"></div>
            </div>
          </div>
          <div class="form-group">
            <a href="<?php echo e(route('languages.index')); ?>" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>

        </form>

      </div>

    </div>
    <!--end .card-body -->
  </div>
</div>
<!--end .table-responsive -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/language/create.blade.php ENDPATH**/ ?>