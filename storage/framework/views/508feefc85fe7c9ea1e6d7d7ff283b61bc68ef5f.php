<?php $__env->startSection("content"); ?>

<div class="col-md-12" style="background-color: white;padding: 25px;">
  <div class="col-md-12">
    savol:<?php echo e($savol->savol); ?>

  </div>
  <div class="col-md-12">
    <div class="form-group">
      <form action="<?php echo e(URL('admin/sorovatter')); ?>" method="get">
        <div class="input-group">
          <div class="input-group-content">
            <input type="text" class="form-control" name="search" placeholder="SEARCH" id="groupbutton9">
            <input type="hidden" class="form-control" name="id" value="<?php echo e($savol->id); ?>">
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
          <td width="80px">№</td>
          <td width="80px">Javob</td>
          <td width="80px">vote</td>

          <td width="80px"></td>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $table;
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $key => $page) : $__env->incrementLoopIndices();
          $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($key + 1); ?></td>

            <td><?php echo e($page->javob); ?></td>
            <td><?php echo e($page->order); ?></td>
            <td>
              <span><a href="<?php echo e(URL('/admin/sorovatter/edit?id=' . $page->group)); ?>"><i class="fa fa-edit"></i></a></span>
              <span><a onclick="confirm('are you sure delete?')" href="<?php echo e(URL('/admin/sorovatter/delete?id=' . $page->group)); ?>"><i class="fa fa-remove"></i></a></span>

            </td>
          </tr>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    <?php echo e($table->links()); ?>

  </div>


</div>

<div class="container">

  <div class="col-md-12">
    <div class="card-head">
      <ul class="nav nav-tabs" style="background-color: whitesmoke;" data-toggle="tabs">
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
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="<?php echo e(URL("/admin/sorovatter/insert")); ?>">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <input type="hidden" name="savol_id" value="<?php echo e($savol->group); ?>">
      <div class="card-body tab-content" style="background-color: white">
        <?php $__currentLoopData = $languages;
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $key => $language) : $__env->incrementLoopIndices();
          $loop = $__env->getLastLoop(); ?>
          <?php if ($key == 0) : ?>
            <div class="tab-pane active" id="<?php echo e($language->id); ?>">
              <div class="form" role="form">

                <input type="hidden" name="language_ids[]" value="<?php echo e($language->id); ?>">
                <div class="form-group floating-label">
                  <input type="text" name="javob[]" class="form-control" value="-" required id="regular2">
                  <label for="regular2">javob</label>
                </div>


              </div>
            </div>
          <?php else : ?>
            <div class="tab-pane" id="<?php echo e($language->id); ?>">
              <div class="form" role="form">

                <input type="hidden" name="language_ids[]" value="<?php echo e($language->id); ?>">
                <div class="form-group floating-label">
                  <input type="text" name="javob[]" class="form-control" value="-" required id="regular2">
                  <label for="regular2">javob</label>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.layout.template", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\OpenServer\domains\gca\resources\views\admin\sorovatter.blade.php ENDPATH**/ ?>