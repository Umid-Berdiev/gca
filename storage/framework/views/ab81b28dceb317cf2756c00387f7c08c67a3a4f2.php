<?php $__env->startSection("content"); ?>

<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    <div class="form-group">
      <a class="btn ink-reaction btn-floating-action btn-lg btn-primary" href="<?php echo e(route('videoalbum.create')); ?>">
        <i class="fa fa-plus"></i>
      </a>
      <br />
      <br />
      <form action="<?php echo e(URL('admin/videoalbum')); ?>" method="get">
        <div class="input-group">
          <div class="input-group-content">
            <input type="text" class="form-control" name="search" placeholder="SEARCH" id="groupbutton9">
            <label for="groupbutton9"></label>
          </div>
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">Go!</button>
          </div>

        </div>
      </form>
    </div>
    <table class="table table-condensed no-margin">
      <thead>
        <tr>
          <td>№</td>
          <td>title</td>
          <td>description</td>
          <td>category</td>
          <td>action</td>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $table; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($key + 1); ?></td>
          <td><?php echo e($page->title); ?></td>
          <td><?php echo e($page->Description); ?></td>
          <td><?php echo e($page->title); ?></td>
          <td>
            
            
            <form style="display: inline;" action="<?php echo e(route('videoalbum.edit', $page->group)); ?>" method="get">
              <button>
                <i class="fa fa-edit"></i>
              </button>
            </form>
            <form style="display: inline;" action="<?php echo e(route('videoalbum.destroy', $page->group)); ?>" method="POST">
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
    <?php echo e($table->links()); ?>

  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views/admin/videoalbum/index.blade.php ENDPATH**/ ?>